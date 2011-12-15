<!DOCTYPE html>
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
		
		
		<div id="language" >
		<?php
		echo Yii::app()->lc->t('Language: ');
		$data = Yii::app()->lc->getAvalaibleLanguages();
		$returnArr = array();
		$reg = array();
		foreach($data as $t)
		{
			$reg['id']=$t['lang'];
			$reg['text']= Yii::app()->lc->t($t['language']).'/'.Yii::app()->lc->t($t['region']);
			$returnArr[]= $reg;
		}
		$this->widget('LangBox',
		array(
						'languages'=>$returnArr,
						'selectedLanguage'=>isset($_POST['lang'])?$_POST['lang']:Yii::app()->lc->getSelectedLanguage())
		);
		?>
		</div>
	</div><!-- header -->

	<div id="mainmenu">
		<?php 
		$this->widget('application.extensions.mbmenu.MbMenu',array
		//$this->widget('zii.widgets.CMenu',array
		(
		'items'=>array
		(
			array('label'=>Yii::app()->lc->t('Home'), 'url'=>array('/site/index')),
			array('label'=>Yii::app()->lc->t('About'), 'url'=>array('/site/page', 'view'=>'about')),
			array('label'=>Yii::app()->lc->t('Contact'), 'url'=>array('/site/contact')),
			array('label'=>Yii::app()->lc->t('Login'), 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
			array('label'=>Yii::app()->lc->t('Logout').' ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
			array('label'=>Yii::app()->lc->t('Administration'), 'visible'=>!Yii::app()->user->isGuest, 'items'=>array
				(
					//array('label'=>'User', 'url'=>array('/user', 'view'=>'manage')),
					array('label'=>Yii::app()->lc->t('User'), 'url'=>array('/user/index', 'view'=>'manage'),'visible'=>Yii::app()->user->checkAccess('ManejarUsuarios')),
					array('label'=>Yii::app()->lc->t('Permissions'), 'url'=>array('/srbac/authitem/frontpage'))
				)
			),
			array('label'=>Yii::app()->lc->t('Manage'), 'visible'=>!Yii::app()->user->isGuest, 'items'=>array
				(
					array('label'=>Yii::app()->lc->t('Product'), 'url'=>array('/product/index')),
					array('label'=>Yii::app()->lc->t('Area'), 'url'=>array('/area/index')),
					array('label'=>Yii::app()->lc->t('Multimedia'), 'url'=>array('/multimedia/index')),
					array('label'=>Yii::app()->lc->t('Price List'), 'url'=>array('/pricelist/index')),
				)
			)
		)
		
		)); 
		 ?>		
	
</div> <!-- mainmenu -->
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>
		
	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
		All Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
