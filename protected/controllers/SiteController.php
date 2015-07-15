<?php

class SiteController extends Controller
{
    //public $layout='//layouts/default';

    /**
     * Declares class-based actions.
     */
    public function actions()
    {
        $this->pagename = 'page';

        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

    public function actionFaq()
    {
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

        /* foreach(Yii::app()->params['YT_Faq_PlayListID'] as $id){
          $obj = new CHPlaylist('playlist',$id,$ytParams);
          array_push($videoPlayList, $obj->getInstance() );
          } */

        foreach (Yii::app()->params['YT_PlayListID']['faq'] as $sPlayListId) {
            $obj = new CHPlaylist('playlist', $sPlayListId, $ytParams);
            array_push($videoPlayList, $obj->getInstance());
        }

        //include the playlist js and css files
        //Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/path/to/your/javascript/file',CClientScript::POS_END);
        Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/vendor/youtubeplaylist.css');
        Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/vendor/youtubeplaylist-right-with-thumbs.css');

        $this->pagename = 'faq';
        $this->render($this->pagename,
            array(
            //'video' => $video,
            //'video2' => $video2,
            'aVideoList' => $videoPlayList,
            'pageName' => 'faq'
            )
        );
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError()
    {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest) echo $error['message'];
            else $this->render('error', $error);
        }
    }

    public function actionLogin()
    {
        if (!isset(Yii::app()->session['eauth_profile'])) {
            $oParams              = new stdClass();
            $oParams->serviceName = "facebook";
            $oParams->returnUrl   = Yii::app()->getBaseUrl(true).'/'.'site/login';
            $oParams->cancelUrl   = $this->createAbsoluteUrl('site/login');
            $aResponseJson        = Utility::facebookUserAuthentication($oParams);
            $aResonse             = json_decode($aResponseJson, true);
            if ($aResonse['error'] == 0 && $aResonse['status']) {
                $this->redirect('/site/loadRegsiterForm');
            } else {
                echo $aResonse['message'];
                exit;
            }
        }
    }

    public function actionLoadRegsiterForm()
    {

        if (isset(Yii::app()->session['eauth_profile'])) {
            $session = Yii::app()->session['eauth_profile'];
            echo '<pre>';
            print_r($session);
            unset(Yii::app()->session['eauth_profile']);
        } else {
            $this->redirect('/site/register');
        }
    }

    public function actionRegister()
    {

        $this->redirect('/site/login');
    }
}