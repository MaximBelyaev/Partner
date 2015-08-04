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
    'sourceLanguage'=>'en',
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
        'request'=>array(
            'enableCookieValidation'=>true,
            'enableCsrfValidation'=>false,
        ),
        'email' => array(
            'class'=>'application.extensions.email.Email',
            'delivery' => 'php',
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
            //'urlSuffix'=>'.html',
            'showScriptName'=>false,
            'rules'=>array(
                '<language:(ru|uk)>/' => 'site/index',
                '<language:(ru|uk)>/<action:(contact|login|logout)>/*' => 'site/<action>',
                '<language:(ru|uk)>/<controller:\w+>/<id:\d+>'=>'<controller>/view',
                '<language:(ru|uk)>/<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
                '<language:(ru|uk)>/<controller:\w+>/<action:\w+>/*'=>'<controller>/<action>',
            ),
        ),
        'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=partner',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => '',
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
		'uploadPath' => '/uploamysql:host=localhost;dbname=rentalcontrol/',
		'activation' => 'activated',
		'dbsetup' => 'activated',
		'languages' => array('ru'=>'Русский', 'uk'=>'Українська','en'=>'English'),
		
		# это надо убрать из использования. процент будет браться из БД
		'adminName'  => 'Александр Павлуцкий',
		'adminEmail' => 'some.nugget@gmail.com',

		# отправлять письма партнерам, или нет
		'emailToUsers' => true,
		# приставка к отправленному письму о новой новости.
		'newsMailPrefix' => 'Партнерка по семантике: ',


		// количество точек, на которые мы разобьем ось Х на графике
		'chartTimePoints' => 15,
		'updateServer' => ($_SERVER['SERVER_NAME'] == 'prt.loc')?'http://prtserver.loc/api/':'http://prtserver.shvets.net/api/',
        'tests' => 'http://prtserver.shvets.net/api/tests'
	),
);