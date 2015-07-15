<?php
/**
 * Created by IntelliJ IDEA.
 * User: zainulabdeen
 * Date: 29/01/14
 * Time: 9:08 PM
 * To change this template use File | Settings | File Templates.
 */

return CMap::mergeArray(
    require(dirname(__FILE__) . '/main.php'),
    array(
        'components' => array(
            'db' => array(
                'connectionString' => 'mysql:host=localhost;dbname=dubfest',
                'emulatePrepare' => true,
                'username' => 'root',
                'password' => 'admin',
                'charset' => 'utf8',
                'enableParamLogging' => true,
            ),
            'log'=>array(
                'class'=>'CLogRouter',
                'routes'=>array(
                    array(
                        'class'=>'CFileLogRoute',
                        'levels'=>'error, warning',
                    ),
                    // comment the following to show log messages on web pages
                    array(
                        'class'=>'CWebLogRoute',
                    ),
                ),
            ),
            'GoogleApis' => array(

                'class' => 'ext.GoogleApis.GoogleApis',
                // See http://code.google.com/p/google-api-php-client/wiki/OAuth2
                'clientId' => '656601197353-or2q63gk1mv9no5i00qcap50rhgivqrb.apps.googleusercontent.com',
                'clientSecret' => 'OGQLKC6MON_Whhag-0SuHp8Z',
                'redirectUri' => 'http://localhost/comedyhunt/',
                // // This is the API key for 'Simple API Access'
                'developerKey' => 'AIzaSyAPSmKJjeV0vD4_b4teGIWzLVdiPHfxzWE',
            ),
        ),
        'modules' => array(
            'gii' => array(
                'class' => 'system.gii.GiiModule',
                'password' => 'position2',
                'ipFilters' => array('127.0.0.1', '::1'),
            ),
        ),
        'params' => array(
            's3AccessKey' => "AKIAI4PTFQAGUMKSMN3Q",
            's3SecretKey' => "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",
            's3Bucket' => "cnkugc",
            //youtube playlist configuration
            'YT_PlayList' => array(
                'maxSize' => 50,
                'isCache' => true,
                'cacheLifetime' => 86400,
                'cachePath' => dirname(__FILE__)."/../runtime/cache/",
                'apiKey' => 'AIzaSyA4iw6xE5VRXg5c7s7JFcmlTO65gQIMjnE',
            ),
            'YT_Faq_PlayListID' => array(
                'PL548A047B9D0B4A7C'
            ),
            'GOOGLE' => array(
                'CLIENT_ID' => '656601197353-or2q63gk1mv9no5i00qcap50rhgivqrb.apps.googleusercontent.com',
                'SECRET'    => 'OGQLKC6MON_Whhag-0SuHp8Z',
                'DEVELOPER_KEY'=> 'AIzaSyAPSmKJjeV0vD4_b4teGIWzLVdiPHfxzWE',
                'CALLBACK_URL' => 'http://localhost/comedyhunt/authenticate/',
            ),

        ),
    )
);