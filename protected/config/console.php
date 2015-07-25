<?php
// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return array(
   
    'basePath' => dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
    'name' => 'Comedy Hunt',
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
        'S3DOWNLOADSDIR' =>  dirname(__FILE__) . DIRECTORY_SEPARATOR.'../../s3downloads',
        'GOOGLE' => array(
            'CLIENT_ID' => '175405591801-tc1sk4ith79vphrtudmpeuk8t63n2soa.apps.googleusercontent.com',
            'SECRET' => 'mzSmanpW3W3g-WoN7xrYyrtX',
            'DEVELOPER_KEY' => 'AIzaSyA7rybq4972tbwJ3zlTVe_CLkSlil-pwGQ',
            'REDIRECT_URI' => 'urn:ietf:wg:oauth:2.0:oob',
        ),
        //S3 Buckets Credentials
        'S3' => array(
            'awsAccessKey' => 'AKIAJH5ZGO6NVLVOUS4A',
            'awsSecretKey' => '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',
            'bucket' => '/p2-data/p2-slice',
        ),
       
    ),
);

