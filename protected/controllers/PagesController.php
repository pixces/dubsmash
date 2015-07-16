<?php
//AWS access info
if (!defined('awsAccessKey')) define('awsAccessKey', 'AKIAJH5ZGO6NVLVOUS4A');
if (!defined('awsSecretKey'))
        define('awsSecretKey', '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');

class PagesController extends Controller
{
    /**
     * @var null
     */
    protected $oGoogle = null;

    /**
     * @var null
     */
    protected $oGooglePlus = null;

    /**
     * @var null
     */
    protected $oYoutube = null;

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex()
    {

        $model      = new SubmissionForm();
        $auth       = false;
        $submission = false;

        //fetch all the videos for the first page
        $brandVideos = $this->getCarouselContent();

        //baisc youtube playlist params
        $ytConfig = Yii::app()->params['YT_PlayList'];

        $ytParams = array(
            'api' => $ytConfig['apiKey'],
            'max' => $ytConfig['maxSize'],
            'cachexml' => $ytConfig['isCache'],
            'cachelife' => $ytConfig['cacheLifetime'],
            'xmlpath' => $ytConfig['cachePath'],
            'start' => 1,
            'descriptionlength' => 55,
            'titlelength' => 23
        );

        $videoPlayList = array();

        foreach (Yii::app()->params['YT_PlayListID']['index'] as $sPlayListId) {
            $obj = new CHPlaylist('playlist', $sPlayListId, $ytParams);
            array_push($videoPlayList, $obj->getInstance());
        }

        //include the playlist js and css files
        //Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/path/to/your/javascript/file',CClientScript::POS_END);
        Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/vendor/youtubeplaylist.css');
        Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/vendor/youtubeplaylist-right-with-thumbs.css');

        //render the page
        $this->pagename = 'index';

        //check if the user details are already set
        //then display the video link
        if (isset(Yii::app()->session['auth'])) {
            $auth = isset(Yii::app()->session['auth']) ? Yii::app()->session['auth']
                    : false;
        }
        if (isset(Yii::app()->session['submission'])) {
            $submission = isset(Yii::app()->session['submission']) ? Yii::app()->session['submission']
                    : false;
        }

        //when both are true reset the session
        if ($auth && $submission) {
            Yii::app()->session->remove('auth');
            Yii::app()->session->remove('submission');
        }


        $this->render(
            $this->pagename,
            array(
            'model' => $model,
            'gallery' => $brandVideos,
            'aVideoList' => $videoPlayList,
            'auth' => $auth,
            'submission' => $submission
            )
        );
    }

    /**
     * Social Google Authentication
     */
    public function actionAuthenticate()
    {
        $client = $this->getGoogle();

        if (isset($_GET['code']) && !isset(Yii::app()->session['user_info'])) {

            $client->authenticate($_GET['code']);
            $token   = $client->getAccessToken();
            $client->setAccessToken($token);
            $session = Yii::app()->session;

            $session['auth_token'] = $client->getAccessToken();

            $plus         = $this->getGooglePlus();
            $user_profile = $plus->people->get('me');

            //parse and store the profile in session
            if ($user_profile) {
                $oEmail = $user_profile->getEmails();
                $oImage = $user_profile->getImage();

                $profile = array(
                    'username' => $user_profile->getDisplayName(),
                    'email' => $oEmail[0]->getValue(),
                    'google_id' => $user_profile->getId(),
                    'google_profile_url' => $user_profile->getUrl(),
                    'google_profile_image' => $oImage->getUrl(),
                );

                $session['user_info'] = $profile;
            }

            Yii::app()->session['auth'] = true;

            /* $this->redirect('/'); */
            echo "<script>setTimeout(function(){refreshParent();}, 500);  </script>";
            echo "<script>function refreshParent(){ window.opener.location.reload(true); javascript:window.close();}</script>";
            //echo "<script>window.opener.location = window.opener.window.location; alert(1);</script>";
            exit;
            Yii::app()->end();
        } else {

            //reset the session so as to do proper authentication
            Yii::app()->session->remove('auth');
            Yii::app()->session->remove('submission');

            if (isset(Yii::app()->session['user_info'])) {
                Yii::app()->session->remove('user_info');
            }

            $client->setScopes(array(
                'https://www.googleapis.com/auth/youtube.readonly',
                'https://www.googleapis.com/auth/plus.me',
                'https://www.googleapis.com/auth/youtubepartner-channel-audit',
                'https://www.googleapis.com/auth/plus.profile.emails.read',
            ));
            $authUrl = $client->createAuthUrl();
            header("location:$authUrl");
        }
    }

