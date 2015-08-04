<?php

/**
 * Author Syed Asfaquz Zaman'
 * Class S3ToYoutubeUploader
 * Description : Download Files Form S3 Bucket To Local Machine and then Upload To Youtube Channel
 */
class S3ToYoutubeCommand extends CConsoleCommand
{
    protected $googleClientId      = null;
    protected $googleSecretKey     = null;
    protected $googleRedirectUri   = null;
    protected $googleScope         = null;
    protected $googleAccessType    = null;
    protected $oGoogleService      = null;
    protected $oYoutubeService     = null;
    protected $sAuthUrl            = null;
    protected $sTokenFilePath      = null;
    protected $sRefreshToken       = null;
    protected $oS3Instance         = null;
    protected $sBucket             = null;
    protected $aAllowedFileTypes   = null;
    protected $aProcessedVideoList = null;
    protected $aVideoCategories    = null;
    protected $aMailToInfo         = null;

    const TOKEN_FILE_NAME = "client_token.json";
    

    public function init()
    {

        //set the timezone property
        date_default_timezone_set('UTC');

        $this->aProcessedVideoList = $this->__getProcessedVideos();

        $this->aAllowedFileTypes = array('flv', 'mp4', 'avi', 'mpg', 'wmv', 'webm',
            '3gp', '3g2', '3gpp', 'mov');

        $this->aVideoCategories = array(
            23 => 'comedy',
            10 => 'songs',
            24 => 'action',
            24 => 'drama',
            24 => 'just like that'
        );

        /*
         * Google Authentication
         */
        $this->sTokenFilePath    = dirname(__FILE__)."../../../".self::TOKEN_FILE_NAME;
        $this->googleClientId    = Yii::app()->params['GOOGLE']['CLIENT_ID'];
        $this->googleSecretKey   = Yii::app()->params['GOOGLE']['SECRET'];
        $this->googleRedirectUri = Yii::app()->params['GOOGLE']['REDIRECT_URI'];
        $this->googleScope       = array('https://www.googleapis.com/auth/plus.me', 'https://www.googleapis.com/auth/youtube');
        $this->googleAccessType  = 'offline';
        $this->oGoogleService    = $this->_getGoogleClientService();
    }

    public function run($argv)
    {
        if (empty($argv)) {
            print "###############################################".PHP_EOL;
            print "Error : No Argument Found.".PHP_EOL;

            print "1. To initialize/re-initilize google authentication code.".PHP_EOL." php S3ToYoutubeCron.php  s3toyoutube --refreshtoken=1".PHP_EOL;

            print "2. To upload videos to youtube.".PHP_EOL." php S3ToYoutubeCron.php  s3toyoutube --youtubeupload=1".PHP_EOL;

            print "###############################################".PHP_EOL;
            die;
        }
        foreach ($argv as $arg) {
            if (ereg('--([^=]+)=(.*)', $arg, $reg)) {
                $_ARG[$reg[1]] = $reg[2];
            } elseif (ereg('-([a-zA-Z0-9])', $arg, $reg)) {
                $_ARG[$reg[1]] = 'true';
            }
        }
        $aArguments = $_ARG;
        $action     = null;
        if (isset($aArguments['googletoken']) && $aArguments['googletoken'] == 1) {
            $action = "getAuthUrl";
        } elseif (isset($aArguments['youtubeupload']) && $aArguments['youtubeupload']
            == 1) {
            $action = "youtubeUpload";
        }

        if (isset($this->oGoogleService)) {
            $this->_setYoutubeService();
            if (isset($action)) {
                switch (strtolower($action)) {
                    case "getauthurl":
                        $this->sAuthUrl = $this->_createAuthUrl();
                        $this->_getGoogleAuthenticationCode();
                        break;

                    case "youtubeupload":
                        $this->_uploadVideoToYoutube();
                        break;
                }
            }
        }
    }

