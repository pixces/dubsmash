<?php
/**
 * Created by IntelliJ IDEA.
 * User: zainulabdeen
 * Date: 29/01/14
 * Time: 9:08 PM
 * To change this template use File | Settings | File Templates.
 */
return CMap::mergeArray(
        require(dirname(__FILE__).'/main.php'),
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
            'log' => array(
                'class' => 'CLogRouter',
                'routes' => array(
                    array(
                        'class' => 'CFileLogRoute',
                        'levels' => 'error, warning',
                    ),
                ),
            ),
            //EAuth For Social Media Authentications
            'eauth' => array(
                'class' => 'ext.eauth.EAuth',
                //'popup' => false,
                'services' => array(
                    //Google
                    'google' => array(
                        // register your app here: https://code.google.com/apis/console/
                        'class' => 'GoogleOAuthService',
                        'client_id' => '175405591801-md5i4q8l7ntlgn51thsj7lb8n3075sld.apps.googleusercontent.com',
                        'client_secret' => 'HTiRs_Z9j0SMwoo3tFj5J9eK',
                        'title' => 'Google (OAuth2)',
                    ),
                    //Facebook
                    'facebook' => array(
                        // register your app here: https://developers.facebook.com/apps/
                        'class' => 'FacebookOAuthService',
                        'client_id' => '718458091615558',
                        'client_secret' => '05b244a14eb132866106d7981141bdbe',
                    ),
                ),
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
            //S3 Buckets Credentials
            'S3' => array(
                'awsAccessKey' => 'AKIAJH5ZGO6NVLVOUS4A',
                'awsSecretKey' => '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',
                'bucket' => '/p2-data/p2-slice/',
            ),
            //Local File Upload Directory
            'UPLOAD' => array(
                'videodir' => '/../uploads/',
            ),
        ),
        )
);
