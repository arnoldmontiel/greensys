<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
Yii::setPathOfAlias('highcharts', dirname(__FILE__).'/../extensions/highcharts');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'G r E e N',
	'language' => 'es_ar',
	// preloading 'log' component
	'preload'=>array('log','highcharts','bootstrap'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.controllers.*',
		'application.modules.srbac.controllers.SBaseController',		
		'ext.eoauth.*',
        'ext.eoauth.lib.*',
        'ext.lightopenid.*',
        'ext.eauth.*',
        'ext.eauth.services.*',
		'ext.eauth.custom_services.*',
		'application.modules.apigoogle.google-api-php-client.src.*',
		'application.modules.apigoogle.google-api-php-client.src.contrib.*',		
		'application.modules.apigoogle.google-api-php-client.src.service.*',
		'application.modules.apigoogle.google-api-php-client.src.io.*',
		'application.extensions.yii-mail.YiiMailMessage',
	),
	
	'localeDataPath'=>'protected/i18n/data/',

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'Arnold',
		 	// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
			'generatorPaths' => array(
						          'bootstrap.gii'
			),
		),

		'srbac' => array(
			'userclass'=>'User', //default: User
			'userid'=>'username', //default: userid
			'username'=>'username', //default:username
			'delimeter'=>'@', //default:-
			'debug'=>false, //default :false
			'pageSize'=>10, // default : 15
			'superUser' =>'Authorizer', //default: Authorizer
			'css'=>'srbac.css', //default: srbac.css
			'layout'=>'application.views.layouts.main', //default: application.views.layouts.main,
//must be an existing alias
			'notAuthorizedView'=> 'srbac.views.authitem.unauthorized', // default:
//srbac.views.authitem.unauthorized, must be an existing alias
			'alwaysAllowed'=>array( //default: array()
			'SiteLogin','SiteLogout',
			'SiteError','SiteLoginOld'),
			'prefixAlwaysAllowed'=>array( //default: array()
			'Ajax'),
			'userActions'=>array('Show','View','List'), //default: array()
			'listBoxNumberOfLines' => 15, //default : 10 'imagesPath' => 'srbac.images', // default: srbac.images 'imagesPack'=>'noia', //default: noia 'iconText'=>true, // default : false 'header'=>'srbac.views.authitem.header', //default : srbac.views.authitem.header,
//must be an existing alias 'footer'=>'srbac.views.authitem.footer', //default: srbac.views.authitem.footer,
//must be an existing alias 'showHeader'=>true, // default: false 'showFooter'=>true, // default: false
			'alwaysAllowedPath'=>'srbac.components', // default: srbac.components
// must be an existing alias
			)
		),

	// application components
	'components'=>array(
		'highcharts' => array('class' => 'highcharts.components.Highcharts'),
		'bootstrap' => array(
					    'class' => 'ext.bootstrap.components.Bootstrap',
					    'responsiveCss' => true,
		),
		'yexcel' => array(
		    'class' => 'ext.yexcel.Yexcel'
		),
		'mail' => array(
		 			'class' => 'ext.yii-mail.YiiMail',
		 			//'transportType' => 'php',
		 			'viewPath' => 'application.views.mail',
		 			'logging' => true,
		 			'dryRun' => false,
		 			'transportType' => 'smtp',
		 			'transportOptions' => array(
		 					'host' => 'smtp.gmail.com',
		 					'username' => 'amontiel@gruposmartliving.com',
		 					'password' => 'Arnold01',
		 					'port' => '465',
		 					'encryption'=>'tls',
		 			),
		),
		'loid' => array(
        	'class' => 'ext.lightopenid.loid',
		),

		'eauth' => array(
	        'class' => 'ext.eauth.EAuth',
            'popup' => false, // Use the popup window instead of redirecting.
			'cache' => 'cache', // Cache component name or false to disable cache. Defaults to 'cache'.
            'cacheExpire' => 0, // Cache lifetime. Defaults to 0 - means unlimited.
            'services' => array( // You can change the providers and their classes.     
                'google_oauth' => array(
                    // register your app here: https://code.google.com/apis/console/
                    'class' => 'CustomGoogleOAuthService',
                    'client_id' => '740580923589-mnpka332ukf9ilvtgqn0tvgfcci4v0n3.apps.googleusercontent.com',
                    'client_secret' => 'zhD-rtPm_EnLtT_fu50BIfjZ',
                    'access_type'=>'offline',
                    'title' => 'Login',
                ),
			),
		),

		'lc'=>array(
			'class' => 'application.components.LocaleManager',
		),

		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		// uncomment the following to enable URLs in path-format
		/*
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		*/
		/*
'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		*/
		'file'=>array(
	        'class'=>'application.extensions.file.CFile',
		),
		// uncomment the following to use a MySQL database
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=green',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => 'admin',
			'charset' => 'utf8',
		),
		'db2'=>array(
					'class' => 'CDbConnection',
					'connectionString' => 'mysql:host=localhost;dbname=tapia',
					'emulatePrepare' => true,
					'username' => 'root',
					'password' => 'admin',
					'charset' => 'utf8',
		),

		'authManager'=>array(
		// Path to SDbAuthManager in srbac module if you want to use case insensitive
		//access checking (or CDbAuthManager for case sensitive access checking)
					'class'=>'application.modules.srbac.components.SDbAuthManager',
		// The database component used
					'connectionID'=>'db',
		// The itemTable name (default:authitem)
					'itemTable'=>'items',
		// The assignmentTable name (default:authassignment)
					'assignmentTable'=>'assignments',
		// The itemChildTable name (default:authitemchild)
					'itemChildTable'=>'itemchildren',
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
		// this is used in contact page
		'hostname'=>'http://localhost',
		'adminEmail'=>'info@gruposmartliving.com',
		'database_format'=>array(
					'date'=>'yyyy-MM-dd',
					'time'=>'HH:mm:ss',
					'dateTimeFormat'=>'{1} {0}',
		),
	),
);


