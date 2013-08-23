<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Console Application',
	'language' => 'es_ar',
	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),
		
	// application components
	'components'=>array(
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=green',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
		),
		'db2'=>array(
					'class' => 'CDbConnection',
					'connectionString' => 'mysql:host=localhost;dbname=tapia',
					'emulatePrepare' => true,
					'username' => 'root',
					'password' => '',
					'charset' => 'utf8',
		),
		'lc'=>array(
			'class' => 'application.components.LocaleManager',
		),
	),
	
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