    /**
     * Method to fetch All videos fro the Authenticated user
     * @throws Exception
     */
    public function actionVideos()
    {

        if (isset(Yii::app()->session['auth_token'])) {
            try {
                $client = $this->getGoogle();
                $client->setAccessToken(Yii::app()->session['auth_token']);

                $youtube          = $this->getYoutube();
                $channelsResponse = $youtube->channels->listChannels('contentDetails',
                    array(
                    'mine' => 'true',
                ));

                $htmlBody = '';
                foreach ($channelsResponse['items'] as $channel) {
                    // Extract the unique playlist ID that identifies the list of videos
                    // uploaded to the channel, and then call the playlistItems.list method
                    // to retrieve that list.
                    $uploadsListId = $channel['contentDetails']['relatedPlaylists']['uploads'];

                    $playlistItemsResponse = $youtube->playlistItems->listPlaylistItems('snippet',
                        array(
                        'playlistId' => $uploadsListId,
                        'maxResults' => 50
                    ));

                    $videoList = array();
                    foreach ($playlistItemsResponse['items'] as $playlistItem) {
                        array_push($videoList,
                            array(
                            'channelId' => $playlistItem['snippet']['channelId'],
                            'title' => $playlistItem['snippet']['title'],
                            'description' => $playlistItem['snippet']['description'],
                            'thumb_image' => $playlistItem['snippet']['thumbnails']['default']['url'],
                            'alternate_image' => $playlistItem['snippet']['thumbnails']['medium']['url'],
                            'videoId' => $playlistItem['snippet']['resourceId']['videoId'],
                            'playlistId' => $playlistItem['snippet']['playlistId'],
                            'channelTitle' => $playlistItem['snippet']['channelTitle'],
                            )
                        );
                    }
                }
            } catch (Exception $e) {
                Yii::app()->session['auth_token'] = null;
                throw $e;
            }
        } else {
            // Redirect the user to authenticate page
            echo "Authentication expired";
            exit;
        }

        $this->layout = false;
        $this->render('videos',
            array(
            'videoList' => $videoList,
            'user_info' => Yii::app()->session['user_info']
            )
        );
    }

    /**
     * Method to get list of Viode
     * to be displayed on the Casousel for the Index page
     * @param null $params
     * @return array
     */
    protected function getCarouselContent($params = null)
    {

        $galleryData = [];
        $columns     = Content::$defaultSelectableFields;

        $Criteria            = new CDbCriteria;
        $Criteria->condition = 'is_ugc=:ugc AND status=:status';
        $Criteria->params    = array(':ugc' => 0, 'status' => 'approved');
        $Criteria->order     = 'date_created DESC';

        if (Content::model()->count($Criteria)) {
            $content = Content::model()->findAll($Criteria);
            foreach ($content as $video) {
                $row = new stdClass();
                foreach ($columns as $column) {
                    $row->$column = $video->$column;
                }
                $galleryData[] = $row;
            }
        }
        return $galleryData;
    }

    public function getGoogle()
    {
        if (is_null($this->oGoogle)) {
            Yii::import(Yii::getPathOfAlias("application.vendor.Google.Client",
                    true));
            $client_id     = Yii::app()->params['GOOGLE']['CLIENT_ID'];
            $client_secret = Yii::app()->params['GOOGLE']['SECRET'];
            $redirect_uri  = YII::app()->params['GOOGLE']['CALLBACK_URL'];
            $developer_key = YII::app()->params['GOOGLE']['DEVELOPER_KEY'];
            $this->oGoogle = new Google_Client();
            $gg            = $this->oGoogle;
            $gg->setApplicationName('Comedy Hunt');
            $gg->setClientId($client_id);
            $gg->setClientSecret($client_secret);
            $gg->setRedirectUri($redirect_uri);
            $gg->setDeveloperKey($developer_key);
        }
        return $this->oGoogle;
    }

