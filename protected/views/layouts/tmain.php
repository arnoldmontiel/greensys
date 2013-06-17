<!DOCTYPE html>
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

<div class="container" id="page">
	<div >
		<?php 
		$params = User::getCustomer()?array('Id_customer'=>User::getCustomer()->Id):array();
		$items = array();			
		
		if(Yii::app()->user->checkAccess('CustomerIndex'))
			$items[] = array('label'=>'Clientes', 'url'=>Yii::app()->createUrl('tCustomer/index'));
		if(Yii::app()->user->checkAccess('TagIndex'))
			$items[] = array('label'=>'Etapas', 'url'=>Yii::app()->createUrl('tag/index'));
		if(Yii::app()->user->checkAccess('ReviewTypeIndex'))
			$items[] = array('label'=>'Formularios', 'url'=>Yii::app()->createUrl('reviewType/index'));
		if(Yii::app()->user->checkAccess('UserIndex'))
			$items[] = array('label'=>'Usuarios', 'url'=>Yii::app()->createUrl('user/index'));
		if(Yii::app()->user->checkAccess('UserGroupIndex'))
			$items[] = array('label'=>'Perfiles', 'url'=>Yii::app()->createUrl('userGroup/index'));
		if(Yii::app()->user->checkAccess('DocumentTypeIndex'))
			$items[] = array('label'=>'Docs', 'url'=>Yii::app()->createUrl('documentType/index'));
		if(Yii::app()->user->checkAccess('AuditLoginIndex'))
			$items[] = array('label'=>'Auditoria', 'url'=>Yii::app()->createUrl('auditLogin/index'));
		
		$items[] = array('label'=>'Salir '.' ('.Yii::app()->user->name.')', 'url'=>Yii::app()->createUrl('site/logout'));
		
		$this->widget('bootstrap.widgets.TbNavbar', array(
			'brand' => 'Tapia',
			'brandOptions'=> array('style'=>'margin-left:0px;'),
			'collapse'=>true, // requires bootstrap-responsive.css
			'items' => array(
				array(
						'class' => 'bootstrap.widgets.TbMenu',
						'items' => $items,
					)
				)
		));
?>
	
	</div> <!-- mainmenu -->	
	<div class="row-fluid">
		<div class="whrapper">
			<?php echo $content; ?>
		</div>
	</div>
	<div class="line"></div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by SmartLiving.<br/>
		All Rights Reserved.<br/>
		Powered by Oneken
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
