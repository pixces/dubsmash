<?php

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
     * @var int
     */
    protected $dCarouselPageCount = 0;

    /**
     * @var array
     */
    protected $aCarasouleData = array();

    /**
     * Index Action
     * To display the Home Page of the application
     */
    public function actionIndex()
    {
        $this->getCarouselContent();

        $this->render('index');
    }

    /**
     * TVC action
     */
    public function actionTvc()
    {
        $this->render('tvc');
    }

    /**
     * Action For Regsitration
     */
    public function actionRegister()
    {

        $aSocialNetworkInfo = [];
        if (isset(Yii::app()->session['eauth_profile'])) {

            $session = Yii::app()->session['eauth_profile'];
            /**
             * Facebook
             */
            if (isset(Yii::app()->session['eauth_profile']['first_name'])) {
                $socialNetworkUsername = Yii::app()->session['eauth_profile']['first_name'].' '.Yii::app()->session['eauth_profile']['last_name'];
            }
            /**
             * Google
             */ else if (isset(Yii::app()->session['eauth_profile']['name'])) {
                $socialNetworkUsername = Yii::app()->session['eauth_profile']['name'];
            }

            $socialNetworkEmail          = Yii::app()->session['eauth_profile']['email'];
            $aSocialNetworkInfo['name']  = $socialNetworkUsername;
            $aSocialNetworkInfo['email'] = $socialNetworkEmail;
        }
        $bucketUpload = false;
        $model        = new ParticipateForm();
        if (isset($_POST['ParticipateForm'])) {

            $model->attributes = $_POST['ParticipateForm'];

            $model->media_category = isset($_POST['ParticipateForm']['media_category'])
                    ? $_POST['ParticipateForm']['media_category'] : 'All';

            $model->media_url = $_FILES['file_0']['name'];

            if ($model->validate()) {

                /**
                 * Upload File To S3 Bucket
                 */
                /**
                 * Replace it with original file url from S3 Bucket
                 */
                $share_url = "http://s3.amazonaws.com/p2-data/p2-slice/All_1437668186_SampleVideo_1080x720_1mb.mp4";
                if ($bucketUpload) {

                    $s3 = new S3(Yii::app()->params['S3']['awsAccessKey'],
                        Yii::app()->params['S3']['awsSecretKey']);

                    $s3bucketName = Yii::app()->params['S3']['bucket'];

                    try {
                        $s3->putObjectFile($uploadFile, $s3bucketName,
                            $actual_image_name, S3::ACL_PUBLIC_READ);
                    } catch (Exception $e) {
                        $msg = $e->getMessage();
                        throw new Exception($msg);
                    }
                }

                /**
                 * Save To Db: Content,if any attributes removed from here then please remove from Content model requyire rule also
                 */
                $modelContent                 = new Content;
                $modelContent->username       = $model->username;
                $modelContent->email          = $model->email;
                $modelContent->share_url      = $share_url;
                $modelContent->message        = $model->message;
                $modelContent->media_title    = $model->media_title;
                $modelContent->media_category = $model->media_category;
                $modelContent->mobile         = $model->mobile;

                $transaction = Yii::app()->db->beginTransaction();

                try {
                    if ($modelContent->save()) {
                        $transaction->commit();
                        if (isset(Yii::app()->session['eauth_profile'])) {
                            unset(Yii::app()->session['eauth_profile']);
                        }

                        $aResponse = array('error' => 0, 'message' => 'Successfully Registered');
                        echo json_encode($aResponse);
                        Yii::app()->end();
                    } else {
                        $message = null;
                        $errors  = $modelContent->getErrors();
                        foreach ($errors as $key => $error) {
                            $message .=$error[0].PHP_EOL;
                        }
                        $aResponse = array('error' => 1, 'message' => $modelContent->getErrors(),);
                        echo json_encode($aResponse);
                        //CVarDumper::dump($modelContent->getErrors(), 56789, true);
                        exit;
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                    $msg       = $e->getMessage();
                    $aResponse = array('error' => 1, 'message' => $msg);
                    echo json_encode($aResponse);
                    exit;
                    // throw new Exception($msg);
                }
            } else {


                // CVarDumper::dump($model->getErrors(), 56789, true);
                //exit;
                $errors  = $model->getErrors();
                $message = null;
                foreach ($errors as $key => $error) {
                    $message .=$error[0].PHP_EOL;
                }
                $aResponse = array('error' => 1, 'message' => $model->getErrors());
                echo json_encode($aResponse);
                exit;
            }
        }
        $this->pagename = "register";
        $this->render(
            $this->pagename,
            array(
            'model' => $model,
            'socialNetworkInfo' => $aSocialNetworkInfo
            )
        );
    }

    public function actionVoting()
    {

        if (Yii::app()->request->isAjaxRequest) {
            $response    = ['error' => 1, 'message' => '', 'votecount' => 0];
            $cookieIsSet = Yii::app()->getRequest()->getParam('cookieSet');
            $contentId   = Yii::app()->getRequest()->getParam('videoId', '');
            if ($cookieIsSet) {
                $encryptedUserInfo = $_COOKIE["USERINFO"];
                $userDecryptInfo   = Utility::mc_decrypt($encryptedUserInfo,
                        Yii::app()->params['ENCRYPTION_KEY']);
                $userInfo          = json_decode($userDecryptInfo, true);
                $email             = $userInfo['email'];
                $name              = $userInfo['name'];
            } else {
                $name              = Yii::app()->getRequest()->getParam('name',
                    '');
                $email             = Yii::app()->getRequest()->getParam('email',
                    '');
                $data              = json_encode(['name' => $name, 'email' => $email]);
                $encryptedUserInfo = Utility::mc_encrypt($data,
                        Yii::app()->params['ENCRYPTION_KEY']);
                ob_start();
                setcookie("USERINFO", $encryptedUserInfo,
                    time() + (10 * 365 * 24 * 60 * 60), '/');
                ob_end_flush();
            }
            $dVotingStatus          = $this->_checkIfUserVoted($contentId,
                $email, $name);
            $dTotalContentVote      = 0;
            $dTotalContentVoteCount = 0;
            if ($dVotingStatus == 0) {
                try {
                    $model             = new ContentVotes();
                    $model->content_id = $contentId;
                    $model->email      = $email;
                    $model->username   = $name;
                    $model->user_ip    = Yii::app()->request->getUserHostAddress();
                    $model->date       = new CDbExpression('NOW()');
                    if ($model->save()) {
                        $dTotalContentVote      = $this->_getContentTotalVote($contentId);
                        $dTotalContentVoteCount = ($dTotalContentVote) ? $dTotalContentVote
                            + 1 : 1;

                        Content::model()->updateByPk($contentId,
                            array("vote" => $dTotalContentVoteCount));


                        $response['error']     = 0;
                        $response['message']   = 'Voted';
                        $response['id']        = $contentId;
                        $response['votecount'] = $dTotalContentVoteCount;
                    } else {

                        $response['error']   = 1;
                        $response['message'] = $model->getErrors();
                    }
                } catch (Exception $e) {

                    $response['error']   = 1;
                    $response['message'] = $e->getMessage();
                }
            } else {
                $response['error']   = 1;
                $response['message'] = "Already Voted";
            }

            echo json_encode($response);
            Yii::app()->end();
        }
    }

    private function _checkIfUserVoted($contentId, $email, $username)
    {
        $response            = [];
        $params['id']        = $contentId;
        $params['email']     = $email;
        $params['username']  = $username;
        $count               = 0;
        $condition           = 'content_id=:id AND email=:email AND username=:username';
        $Criteria            = new CDbCriteria();
        $Criteria->condition = $condition;
        $Criteria->params    = $params;

        $result = ContentVotes::model()->find($Criteria);
        $count  = count($result);

        return $count;
    }

    private function _getContentTotalVote($contentId)
    {
        $response            = [];
        $count               = 0;
        $params['id']        = $contentId;
        $condition           = 'id=:id ';
        $Criteria            = new CDbCriteria();
        $Criteria->condition = $condition;
        $Criteria->params    = $params;

        $result = Content::model()->find($Criteria);
        if (count($result)) {
            $count = (int) $result->vote;
        }

        return $count;
    }

    /**
     * Method to get list of Viode
     * to be displayed on the Casousel for the Index page
     * @param null $params
     * @return array
     */
    protected function getCarouselContent($params = null)
    {

        $galleryData = array();
        $columns     = Content::$defaultSelectableFields;

        $Criteria           = new CDbCriteria;
        $Criteria->condition= 'is_ugc=:ugc AND status=:status';
        $Criteria->params   = array(':ugc' => 1, 'status' => 'approved');
        $Criteria->order    = 'vote DESC';
        $Criteria->limit    = 20;
        $Criteria->offset   = 0;

        if ( Content::model()->count($Criteria) ){
            $content = Content::model()->findAll($Criteria);
            $this->dCarouselPageCount = floor(count($content)/4);

            foreach ($content as $video) {
                $row = new stdClass();
                foreach ($columns as $column) {
                    $row->$column = $video->$column;
                }
                $galleryData[] = $row;
            }
        }
        $this->aCarasouleData = $galleryData;
        return $galleryData;
    }
}