    public function getGooglePlus()
    {
        if (is_null($this->oGooglePlus)) {
            Yii::import(Yii::getPathOfAlias("application.vendor.Google.Service.Plus"),
                true);
            $this->oGooglePlus = new Google_Service_Plus($this->oGoogle);
        }
        return $this->oGooglePlus;
    }

    public function getYoutube()
    {
        if (is_null($this->oYoutube)) {
            Yii::import(Yii::getPathOfAlias("application.vendor.Google.Service.YouTube"),
                true);
            $this->oYoutube = new Google_Service_YouTube($this->oGoogle);
        }
        return $this->oYoutube;
    }

    public function actionTmpIndex()
    {
        $model = new SubmissionForm();

        if (isset($_POST['SubmissionForm']) || !empty(Yii::app()->session['SubmissionForm'])) {

            $model->attributes = isset($_POST['SubmissionForm']) ? $_POST['SubmissionForm']
                    : Yii::app()->session['SubmissionForm'];

            if ($model->validate()) {
                //set the session here after validating the data
                if (!isset(Yii::app()->session['SubmissionForm'])) {
                    Yii::app()->session['SubmissionForm'] = $model->attributes;
                }

                //first validate if the url is valid
                if (Utility::isValidYoutubeUrl($model->url)) {

                    unset($_POST['SubmissionForm']);
                    $plus   = Yii::app()->GoogleApis->serviceFactory('Plus');
                    $client = Yii::app()->GoogleApis->client;
                    $client->setScopes(array('https://www.googleapis.com/auth/youtube',
                        'https://www.googleapis.com/auth/plus.me', 'https://www.googleapis.com/auth/youtubepartner-channel-audit'));


                    try {
                        if (!isset(Yii::app()->session['auth_token']) || is_null(Yii::app()->session['auth_token']))
                                Yii::app()->session['auth_token'] = $client->authenticate();
                        else $activities                       = '';

                        if (isset(Yii::app()->session['auth_token'])) {

                            $client->setAccessToken(Yii::app()->session['auth_token']);
                            $userInfo                        = $plus->people->get("me");
                            Yii::app()->session['user_info'] = $userInfo;

                            /**
                             * User Information Google
                             */
                            /** @var (Object) $userInfoGoogle  Google User's Information * */
                            $userInfoGoogle              = new stdClass();
                            $userInfoGoogle->googleId    = $userInfo['id'];
                            $userInfoGoogle->displayName = $userInfo['displayName'];
                            $userInfoGoogle->image       = $userInfo['image']['url'];
                            //$userInfoGoogle->gender      = $userInfo['gender'];
                            //validate the video url to proceed
                            //only in case of a youtube url
//                            $youtubeVideoInfo = Utility::fetchYouTubeVideoDetails($model->url);
//                            $videoInfo        = json_decode($youtubeVideoInfo, true);
//                            if ($videoInfo['error'] == false) {
//                                $videoDetails                  = json_decode($videoInfo['result'],
//                                    true);
//                                $contentModel                  = new Content();
//                                $contentModel->isNewRecord     = true;
//                                $contentModel->primaryKey      = NULL;
//                                $contentModel->username        = $model->attributes['username'];
//                                $contentModel->email           = $model->attributes['username'];
//                                $contentModel->title           = $videoDetails['items'][0]['snippet']['title'];
//                                $contentModel->description     = strlen($videoDetails['items'][0]['snippet']['description'])
//                                    > 10 ? $videoDetails['items'][0]['snippet']['description']
//                                        : $videoDetails['items'][0]['snippet']['title'];
//                                $contentModel->media_id        = $videoDetails['items'][0]['id'];
//                                $contentModel->type            = "video";
//                                $contentModel->author          = $videoDetails['items'][0]['snippet']['channelTitle'];
//                                $contentModel->channel_name    = $videoDetails['items'][0]['kind'];
//                                $contentModel->is_ugc          = 1;
//                                $contentModel->thumb_image     = Utility::getThumbnails($videoDetails['items'][0]['snippet']['thumbnails']);
//                                $contentModel->alternate_image = Utility::getThumbnails($videoDetails['items'][0]['snippet']['thumbnails'],
//                                        'medium');
//                                $contentModel->status          = 'approved';
//                                $contentModel->media_url       = $model->url;
//
//                                /** Google User Info * */
//                                $contentModel->google_id             = $userInfoGoogle->googleId;
//                                $contentModel->google_displayname    = $userInfoGoogle->displayName;
//                                $contentModel->google_profilepicture = $userInfoGoogle->image;
//
//                                if ($contentModel->save()) {
//                                    Yii::app()->session['SubmissionForm'] = '';
//                                    unset($_POST['SubmissionForm']);
//                                    Yii::app()->user->setFlash('videoInformationSubmitted','<div class="CH-SubmissionsTextContainer"><div class="CH-Head acenter">Thank you for <br/>your submission</div> </div> <div class="CH-SubmitButton"><a href="'.Yii::app()->createUrl('/').'">Submit another video</a></div>');
//                                    $this->redirect(array('/pages/index'));
//                                    Yii::app()->end();
//                                }
//                            }
                        }
                    } catch (Exception $e) {
//                        Yii::app()->session['auth_token'] = null;
                        throw $e;
                    }
                } else {
                    //unset post | unset session
                    //set flash message & redirect
                    unset(Yii::app()->session['SubmissionForm']);
                    unset($_POST['SubmissionForm']);
                    Yii::app()->user->setFlash('invalidVideoUrl',
                        '<div class="acenter">Invalid or wrong Video Url. Only Youtube urls accepted.</div>');
                    $this->redirect(Yii::app()->createUrl("/"));
                    Yii::app()->end();
                }
            }
        }

        //fetch all the videos for the first page
        $brandVideos = $this->getCarouselContent();


        //baisc youtube playlist params
        $ytConfig = Yii::app()->params['YT_PlayList'];

        $ytParams = array(
            'api' => $ytConfig['apiKey'],
            'max' => $ytConfig['maxSize'],
            'cachexml' => $ytConfig['isCache'],
            'cachelife' => $ytConfig['cacheLifetime'],
            'xmlpath' => $ytConfig['cachePath'],
            'start' => 1,
            'descriptionlength' => 40,
            'titlelength' => 20
        );

        $videoPlayList = array();

        foreach (Yii::app()->params['YT_Faq_PlayListID'] as $id) {
            $obj = new CHPlaylist('playlist', $id, $ytParams);
            array_push($videoPlayList, $obj->getInstance());
        }

        //include the playlist js and css files
        //Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/path/to/your/javascript/file',CClientScript::POS_END);
        Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/vendor/youtubeplaylist.css');
        Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/vendor/youtubeplaylist-right-with-thumbs.css');

        //render the page
        $this->pagename = 'index';

        $this->render(
            $this->pagename,
            array(
            'model' => $model,
            'gallery' => $brandVideos,
            'aVideoList' => $videoPlayList
            )
        );
    }

