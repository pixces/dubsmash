<?php

class AdminModule extends CWebModule
{
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application
        $this->layoutPath = Yii::getPathOfAlias('admin.views.layouts');


		// import the module-level models and components
		$this->setImport(array(
			'admin.components.*',
		));

        Yii::app()->setComponents(array(
            'errorHandler' => array(
                'errorAction'  => 'dashboard/default/error',
            )
        ));

        /* Make sure we run the init function */
        parent::init();
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	}
}
