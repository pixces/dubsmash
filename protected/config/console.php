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
            'connectionString' => 'mysql:host=localhost;dbname=dubfest',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => 'admin',
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
            'CLIENT_ID' => '680270956746-s007puv4sfv2cb0c5sl735osekkj87tu.apps.googleusercontent.com',
            'SECRET' => 'ev_m6L6F8Y4BDcnABdpcby40',
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