    /**
     * Saves the Content information
     * @return bool
     */
    public function actionSave()
    {
        $videoInfo       = Yii::app()->getRequest()->getParam('params');
        $videoInfoObject = json_decode($videoInfo);
        $videoInfoArray  = array();
        foreach ($videoInfoObject as $videoObj) {
            $videoInfoArray[$videoObj->name] = $videoObj->value;
        }

        $response = array('status' => '', 'message' => '');
        if (!empty($videoInfoArray)) {
            $contentModel                        = new Content();
            $contentModel->username              = $videoInfoArray['username'];
            $contentModel->email                 = $videoInfoArray['email'];
            $contentModel->google_profile_url    = $videoInfoArray['google_profile_url'];
            $contentModel->google_profilepicture = $videoInfoArray['google_profile_image'];
            $contentModel->google_displayname    = $videoInfoArray['username'];
            $contentModel->media_id              = $videoInfoArray['YTVideoID'];
            $contentModel->thumb_image           = $videoInfoArray['YTVideoThumbURL'];
            $contentModel->alternate_image       = $videoInfoArray['YTVideoBigURL'];
            $contentModel->title                 = $videoInfoArray['YTVideoTitle'];
            $contentModel->description           = $videoInfoArray['YTVideoDescription'];
            $contentModel->channel_id            = $videoInfoArray['YTVideoChannelId'];
            $contentModel->channel_name          = $videoInfoArray['YTVideoChannelId'];
            $contentModel->author                = $videoInfoArray['name'];
            $contentModel->media_url             = "https://www.youtube.com/watch?v=".$videoInfoArray['YTVideoID'];
            $contentModel->is_ugc                = 1;
            $contentModel->status                = 'pending';
            $contentModel->google_id             = $videoInfoArray['google_id'];

            if ($contentModel->validate()) {
                try {
                    if ($contentModel->save()) {
                        $response['status']               = 'success';
                        $response['message']              = 'Content added successfully';
                        Yii::app()->session['submission'] = true;
                    }
                } catch (Exception $e) {
                    $response['status']               = 'fail';
                    $response['message']              = $e->getMessage();
                    Yii::app()->session['submission'] = false;
                }
            } else {
                $response['status']               = 'fail';
                $response['message']              = $contentModel->getErrors();
                Yii::app()->session['submission'] = false;
            }
        } else {
            $response['status']               = 'fail';
            $response['message']              = 'Empty Response.';
            Yii::app()->session['submission'] = false;
        }

        echo json_encode($response);
        exit;
    }

