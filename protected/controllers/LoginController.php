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
} 