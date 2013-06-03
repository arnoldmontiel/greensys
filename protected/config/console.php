<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Console Application',
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
	),
);