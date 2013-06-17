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

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main-login.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/custom.css" />
	<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl."/js/tools.js");?>

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>
<div id="page-wrap" class="container">
<div class="container" id="page">

	<div id="header">
	</div><!-- header -->

	<div class="second-menu">
	
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>
		<div id="language" class="language" style="display:none">
			<?php
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
	</div>
		
	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by SmartLiving.<br/>
		All Rights Reserved.<br/>
		Powered by WestIdeas.
	</div><!-- footer -->

</div><!-- page -->

</div>
</body>
</html>