    /**
     * Action For Regsitration
     */
    public function actionParticipateForm()
    {
        $bucketUpload=false;
        $model    = new ParticipateForm();
        if (isset($_POST['ParticipateForm'])) {

            $model->attributes = $_POST['ParticipateForm'];
            
            $model->media_category=isset($_POST['ParticipateForm']['media_category']) ? $_POST['ParticipateForm']['media_category'] : 'All';

            
            if ($model->validate()) {

                $videoUploadPath=Yii::app()->basePath.Yii::app()->params['UPLOAD']['videodir'];

                /*
                 * Create The Directory if does not exist,remove in production.
                 */
                if (!file_exists($videoUploadPath)) {
                    mkdir($videoUploadPath, 0777, true);
                }

                $model->media_url = CUploadedFile::getInstance($model,'media_url');

                $uploadFile         = $videoUploadPath.$model->username.'_'.time().'_'.str_replace(' ','_', strtolower($model->media_url));

                $model->media_url->saveAs($uploadFile);

                $actual_image_name = time().'_'.baseName($uploadFile);

                $fileSize = $model->media_url->getSize();

                $fileType = $model->media_url->getType();


                
                /**
                 * Upload File To S3 Bucket
                 */
                if($bucketUpload){
                    
                     $s3 = new S3(Yii::app()->params['S3']['awsAccessKey'], Yii::app()->params['S3']['awsSecretKey']);

                    $s3bucketName=Yii::app()->params['S3']['bucket'];

                    try{
                         $s3->putObjectFile($uploadFile,$s3bucketName,$actual_image_name,S3::ACL_PUBLIC_READ);
                    }
                    catch(Exception $e){
                        $msg = $e->getMessage();
                        throw new Exception($msg);
                    }

                }
               
                /**
                 * Save To Db: Content
                 */
                $modelContent=new Content;
                $modelContent->username=$model->username;
                $modelContent->email=$model->email;
                $modelContent->share_url=$uploadFile;
                $modelContent->message=$model->message;
                $modelContent->media_title=$model->media_title;
                $modelContent->media_category=$model->media_category;
                $modelContent->mobile=$model->mobile;

                $transaction = Yii::app()->db->beginTransaction();

                try {
                    if ($modelContent->save()) {
                        $transaction->commit();
                    }else{
                         CVarDumper::dump($modelContent->getErrors(), 56789, true);
                        Yii::app()->end();
                    }
                   
                    
                } catch (Exception $e) {
                    $transaction->rollBack();
                    $msg = $e->getMessage();
                    throw new Exception($msg);
                }
            }
        }
        $this->pagename = "register";
        $this->render(
            $this->pagename, array(
            'model' => $model,
            )
        );
    }
}