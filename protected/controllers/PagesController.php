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
     * Index Action
     * To display the Home Page of the application
     */
    public function actionIndex()
    {
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

            $model->media_category = isset($_POST['ParticipateForm']['media_category'])? $_POST['ParticipateForm']['media_category'] : 'All';

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

    public function actionRegister2()
    {
        print_r($_POST);
        print_r($_FILES);
        exit;
    }
}