<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

	<div id="header">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
		
		<?php echo CHtml::form('','post'); ?>
		Language: 
		<div id="language" >
		<?php
		echo Yii::app()->lc->getSelectedLanguage();
		Yii::app()->lc->setLanguage(isset($_POST['lang'])?$_POST['lang']:Yii::app()->lc->getSelectedLanguage());
		$data = Yii::app()->lc->getAvalaibleLanguages();
		$returnArr = array();
		$reg;
		
		foreach($data as $t)
		{
		
			$reg['id']=$t['lang'];
			$reg['text']= Yii::app()->lc->t($t['language']).'/'.Yii::app()->lc->t($t['region']);
			$returnArr[]= $reg;
		
		}
		
		echo CHtml::dropDownList('lang',isset($_POST['lang'])?$_POST['lang']:Yii::app()->lc->getSelectedLanguage(), CHtml::listData($returnArr, 'id', 'text'),array('submit'=>''));
		Yii::app()->lc->setLanguage(isset($_POST['lang'])?$_POST['lang']:Yii::app()->lc->getSelectedLanguage());
		
	    echo $_POST['lang'];
		?>
		</div>
	<?php CHtml::endForm(); ?>
	</div><!-- header -->

	<div id="mainmenu">
		<?php 
		$this->widget('application.extensions.mbmenu.MbMenu',array
		//$this->widget('zii.widgets.CMenu',array
		(
		'items'=>array
		(
			array('label'=>'Home', 'url'=>array('/site/index')),
			array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
			array('label'=>'Contact', 'url'=>array('/site/contact')),
			array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
			array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
			array('label'=>'Manage', 'visible'=>!Yii::app()->user->isGuest, 'items'=>array
			(
				//array('label'=>'User', 'url'=>array('/user', 'view'=>'manage')),
				array('label'=>'User', 'url'=>array('/user/index', 'view'=>'manage'),'visible'=>Yii::app()->user->checkAccess('ManejarUsuarios')),
				array('label'=>'Permissions', 'url'=>array('/srbac/authitem/frontpage', 'view'=>'manage'))
			)
		))
		
		)); 
		 ?>		
	
</div> <!-- mainmenu -->
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>
		
	<?php echo $content; ?>

<?php


//Yii::app()->setLanguage($lang);
echo Yii::t('green','Active record class "{class}" does not have a scope named "{scope}".');
?>
	<div class="clear"></div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
		All Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
