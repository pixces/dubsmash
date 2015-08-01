<?php
// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return array(
    'basePath' => dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
    'name' => 'Dubsmash',
    // preloading 'log' component
    'preload' => array('log'),
    'import' => array(
        'application.models.*',
        'application.components.*',
        'application.vendor.*',
    ),
    // application components
    'components' => array(
        'db' => array(
            'connectionString' => 'mysql:host=127.0.0.1;port=8889;dbname=dubfest',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => 'root',
            'charset' => 'utf8',
            'enableParamLogging' => true,
        ),
//        'log' => array(
//            'class' => 'CLogRouter',
//            'routes' => array(
//                array(
//                    'class' => 'CFileLogRoute',
//                    'levels' => 'error, warning',
//                ),
//            ),
//        ),
    ),
    'params' => array(
        'S3DOWNLOADSDIR' => dirname(__FILE__).DIRECTORY_SEPARATOR.'../../s3downloads',
        'GOOGLE' => array(
            'CLIENT_ID' => '496126759562-g8c7h3i8lrp06doqaam9m6dlrpnd6tub.apps.googleusercontent.com',
            'SECRET' => 'i1c5oB1uCWZLgJNoHhAPINHa',
            'REDIRECT_URI' => 'urn:ietf:wg:oauth:2.0:oob',
        ),
        //S3 Buckets Credentials
        'S3' => array(
            'awsAccessKey' => 'AKIAIBZQI3223G5NK5KQ',
            'awsSecretKey' => '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',
            'bucket' => 'bnatural',
        ),
    ),
);
