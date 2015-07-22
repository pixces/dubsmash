<?php
/**
 * Created by PhpStorm.
 * User: zainulabdeen
 * Date: 27/06/15
 * Time: 12:29 AM
 */

class LoginController extends Controller{

    //public $layout='//layouts/login';

    public function init(){
        parent::init();
    }


    public function actionIndex(){

        //redirect if a loggedin User
        //tries to access login url
        if (Yii::app()->user->id){
            $this->redirect($this->createAbsoluteUrl('/admin/'));
            exit;
        }

        $model=new LoginForm;

        // if it is ajax validation request
        if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if(isset($_POST['LoginForm']))
        {
            $model->attributes=$_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if($model->validate() && $model->login())
                $this->redirect(
                    Yii::app()->request->getParam('next', $this->createAbsoluteUrl('/admin/'))
                );
        }

        // disable the default template
        $this->layout = false;

        // display the login form
        $this->render('index',array('model'=>$model));
    }

    public function actionLogout(){
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

    /**
     * Login Through Social Media 
     */
    public function actionSocialLogin()
    {

        $socialNetwork = Yii::app()->getRequest()->getParam('socialNetwork','');

        if(isset( $socialNetwork )){
            switch($socialNetwork){
                case "facebook":
                    if (!isset(Yii::app()->session['eauth_profile'])){
                        $oParams              = new stdClass();
                        $oParams->serviceName = "facebook";
                        $oParams->returnUrl   = Yii::app()->getBaseUrl(true).'/'.'site/login';
                        $oParams->cancelUrl   = $this->createAbsoluteUrl('site/login');
                        $aResponseJson        = Utility::socialMediaUserAuthentication($oParams);
                        $aResonse             = json_decode($aResponseJson, true);
                        if ($aResonse['error'] == 1 && $aResonse['status']==false) {
                             $msg= $aResonse['message'];
                            throw new Exception($msg);
                        }
                    }
                    break;
                case "google":
                     if (!isset(Yii::app()->session['eauth_profile'])){
                        $oParams              = new stdClass();
                        $oParams->serviceName = "google";
                        $oParams->returnUrl   = Yii::app()->getBaseUrl(true).'/'.'login/socialLogin?socialNetwork=google';
                        $oParams->cancelUrl   = Yii::app()->getBaseUrl(true).'/'.'login/socialLogin?socialNetwork=google';

                        //print_r($oParams);exit;

                        $aResponseJson        = Utility::socialMediaUserAuthentication($oParams);
                        $aResonse             = json_decode($aResponseJson, true);
                        if ($aResonse['error'] == 1 && $aResonse['status']==false) {
                             $msg= $aResonse['message'];
                            throw new Exception($msg);
                        }
                    }
                    break;
                default:
                $this->redirect($this->createAbsoluteUrl('/register'));
                    break;
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

} 