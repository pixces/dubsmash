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
    protected $sS3FilesDownloadDir = null;
    protected $aAllowedFileTypes   = null;

    const TOKEN_FILE_NAME = "client_token.json";
    const S3_DOWNLOAD_DIR = "downloads";

    public function init()
    {

        /**
         * S3 Instance 
         */
        $awsAccessKey              = Yii::app()->params['S3']['awsAccessKey'];
        $awsSecretKey              = Yii::app()->params['S3']['awsSecretKey'];
        $this->sBucket             = Yii::app()->params['S3']['bucket'];
        $this->oS3Instance         = new S3($awsAccessKey, $awsSecretKey);
        $this->sS3FilesDownloadDir = Yii::app()->params['S3DOWNLOADSDIR'].DIRECTORY_SEPARATOR;

        $this->aAllowedFileTypes = ['flv', 'mp4', 'avi', 'mpg', 'wmv', 'webm',
            '3gp', '3g2', '3gpp', 'mov'];
        /*
         * Google Authentication
         */
        $this->sTokenFilePath    = dirname(__FILE__)."../../../".self::TOKEN_FILE_NAME;
        $this->googleClientId    = Yii::app()->params['GOOGLE']['CLIENT_ID'];
        $this->googleSecretKey   = Yii::app()->params['GOOGLE']['SECRET'];
        $this->googleRedirectUri = Yii::app()->params['GOOGLE']['REDIRECT_URI'];
        $this->googleScope       = ['https://www.googleapis.com/auth/plus.me',
            'https://www.googleapis.com/auth/youtube'
        ];
        $this->googleAccessType  = 'offline';
        $this->oGoogleService    = $this->_getGoogleClientService();
    }

    public function run($argv)
    {

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

            Yii::import(Yii::getPathOfAlias("application.vendor.Google.Client",
                    true));
            $client = new Google_Client();
            $client->setClientId($this->googleClientId);
            $client->setClientSecret($this->googleSecretKey);
            $client->setRedirectUri($this->googleRedirectUri);
            $client->setScopes($this->googleScope);
            $client->setAccessType('offline');

            return $client;
        } catch (Exception $e) {
            throw $e->getMessage();
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
            throw $e->getMessage();
        }
    }

    private function _uploadVideoToYoutube()
    {

        if (!$this->oGoogleService->getAccessToken()) {
            $this->_getGoogleRefreshToken();
        }


        try {
            $uri        = "All_1437668186_SampleVideo_1080x720_1mb.mp4";
            $S3JsonInfo = $this->_downloadFilesFromS3($uri);
            $aS3Info    = json_decode($S3JsonInfo, true);
            if ($aS3Info['error'] == 1) {

                print "Error: ".$aS3Info['message'];
                die;
            }

            /**
             * Check File Type Before Uploading To Youtube.
             */
            $extension = pathinfo($aS3Info['filePath'], PATHINFO_EXTENSION);
            if (!in_array($extension, $this->aAllowedFileTypes)) {
                $message = "Invalid File Extension.".PHP_EOL."Allowed File Types ".implode(',',
                        $this->aAllowedFileTypes).PHP_EOL;
                print $message;
                die;
            }
            ##################End Of File Extension Check ##########################


            $videoPath = $aS3Info['filePath'];

            // REPLACE this value with the path to the file you are uploading.
            //  $videoPath = Yii::app()->params['S3DOWNLOADSDIR'].DIRECTORY_SEPARATOR."test1.mp4";

            $fileSize = filesize($videoPath);

            $snippet = new Google_Service_YouTube_VideoSnippet();
            $snippet->setTitle("Demo Video 1");
            $snippet->setDescription("Demo Demo Demo DEmo");
            $snippet->setTags(array("Demo status", "PHP", "demo", "oauth"));
            $snippet->setCategoryId("27"); //category - education


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
            $insertRequest = $this->oYoutubeService->videos->insert("status,snippet",
                $video);

// Create a MediaFileUpload object for resumable uploads.
            $media = new Google_Http_MediaFileUpload(
                $this->oGoogleService, $insertRequest, 'video/*', null, true,
                $chunkSizeBytes
            );
            $media->setFileSize($fileSize);


            // Read the media file and upload it chunk by chunk.

            print "Please wait uploading initiated".PHP_EOL;
            $status = false;
            $handle = fopen($videoPath, "rb");
            while (!$status && !feof($handle)) {
                print "$chunkSizeBytes uploaded ........".PHP_EOL;
                $chunk  = fread($handle, $chunkSizeBytes);
                $status = $media->nextChunk($chunk);
            }
            print "Uploading ".basename($videoPath)." completed.".PHP_EOL;
            fclose($handle);

            // If you want to make other calls after the file upload, set setDefer back to false
            $this->oGoogleService->setDefer(false);
        } catch (Google_ServiceException $e) {
            throw new Exception($e->getMessage());
            die;
        } catch (Google_Exception $e) {

            throw new Exception($e->getMessage());
            die;
        }

        $this->_getGoogleRefreshToken();
    }

    private function _downloadFilesFromS3($uri, $savelocation = null)
    {
        $fileName = null;
        $response = ['error' => 1, 'filePath' => '', 'message' => ''];
        if (is_null($savelocation)) {
            $savelocation = $this->sS3FilesDownloadDir;
        }
        $fileName = basename($uri);
        $savelocation .=$fileName;
        try {
            if (($object = S3::getObject($this->sBucket, $uri, $savelocation)) !== false) {
                if ($object->code == 200) {
                    $response = ['error' => 0, 'filePath' => $savelocation, 'message' => 'Ok'];
                }
            }
        } catch (Exception $e) {
            $response = ['error' => 1, 'message' => $e->getMessage()];
        }

        return json_encode($response);
    }
}
?>