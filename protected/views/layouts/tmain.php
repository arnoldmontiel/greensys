<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 dramaal//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="es" />

	<!-- blueprint CSS framework -->	
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/tscreen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/tprint.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/tie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/tmain.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/tform.css" />
	<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl."/js/autoresize.js");?>
	<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl."/js/tools.js");?>
			
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	<?php Yii::app()->clientScript->registerScript('tmain-scripts', "preventSubmit($(':text'));")
	?>
	
</head>

<body>	
		<?php 
		$params = User::getCustomer()?array('Id_customer'=>User::getCustomer()->Id):array();
		$items = array();			
		$items[] = array('label'=>'Home', 'url'=>Yii::app()->createUrl('review/index',$params));
		
		if(Yii::app()->user->checkAccess('ProductIndex'))
			$items[] = array('label'=>'Clientes', 'url'=>Yii::app()->createUrl('tCustomer/index'));
		if(Yii::app()->user->checkAccess('ProductIndex'))
			$items[] = array('label'=>'Etapas', 'url'=>Yii::app()->createUrl('tag/index'));
		if(Yii::app()->user->checkAccess('ProductIndex'))
			$items[] = array('label'=>'Agrupadores', 'url'=>Yii::app()->createUrl('reviewType/index'));
		if(Yii::app()->user->checkAccess('ProductIndex'))
			$items[] = array('label'=>'Usuarios', 'url'=>Yii::app()->createUrl('user/index'));
		if(Yii::app()->user->checkAccess('ProductIndex'))
			$items[] = array('label'=>'Grupos', 'url'=>Yii::app()->createUrl('userGroup/index'));
		if(Yii::app()->user->checkAccess('ProductIndex'))
			$items[] = array('label'=>'Docs', 'url'=>Yii::app()->createUrl('documentType/index'));
		if(Yii::app()->user->checkAccess('ProductIndex'))
			$items[] = array('label'=>'Auditoria', 'url'=>Yii::app()->createUrl('auditLogin/index'));
		
		$items[] = array('label'=>'Salir '.' ('.Yii::app()->user->name.')', 'url'=>Yii::app()->createUrl('site/logout'));
		
		$this->widget('bootstrap.widgets.TbNavbar', array(
			'brand' => 'Tapia',
			'collapse'=>true, // requires bootstrap-responsive.css
			'items' => array(
				array(
						'class' => 'bootstrap.widgets.TbMenu',
						'items' => $items,
					)
				)
		));
?>

<div class="container" id="page">

	<?php echo $content; ?>

	<div class="line"></div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by SmartLiving.<br/>
		All Rights Reserved.<br/>
		Powered by Oneken
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
