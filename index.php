<?php
$domain = $_SERVER['SERVER_NAME'];
$environment = ($domain == 'localhost') ? 'dev' : 'production';

// change the following paths if necessary
$yii=dirname(__FILE__).'/../yiiFramework/framework/yii.php';
$config=dirname(__FILE__).'/protected/config/'.$environment.'.php';
$autoLoadGoogle = dirname(__FILE__).'/protected/vendor/Google/autoload.php';


// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);

// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

require_once($autoLoadGoogle);

require_once($yii);
Yii::createWebApplication($config)->run();
