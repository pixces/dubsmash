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
                'password' => 'root',
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
            'GOOGLE' => array(
                'CLIENT_ID'     => '656601197353-or2q63gk1mv9no5i00qcap50rhgivqrb.apps.googleusercontent.com',
                'SECRET'        => 'OGQLKC6MON_Whhag-0SuHp8Z',
                'DEVELOPER_KEY' => 'AIzaSyAPSmKJjeV0vD4_b4teGIWzLVdiPHfxzWE',
                'CALLBACK_URL'  => 'http://localhost/comedyhunt/authenticate/',
            ),
            'FACEBOOK' => array(

            ),
            'awsS3' => array(
                'BUCKET'        => '/p2-data/p2-slice',
                'USER'          => 's3slice',
                'PASSWORD'      => 'M359Mc9GR2',
                'ACCESS_KET'    => 'AKIAJH5ZGO6NVLVOUS4A',
                'ACCESS_SECRET' => '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',
            ),
            'contentCategory' => array(
                'ACTION'        =>'action',
                'SONGS'         =>'songs',
                'HUMOR'         =>'humor',
                'DRAMA'         =>'drama'
            ),
        ),
    )
);