    private function _getGoogleClientService()
    {

        try {

            Yii::import(Yii::getPathOfAlias("application.vendor.Google.Client", true));
            $client = new Google_Client();
            $client->setClientId($this->googleClientId);
            $client->setClientSecret($this->googleSecretKey);
            $client->setRedirectUri($this->googleRedirectUri);
            $client->setScopes($this->googleScope);
            $client->setAccessType('offline');

            return $client;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    private function _createAuthUrl()
    {

        return $this->oGoogleService->createAuthUrl();
    }

    private function _setYoutubeService()
    {
        $this->oYoutubeService = new Google_Service_YouTube($this->oGoogleService);
    }

    private function _getGoogleAuthenticationCode()
    {
        print "Please visit:\n$this->sAuthUrl\n\n";
        print "Please enter the auth code:\n";
        $authCode         = trim(fgets(STDIN));
        $this->oGoogleService->authenticate($authCode);
        $oGoogleTokenInfo = new stdClass();
        $oGoogleTokenInfo = $this->oGoogleService->getAccessToken();
        $this->_writeTokenToFile($oGoogleTokenInfo);
        die;
    }

    private function _getGoogleRefreshToken()
    {
        $response   = ['error' => 0, 'message' => '', 'refresh_token' => ''];
        $str        = file_get_contents($this->sTokenFilePath);
        $aTokenInfo = json_decode($str, true);


        if (empty($aTokenInfo)) {
            $message = "Empty Token Info.Token File Conatin No Data";
            throw new Exception($message);
            die;
        }

        if (is_array($aTokenInfo)) {
            if (!isset($aTokenInfo['refresh_token'])) {
                $message = "No Refresh Token Index Exist In Token File.";
                throw new Exception($message);
                die;
            }
            $sRefreshToken    = $aTokenInfo['refresh_token'];
            $this->oGoogleService->refreshToken($sRefreshToken);
            return $oGoogleTokenInfo = $this->oGoogleService->getAccessToken();
        }
    }

    private function _writeTokenToFile($oGoogleTokenInfo)
    {
        try {
            if (file_put_contents($this->sTokenFilePath, $oGoogleTokenInfo)) {
                print "Google Client Token Data Saved To ".self::TOKEN_FILE_NAME.PHP_EOL;
                return;
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    private function _uploadVideoToYoutube()
    {
        $aVideoList = null;
        $uri        = null;
        if (!$this->oGoogleService->getAccessToken()) {
            $this->_getGoogleRefreshToken();
        }

        try {
            $aVideoList = $this->aProcessedVideoList;
            
            foreach ($aVideoList as $video) {
                $userName    = $video['username'];
                $drowId      = $video['id'];
                $userEmailId = $video['email'];
                $uri         = trim($video['media_alternate_url']);
               

                /**
                 * Check File Type Before Uploading To Youtube.
                 */
                $extension = pathinfo( $uri  , PATHINFO_EXTENSION);
                if (!in_array($extension, $this->aAllowedFileTypes)) {
                    $message = "Invalid File Extension.".PHP_EOL."Allowed File Types ".implode(',',
                            $this->aAllowedFileTypes).PHP_EOL;
                    print $message;
                    Yii::log(__FILE__."".__LINE__." Error: ".$message);
                    die;
                }
                ##################End Of File Extension Check ##########################
                $videoPath = dirname(__FILE__).'/../..'.$uri;

                // REPLACE this value with the path to the file you are uploading.
                //  $videoPath = Yii::app()->params['S3DOWNLOADSDIR'].DIRECTORY_SEPARATOR."test1.mp4";

                $fileSize = filesize($videoPath);

                $snippet = new Google_Service_YouTube_VideoSnippet();

                $dCategoryId           = in_array($video['media_category'], $this->aVideoCategories) ? array_search(strtolower($video['media_category']), $this->aVideoCategories) : '24';

                $snippet->setTitle($video['media_title']);
                $snippet->setDescription($video['message']);
                $snippet->setTags(array($video['media_category']));
                $snippet->setCategoryId($dCategoryId);

                $status                = new Google_Service_YouTube_VideoStatus();
                $status->privacyStatus = "public"; //public,private or unlisted

                // Associate the snippet and status objects with a new video resource.
                $video                 = new Google_Service_YouTube_Video();
                $video->setSnippet($snippet);
                $video->setStatus($status);

                // Specify the size of each chunk of data, in bytes. Set a higher value for
                // reliable connection as fewer chunks lead to faster uploads. Set a lower
                // value for better recovery on less reliable connections.
                $chunkSizeBytes = 1 * 1024 * 1024;

                // Setting the defer flag to true tells the client to return a request which can be called
                // with ->execute(); instead of making the API call immediately.
                $this->oGoogleService->setDefer(true);

                // Create a request for the API's videos.insert method to create and upload the video.
                $insertRequest = $this->oYoutubeService->videos->insert("status,snippet", $video);

                // Create a MediaFileUpload object for resumable uploads.
                $media = new Google_Http_MediaFileUpload(
                    $this->oGoogleService, $insertRequest, 'video/*', null, true, $chunkSizeBytes
                );
                $media->setFileSize($fileSize);

                // Read the media file and upload it chunk by chunk.
                print "\r\n Please wait uploading to youtube channel".PHP_EOL;
                $status = false;
                $handle = fopen($videoPath, "rb");
                while (!$status && !feof($handle)) {
                    print "$chunkSizeBytes uploaded ........".PHP_EOL;
                    $chunk  = fread($handle, $chunkSizeBytes);
                    $status = $media->nextChunk($chunk);
                }
                $message = "Uploading ".basename($videoPath)." completed.".PHP_EOL;
                print $message;
                fclose($handle);
                @unlink($videoPath);

                /**
                 * Youtube Video Infomation After Upload
                 */
                $ayoutubeUploadInfo = array();
                if (!empty($status)) {
                    $ayoutubeUploadInfo['rowid']                = $drowId;
                    $ayoutubeUploadInfo['username']             = $userName;
                    $ayoutubeUploadInfo['emailId']              = $userEmailId;
                    $ayoutubeUploadInfo['ytvid']                = $status->id;
                    $ayoutubeUploadInfo['ytvurl']               = "https://www.youtube.com/watch?v=".$status->id;
                    $ayoutubeUploadInfo['channel']['id']        = $status['snippet']['channelId'];
                    $ayoutubeUploadInfo['channel']['name']      = $status['snippet']['channelTitle'];
                    $ayoutubeUploadInfo['thumbnail']['default'] = $status['snippet']['thumbnails']['default']['url'];
                    $ayoutubeUploadInfo['thumbnail']['medium']  = $status['snippet']['thumbnails']['medium']['url'];

                    //update the database
                    //send acceptance emails
                    $this->__updateContentInfo($ayoutubeUploadInfo);
                }
                // If you want to make other calls after the file upload, set setDefer back to false
                $this->oGoogleService->setDefer(false);
                Yii::log(__FILE__."".__LINE__." Info: ".$message);
            }
        } catch (Google_ServiceException $e) {
            Yii::log(__FILE__."".__LINE__." Error: ".$e->getMessage());
            throw new Exception($e->getMessage());
            die;
        } catch (Google_Exception $e) {
            Yii::log(__FILE__."".__LINE__." Error: ".$e->getMessage());
            throw new Exception($e->getMessage());
            die;
        }
        $this->_getGoogleRefreshToken();
    }

   

    private function __getProcessedVideos($status = "processing")
    {
        $condition           = 'status=:status';
        $params['status']    = $status;
        $Criteria            = new CDbCriteria;
        $Criteria->condition = $condition;
        $Criteria->params    = $params;
        $Criteria->order     = "date_modified DESC";
        $oContent            = Content::model()->findAll($Criteria);
        if (empty($oContent)) {
            $message = "Empty Resultset no approved video contents".PHP_EOL;
            Yii::log(__FILE__."".__LINE__." Error: ".$message);
            print $message;
            die;
        }

        $aResult = array();
        foreach ($oContent as $row) {
            $aResult[] = ['email' => $row['email'], 'id' => $row['id'], 'media_alternate_url' => $row['media_alternate_url'],
                'media_title' => $row['media_title'], 'message' => $row['message'],
                'username' => $row['username'], 'media_category' => $row['media_category']];
        }
        return $aResult;
    }

    /**
     * Update Db content with Youtube Return Response
     * @param Array $aYoutubeVideoInfo
     * @return Boolean
     */

    private function __updateContentInfo($aYoutubeVideoInfo)
    {

        if (!empty($aYoutubeVideoInfo) && is_array($aYoutubeVideoInfo)) {

            $drowId          = $aYoutubeVideoInfo['rowid'];
            $name            = $aYoutubeVideoInfo['username'];
            $dvideoId        = $aYoutubeVideoInfo['ytvid'];
            $smediaUrl       = $aYoutubeVideoInfo['ytvurl'];
            $smediaImage     = $aYoutubeVideoInfo['thumbnail']['default'];
            $salternateImage = $aYoutubeVideoInfo['thumbnail']['medium'];
            $schannelName    = $aYoutubeVideoInfo['channel']['name'];
            $status          = "approved";
            $emailId         = $aYoutubeVideoInfo['emailId'];

            $aParams = array('media_id' => $dvideoId,
                'media_url' => $smediaUrl,
                'media_image' => $smediaImage,
                'alternate_image' => $salternateImage,
                'channel_name' => $schannelName,
                'status' => $status
            );

            try {
                Content::model()->updateByPk($drowId, $aParams);

                //send the acceptance email
                Mailer::Approved(array(
                    'to' => $emailId,
                    'data' => array('name' => $name)
                ));

            } catch (Exception $e) {
                print $e->getMessage();
            }
        }
        return;
    }

    /**
     * Send Approval Mail
     */

    private function __sendAcknowledgement()
    {
        if (!empty($this->aMailToInfo)) {
            foreach ($this->aMailToInfo as $mailContent) {
                Mailer::Approved(array(
                    'to' => $mailContent['email'],
                    'data' => $mailContent['data'],
                    'subject' => array('name' => $mailContent['username'])
                ));
            }
        }
    }
}
?>