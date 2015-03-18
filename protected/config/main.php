<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
    'name'=>'Партнерская программа Павлуцкого Александра',

    // preloading 'log' component
    'preload' => array(
        'debug',
    ),
    //language for project
    'sourceLanguage'=>'ru',
    'language'=>'ru',

    // autoloading model and component classes
    'import'=>array(
        'application.models.*',
        'application.components.*',
    ),
    'modules'=>array(
        'gii'=>array(
            'class'=>'system.gii.GiiModule',
            'password'=>'123',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters'=>array('127.0.0.1','::1'),
        ),
        'user',
        'admin',
    ),

    // application components
    'components'=>array(
        'debug' => array(
            'class' => 'ext.yii2-debug.Yii2Debug',
        ),
        'settings'=>array(
            'class'=>'application.components.Settings',
        ),
        'request'=>array(
            'enableCookieValidation'=>true,
            'enableCsrfValidation'=>true,
        ),
        'user'=>array(
            // enable cookie-based authentication
            'allowAutoLogin'=>true,
            'loginUrl'=>array('user/user/login'),
            'class' => 'WebUser',
        ),
        'authManager' => array(
            // Будем использовать свой менеджер авторизации
            'class' => 'PhpAuthManager',
            // Роль по умолчанию. Все, кто не админы, модераторы и юзеры — гости.
            'defaultRoles' => array('guest'),
        ),
        // uncomment the following to enable URLs in path-format
        'urlManager'=>array(
            'class'=>'application.components.UrlManager',
            'urlFormat'=>'path',
            'urlSuffix'=>'.html',
            'showScriptName'=>false,
            'rules'=>array(
                '<language:(ru|uk)>/' => 'site/index',
                '<language:(ru|uk)>/<action:(contact|login|logout)>/*' => 'site/<action>',
                '<language:(ru|uk)>/<controller:\w+>/<id:\d+>'=>'<controller>/view',
                '<language:(ru|uk)>/<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
                '<language:(ru|uk)>/<controller:\w+>/<action:\w+>/*'=>'<controller>/<action>',
            ),
        ),
        'db'=>array(
            'connectionString' => 'mysql:host=magicseo.mysql.ukraine.com.ua;dbname=magicseo_alex',
            'emulatePrepare' => true,
            'username' => 'magicseo_alex',
            'password' => 'messi4991',
            'charset' => 'utf8',
        ),
        'errorHandler'=>array(
            // use 'site/error' action to display errors
            'errorAction'=>'site/error',
        ),
        'log'=>array(
            'class'=>'CLogRouter',
            'routes'=>array(
                array(
                    'class'=>'CFileLogRoute',
                    'levels'=>'error, warning',
                ),
                // uncomment the following to show log messages on web pages
                /*
                array(
                    'class'=>'CWebLogRoute',
                ),
                */
            ),
        ),
    ),

    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params'=>array(
        'languages'=>array('ru'=>'Русский', 'uk'=>'Українська'),
    ),
);