<?php

/**
 * Description of Utility
 *
 * @author syed asfaquz Zaman
 */
class Utility
{
    /**
     * Google Api Key Value
     */
    const GOOGLE_API_KEY = 'AIzaSyBwMlVi54Fl0i7XuwoC0oByaCFOEaD7Mj8';

    /**
     * YOUTUBE API
     *
     * URL: https://www.googleapis.com/youtube/v3/videos?id=7lCDEYXw3mM&key=YOUR_API_KEY
      &fields=items(id,snippet(channelId,title,categoryId),statistics)&part=snippet,statistics
     *
     */
    const YOUTUBE_API_URL = 'https://www.googleapis.com/youtube/v3/videos';

    /**
     * Function : Fetch YouTube Video Information
     * @param String $videoUrl
     */
    public static function fetchYouTubeVideoDetails($videoUrl = '')
    {
        $reponse = [];
        if (self::url_exists($videoUrl)) {
            $videoId       = self::getYouTubeIdFromURL($videoUrl);
            $youtubeApiUrl = self::generateYouTubeApiUrl($videoId);
            $curl          = curl_init($youtubeApiUrl);
            $userAgent     = 'Mozilla/5.0 (Windows NT 5.1; rv:31.0) Gecko/20100101 Firefox/31.0';
            curl_setopt($curl, CURLOPT_URL, $youtubeApiUrl);
            curl_setopt($curl, CURLOPT_USERAGENT, $userAgent);
            curl_setopt($curl, CURLOPT_TIMEOUT, 100);
            curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 100);
            curl_setopt($curl, CURLOPT_ENCODING, 'gzip,deflate');
            curl_setopt($curl, CURLOPT_AUTOREFERER, true);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            try {
                $result  = curl_exec($curl);
                $reponse = ['error' => false, 'result' => $result, 'message' => 'Ok'];
            } catch (Exception $e) {
                $reponse = ['error' => true, 'message' => $e->getMessage()];
            }
        } else {
            $reponse = ['error' => true, 'message' => 'Invalid Youtube Url'];
        }
        return json_encode($reponse);
    }

    /**
     *
     * @param String $url
     * @return boolean
     */
    public static function url_exists($url)
    {
        $exists       = false;
        $file_headers = @get_headers($url);
        if ($file_headers[0] == 'HTTP/1.1 404 Not Found') {
            $exists = false;
        } else {
            $exists = true;
        }
        return $exists;
    }

    /**
     *
     * @param String $url
     * @return String youtube videoId / false
     */
    public static function getYouTubeIdFromURL($url)
    {
        $args       = [];
        $url_string = parse_url($url, PHP_URL_QUERY);
        parse_str($url_string, $args);
        return isset($args['v']) ? $args['v'] : false;
    }

    /**
     *
     * @param String $videoId
     * @return string $youtubeApiUrl
     */
    public static function generateYouTubeApiUrl($videoId)
    {
        $youtubeApiUrl = '';
        if (isset($videoId)) {
            $youtubeApiUrl = self::YOUTUBE_API_URL;
            $youtubeApiUrl.="?id=$videoId";
            $youtubeApiUrl.="&key=".self::GOOGLE_API_KEY;
            // $youtubeApiUrl.="&fields=items(id,snippet(channelId,title,categoryId),statistics)";
            $youtubeApiUrl.="&part=snippet,statistics";
        }

        return $youtubeApiUrl;
    }

    /**
     *
     * @param Array $thumbnailArray
     * @param String $size
     * @return String url
     */
    public static function getThumbnails($thumbnailArray, $size = 'default')
    {
        $thumbImage              = '';
        $availableThumbnailsSize = ['default', 'medium', 'high'];
        if (in_array($size, $availableThumbnailsSize)) {
            return $thumbImage = $thumbnailArray[$size]['url'];
        }
        return $thumbImage;
    }

    public static function isValidYoutubeUrl($url)
    {
        $parts = parse_url($url);
        return stristr($parts['host'], 'youtube');
    }

    public static function socialMediaUserAuthentication($oParams)
    {
        $aResponse=['status'=>false,'message'=>'','error'=>0];
        $serviceName = $oParams->serviceName;
        $returnUrl   = $oParams->returnUrl;
        $cancelUrl   = $oParams->cancelUrl;
        if (isset($serviceName)) {
            /** @var $eauth EAuthServiceBase */
            $eauth = Yii::app()->eauth->getIdentity($serviceName);
            //$eauth->redirectUrl = Yii::app()->user->returnUrl;

            Yii::app()->user->returnUrl = $returnUrl;
            $eauth->redirectUrl         = Yii::app()->user->returnUrl;
            $eauth->cancelUrl           = $cancelUrl;

            try {
                if ($eauth->authenticate()) {
                    $identity = new EAuthUserIdentity($eauth);
                    // successful authentication
                    if ($identity->authenticate()) {
                        Yii::app()->user->login($identity);
                        $session                  = Yii::app()->session;
                        $session['eauth_profile'] = $eauth->attributes;
                        $aResponse=['status'=>true,'message'=>'User Authenticated Successfully.','error'=>0];
                    } else {
                       
                        $aResponse=['status'=>false,'message'=>"User can't be authenticated.",'error'=>1];
                    }
                }

                else{
                    $aResponse=['status'=>false,'message'=>'Something went wrong.','error'=>1];
                }
            } catch (EAuthException $e) {
                $aResponse=['status'=>false,'message'=>$e->getMessage(),'error'=>1];
                
            }

            return json_encode($aResponse);
            
        }
    }
}