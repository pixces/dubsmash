<?php

class SiteController extends Controller
{
    public $layout='//layouts/static';

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

    public function actionMail(){

        Mailer::SendAcknowledgement(array(
            'to' => 'sherin@position2.com',
            'data' => array(
                'name' => 'Sherin Jacob'
            )
        ));
    }
}