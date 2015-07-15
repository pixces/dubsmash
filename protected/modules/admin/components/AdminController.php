<?php
class AdminController extends Controller {

    public $layout='main';

    /**
     * admins breadcrumbs
     */
    public $breadcrumbs = array();


    public function filters(){
        return array(
            'accessControl',
        );
    }

    public function accessRules(){
        return array(
            array(
                'allow', //allow authenticated admins for actions
                'users' => array('@'),
            ),
            array(
                'deny', //deny all users
                'users' => array('*'),
                'deniedCallback' => array($this, 'actionError')
            ),
        );
    }

    public function actionError(){

        if (Yii::app()->user->isGuest){
            return $this->redirect($this->createUrl('/login?next='.Yii::app()->request->requestUri));
        }

        if ($error = Yii::app()->errorHandler->error){
            if (Yii::app()->request->isAajxRequest){
                echo $error['message'];
            } else {
                $this->render('error',array('error'=>$error));
            }
        }
    }

}