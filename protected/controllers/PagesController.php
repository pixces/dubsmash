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
    public function actionIndex(){
        $this->render('index');
    }

    /**
     * TVC action
     */
    public function actionTvc(){
        $this->render('tvc');
    }
    
}