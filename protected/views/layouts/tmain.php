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
		$items = array();			
				
		$items[] = array('label'=>'Monitor', 'url'=>Yii::app()->createUrl('review/index'),'active'=>$this->uniqueid=='review');
		
		if(Yii::app()->user->checkAccess('CustomerIndex'))			
			$items[] = array('label'=>'Clientes', 'url'=>Yii::app()->createUrl('tCustomer/index'),'active'=>$this->uniqueid=='tCustomer');
		if(Yii::app()->user->checkAccess('TagIndex'))
			$items[] = array('label'=>'Etapas', 'url'=>Yii::app()->createUrl('tag/index'),'active'=>$this->uniqueid=='tag');
		if(Yii::app()->user->checkAccess('ReviewTypeIndex'))
			$items[] = array('label'=>'Formularios', 'url'=>Yii::app()->createUrl('reviewType/index'),'active'=>$this->uniqueid=='reviewType');
		if(Yii::app()->user->checkAccess('UserIndex'))
			$items[] = array('label'=>'Usuarios', 'url'=>Yii::app()->createUrl('user/index'),'active'=>$this->uniqueid=='user');
		if(Yii::app()->user->checkAccess('UserGroupIndex'))
			$items[] = array('label'=>'Perfiles', 'url'=>Yii::app()->createUrl('userGroup/index'),'active'=>$this->uniqueid=='userGroup');
		if(Yii::app()->user->checkAccess('DocumentTypeIndex'))
			$items[] = array('label'=>'Docs', 'url'=>Yii::app()->createUrl('documentType/index'),'active'=>$this->uniqueid=='documentType');
		if(Yii::app()->user->checkAccess('AuditLoginIndex'))
			$items[] = array('label'=>'Auditoria', 'url'=>Yii::app()->createUrl('auditLogin/index'),'active'=>$this->uniqueid=='auditLogin');
		
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
	<A name="BOTTOM">
	</A>
	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by SmartLiving.<br/>
		All Rights Reserved.<br/>
		Powered by Oneken
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
