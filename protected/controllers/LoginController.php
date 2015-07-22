<?php

/**
 * Created by PhpStorm.
 * User: zainulabdeen
 * Date: 27/06/15
 * Time: 12:29 AM
 */
class LoginController extends Controller
{

    //public $layout='//layouts/login';

    public function init()
    {
        parent::init();
    }

    public function actionIndex()
    {

        //redirect if a loggedin User
        //tries to access login url
        if (Yii::app()->user->id) {
            $this->redirect($this->createAbsoluteUrl('/admin/'));
            exit;
        }

        $model = new LoginForm;

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login())
                    $this->redirect(
                    Yii::app()->request->getParam('next',
                        $this->createAbsoluteUrl('/admin/'))
                );
        }

        // disable the default template
        $this->layout = false;

        // display the login form
        $this->render('index', array('model' => $model));
    }

    public function actionLogout()
    {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

    /**
     * Login Through Social Media 
     */
    public function actionSocialLogin()
    {

        $socialNetwork = Yii::app()->getRequest()->getParam('socialNetwork', '');

        if (isset($socialNetwork)) {
            switch ($socialNetwork) {
                case "facebook":
                    if (!isset(Yii::app()->session['eauth_profile'])) {
                        $oParams              = new stdClass();
                        $oParams->serviceName = "facebook";
                        $oParams->returnUrl   = Yii::app()->getBaseUrl(true).'/'.'site/login';
                        $oParams->cancelUrl   = $this->createAbsoluteUrl('site/login');
                        $aResponseJson        = Utility::socialMediaUserAuthentication($oParams);
                        $aResonse             = json_decode($aResponseJson, true);
                        if ($aResonse['error'] == 1 && $aResonse['status'] == false) {
                            $msg = $aResonse['message'];
                            throw new Exception($msg);
                        }
                    }
                case "google":
                    if (!isset(Yii::app()->session['eauth_profile'])) {
                        $oParams              = new stdClass();
                        $oParams->serviceName = "google";
                        $oParams->returnUrl   = Yii::app()->getBaseUrl(true).'/'.'login/socialLogin?socialNetwork=google';
                        $oParams->cancelUrl   = Yii::app()->getBaseUrl(true).'/'.'login/socialLogin?socialNetwork=google';

                        //print_r($oParams);exit;

                        $aResponseJson = Utility::socialMediaUserAuthentication($oParams);
                        $aResonse      = json_decode($aResponseJson, true);
                        if ($aResonse['error'] == 1 && $aResonse['status'] == false) {
                            $msg = $aResonse['message'];
                            throw new Exception($msg);
                        }
                    }

                default:

                    $this->redirect('register');
            }
        }
    }

    /**
     * Action For Regsitration
     */
    public function actionRegister()
    {

        // print_r($_FILES);exit;
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
            unset(Yii::app()->session['eauth_profile']);
        }
        $bucketUpload = false;
        $model        = new ParticipateForm();
        if (isset($_POST['ParticipateForm'])) {

            $model->attributes = $_POST['ParticipateForm'];

            $model->media_category = isset($_POST['ParticipateForm']['media_category'])
                    ? $_POST['ParticipateForm']['media_category'] : 'All';
            $model->media_url      = $_FILES['ParticipateForm']['name']['media_url'];

            if ($model->validate()) {

                $videoUploadPath = Yii::app()->basePath.Yii::app()->params['UPLOAD']['videodir'];
                $videoUploadPath = realpath($videoUploadPath);
                /*
                 * Create The Directory if does not exist,remove in production.
                 */
                if (!file_exists($videoUploadPath)) {
                    mkdir($videoUploadPath, 0777, true);
                }

                $model->media_url = CUploadedFile::getInstance($model,
                        'media_url');
                $newFileName      = $model->username.'_'.time().'_'.str_replace(' ',
                        '_', strtolower($model->media_url));
                $uploadFile       = $videoUploadPath.DIRECTORY_SEPARATOR.$newFileName;

                $model->media_url->saveAs($uploadFile);

                $actual_image_name = time().'_'.baseName($uploadFile);

                $fileSize = $model->media_url->getSize();

                $fileType = $model->media_url->getType();



                /**
                 * Upload File To S3 Bucket
                 */
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
                 * Save To Db: Content
                 */
                $modelContent                 = new Content;
                $modelContent->username       = $model->username;
                $modelContent->email          = $model->email;
                $modelContent->share_url      = $newFileName;
                $modelContent->message        = $model->message;
                $modelContent->media_title    = $model->media_title;
                $modelContent->media_category = $model->media_category;
                $modelContent->mobile         = $model->mobile;

                $transaction = Yii::app()->db->beginTransaction();

                try {
                    if ($modelContent->save()) {
                        $transaction->commit();
                        $aResponse = array('error' => 0, 'message' => 'Successfully Registered');
                        echo json_encode($aResponse);
                        Yii::app()->end();
                    } else {
                        $aResponse = array('error' => 0, 'message' => $modelContent->getErrors());
                        echo json_encode($aResponse);
                        //CVarDumper::dump($modelContent->getErrors(), 56789, true);
                        exit;
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                    $msg       = $e->getMessage();
                    $aResponse = array('error' => 0, 'message' => $msg);
                    echo json_encode($aResponse);
                    exit;
                    // throw new Exception($msg);
                }
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
}