<?php
// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath' => dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
    'name' => 'B Natural DUBFEST | powered by Sangram Singh',
    'defaultController' => 'pages',
    // preloading 'log' component
    'preload' => array('log'),
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
        'application.vendor.*',
        'application.extensions.GoogleApis.*',
        'ext.eoauth.*',
        'ext.eoauth.lib.*',
        'ext.eauth.*',
        'ext.eauth.services.*',
        'application.extensions.s3upload.*',//S3 Bucket Plugin
        'ext.YiiMailer.YiiMailer',      //mailer component
    ),
    'modules' => array(
        'admin'
    ),
    // application components
    'components' => array(
        'user' => array(
            // enable cookie-based authentication
            'allowAutoLogin' => true,
        ),
       
        // uncomment the following to enable URLs in path-format
        'urlManager' => array(
            'urlFormat' => 'path',
            'showScriptName' => false,
            'caseSensitive' => false,
            'rules' => array(
                '/' => 'pages/index',
                '/watch-tvc' => 'pages/tvc',
                '/pages/index/<code:\w+>' => '/pages/index',
                '/authenticate/?<code:\w+>' => '/pages/authenticate',
                '/authenticate/' => '/pages/authenticate',
                'fbcallback/<code:\w+>' => 'pages/index',
                '/videos' => '/pages/videos',
                '/login/' => '/login/index',
                '/logout/' => '/login/logout',
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '/admin/<controller:\w+>/<id:\d+>' => '/admin/<controller>/view',
                '/admin/<controller:\w+>/<action:\w+>/<id:\d+>' => '/admin/<controller>/<action>',
                '/admin/<controller:\w+>/<action:\w+>' => '/admin/<controller>/<action>',
            ),
        ),
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),
    ),
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
        // this is used in contact page
        'adminEmail' => 'support@dubfest.bnatural.in',
        'extensions' => array(
            'MP4',
            'MPEG4',
            'AVI',
            'MOV',
            'JPG',
            'GIF',
            'PNG',
            'JPEG'
        ),
        'uploadMaxSize' => 10,
        'mailConfig' => array(
            'senderEmail' => 'dubfest.bnatural.in@gmail.com',
            'senderName' => 'Dubfest Support',
            'SubjectPrefix' => '[Dubfest] ',
            'SMTPAuth' => true,
            'SMTPHost' => 'smtp.gmail.com',
            'SMTPPort' => '587',
            'SMTPUser' => 'dubfest.bnatural.in@gmail.com',
            'SMTPPass' => 'bnatural123#'
        )
    ),
);
