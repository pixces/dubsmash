<?php

class GalleryController extends Controller
{
    protected $gallerylimit = 50;

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'users' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Lists all content.
     */
    public function actionIndex()
    {
        /**
         * Parameter Object
         */
        $param             = new stdClass();
        $param->is_ugc     = 1;
        $param->status     = "approved";
        $param->fields     = ['description'];
        $page              = Yii::app()->getRequest()->getParam('page', 1);
        $ajaxRequest       = Yii::app()->getRequest()->getParam('isAjaxRequest',0);
        $galleryVideosJson = $this->loadGalleryVideos($param, $page);
        $galleryVideos     = json_decode($galleryVideosJson, true);

        //print_r($galleryVideos);

        /**
         * Load the Partial View as a String.
         */
        $videoContent = $this->renderPartial('_partialGalleryVideos', array('galleries' => $galleryVideos), true
        );

        /**
         * Check If the Request is Ajax and return the partial view as json object
         */
        if ($ajaxRequest && Yii::app()->request->isAjaxRequest) {
            echo json_encode(['content' => $videoContent, 'count' => count($galleryVideos), 'page' => $page]);
            Yii::app()->end();
        }
		
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
		
		foreach (Yii::app()->params['YT_PlayListID']['gallery'] as $sPlayListId) {
            $obj = new CHPlaylist('playlist', $sPlayListId, $ytParams);
            array_push($videoPlayList, $obj->getInstance());
        }
		
		//include the playlist js and css files
        //Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/path/to/your/javascript/file',CClientScript::POS_END);
        Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/vendor/youtubeplaylist.css');
        Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/vendor/youtubeplaylist-right-with-thumbs.css');
		
        /**
         * Normal Loading of the view ,and pass the partial view as String
         */
        $this->pagename = 'gallery';
        $this->render(
            'index',
            array(
                'videoContent' => $videoContent,
                'pageName' => 'gallery',
				'aVideoList' => $videoPlayList
            )
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $this->render('view',
            array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model = new Content;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Content'])) {
            $model->attributes = $_POST['Content'];
            if ($model->save())
                    $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Content'])) {
            $model->attributes = $_POST['Content'];
            if ($model->save())
                    $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl']
                        : array('admin'));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model             = new Content('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Content'])) $model->attributes = $_GET['Content'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Content the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = Content::model()->findByPk($id);
        if ($model === null)
                throw new CHttpException(404,
            'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Content $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'content-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    /**
     *
     * @param Object $paramObject
     * @param int $offset
     * @param int $limit
     * @return Object /protected/models/Content
     */
    protected function loadGalleryVideos($paramObject, $page = 1, $limit = null)
    {
        $columns     = [];
        $galleryData = [];
        if (isset($paramObject->fields)) {
            $columns = array_merge(Content::$defaultSelectableFields, $paramObject->fields);
        } else {
            $columns = Content::$defaultSelectableFields;
        }
        /**
         * Criteria Conditions
         */
        $Criteria            = new CDbCriteria;
        $Criteria->condition = 'is_ugc=:ugc AND status=:status';
        $Criteria->params    = array(':ugc' => $paramObject->is_ugc, 'status' => $paramObject->status);
        $Criteria->order     ='date_created DESC';

        //if no limit is passed .. use galleryLimit as limit
        if (isset($limit)){
            $limit = $limit;
        } else {
            $limit = $this->gallerylimit;
        }

        $Criteria->limit     = $limit;
        $Criteria->offset    = (($page - 1) * $limit);

        if (Content::model()->count($Criteria)) {
            $GalleryVideos = Content::model()->findAll($Criteria);
            foreach ($GalleryVideos as $videoRow) {
                $row = [];
                foreach($columns as $column) {
                    $row[$column] = $videoRow->$column;
                }
                $galleryData[] = $row;
            }
        }
        return json_encode($galleryData);
    }
}
