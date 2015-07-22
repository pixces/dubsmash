<?php

class GalleryController extends Controller
{
    protected $gallerylimit = 12;
    public $layout          = '//layouts/static';

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
        $page              = 1;
        $postParam         = Yii::app()->getRequest()->getParam('param', '');
        $ajaxRequest       = Yii::app()->getRequest()->getParam('isAjaxRequest',
            0);
        $param             = new stdClass();
        $param->status     = "approved";
        $param->fields     = ['share_url'];
        $galleryVideosJson = null;
        $galleryVideos     = null;

        if (is_array($postParam)) {
            if (isset($postParam['category'])) {
                $param->media_category = $postParam['category'];
            }
            if (isset($postParam['sort'])) {
                switch (strtolower($postParam['sort'])) {
                    case "latest":
                        $param->sort = "date_modified DESC";
                        break;

                    case "lastweek":
                        $monday           = strtotime("last monday");
                        $monday           = date('W', $monday) == date('W') ? $monday
                            - 7 * 86400 : $monday;
                        $sunday           = strtotime(date("Y-m-d H:i:s",
                                $monday)." +6 days");
                        $this_week_sd     = date("Y-m-d H:i:s", $monday);
                        $this_week_ed     = date("Y-m-d H:i:s", $sunday);
                        $param->daterange = ['startDate' => $this_week_sd, 'endDate' => $this_week_ed];
                        $param->sort      = "date_modified DESC";

                        break;
                    case "lastmonth":
                        $month_ini          = new DateTime("first day of last month");
                        $month_end          = new DateTime("last day of last month");
                        $lastMonthFirstDate = $month_ini->format('Y-m-d H:i:s');
                        $lastMonthEndDate   = $month_end->format('Y-m-d H:i:s');
                        $param->daterange   = ['startDate' => $lastMonthFirstDate,
                            'endDate' => $lastMonthEndDate];
                        $param->sort        = "date_modified DESC";

                        break;
                }
            }

            if (isset($postParam['title'])) {
                $param->media_title = $postParam['title'];
            }

            if (isset($postParam['offset'])) {
                $page = $postParam['offset'];
            }
        }


        $galleryVideosJson  = $this->loadGalleryVideos($param, $page);
        $galleryVideosArray = json_decode($galleryVideosJson, true);

        if ($ajaxRequest) {
            if (!empty($galleryVideosArray)) {
                $response['template']    = $this->renderPartial('_partialGalleryVideos',
                    array('galleries' => $galleryVideosArray['data']), true);
                $response['loader']      = $galleryVideosArray['loader'];
                $response['totalvideos'] = $galleryVideosArray['totalvideos'];
                $response['selectedcategory']=$galleryVideosArray['selectedcategory'];
                echo json_encode($response);
            }
            Yii::app()->end();
        }

        /**
         * Normal Loading of the view ,and pass the partial view as String
         */
        $this->pagename = 'gallery';
        $this->render(
            'index',
            [
            'galleries' => $galleryVideosArray['data'],
            'loader' => $galleryVideosArray['loader'],
            'totalvideos' => $galleryVideosArray['totalvideos'],
             'selectedcategory'=> $galleryVideosArray['selectedcategory'],
            'pageName' => 'gallery',
            //'aVideoList' => $videoPlayList
            ]
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
    protected function loadGalleryVideos($paramObject, $page = 1, $limit = 0)
    {
        $columns       = [];
        $totalvideos = 0;
        $selectedCategory=null;
        $galleryData   = [];
        if (isset($paramObject->fields)) {
            $columns = array_merge(Content::$defaultSelectableFields,
                $paramObject->fields);
        } else {
            $columns = Content::$defaultSelectableFields;
        }
        /**
         * Criteria Conditions
         */
        $params['status'] = $paramObject->status;
        $condition        = 'status=:status';
        $selectedCategory="all";
        if (isset($paramObject->media_category) && (strtolower($paramObject->media_category)
            != 'all')) {
            $condition.='   AND media_category=:media_category';
            $params['media_category'] = strtolower($paramObject->media_category);
            $selectedCategory=strtolower($paramObject->media_category);
        }

        if (isset($paramObject->media_title)) {
            $media_title           = addcslashes($paramObject->media_title, '%_');
            $condition.="   AND media_title LIKE :media_title";
            $params['media_title'] = "%$media_title%";
        }

        if (!isset($paramObject->sort)) {
            $paramObject->sort = "date_created DESC";
        }

        $Criteria            = new CDbCriteria;
        $Criteria->condition = $condition;
        $Criteria->params    = $params;
        $Criteria->order     = $paramObject->sort;


        if (isset($paramObject->daterange) && is_array($paramObject->daterange)) {
            $Criteria->addBetweenCondition('date_modified',
                $paramObject->daterange['startDate'],
                $paramObject->daterange['endDate']);
        }

        $contentResult    = Content::model()->findAll($Criteria);
        $totalVideosCount = count($contentResult);


        //if no limit is passed .. use galleryLimit as limit
        if (!empty($limit)) {
            $limit = $limit;
        } else {
            $limit = $this->gallerylimit;
        }
        $loaderVisibility = ($totalVideosCount > $limit) ? 1 : 0;
        $Criteria->limit  = $limit;
        $Criteria->offset = (($page - 1) * $limit);
        if (Content::model()->count($Criteria)) {
            $GalleryVideos = Content::model()->findAll($Criteria);

            if (count($GalleryVideos) == 0) {
                $loaderVisibility = 0;
            }
            foreach ($GalleryVideos as $videoRow) {
                $row = [];
                foreach ($columns as $column) {
                    $row[$column] = $videoRow->$column;
                }
                $galleryData[] = $row;
            }
        }
        $response = ['data' => $galleryData, 'loader' => $loaderVisibility, 'totalvideos' => $totalVideosCount,'selectedcategory'=>$selectedCategory];
        return json_encode($response);
    }
}