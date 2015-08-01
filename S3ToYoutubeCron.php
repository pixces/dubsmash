<?php
//$domain = $_SERVER['SERVER_NAME'];
//$environment = ($domain == 'b2natural.local.com') ? 'dev' : 'production';
// change the following paths if necessary
$yii            = dirname(__FILE__).'/../yiiFramework/framework/yii.php';
$config         = dirname(__FILE__).'/protected/config/console-production.php';
$autoLoadGoogle = dirname(__FILE__).'/protected/vendor/Google/autoload.php';

require_once($autoLoadGoogle);
require_once($yii);
Yii::createConsoleApplication($config)->run();



