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
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/custom.css" />
	<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl."/js/tools.js");?>

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>
<div id="page-wrap" class="container" style="width: 1340px">
<?php if(isset($this->showSideBar)&&$this->showSideBar==true):?>

<div id="sidebar" style="float:left;width: 150px;background:#ccc;padding:20px; position: absolute; display:none;opacity: 1">
	<ul id='sidebarTitle'>	
     </ul>
	<ul id='sidebarText'>
	</ul>
</div>
<?php Yii::app()->clientScript-> registerScript('sidebarController', "
var offset = $('#sidebar').offset();
var topPadding = 15;
$(window).scroll(function() {
	if ($('#sidebar').height() < $(window).height() && $(window).scrollTop() > offset.top) {
		$('#sidebar').stop().animate({
			marginTop: $(window).scrollTop() - offset.top + topPadding
		});
	} else {
		$('#sidebar').stop().animate({
			marginTop: 0
		});
	};
});")
?>
<?php endif?>
<div class="container" id="page">

	<div id="header">
	</div><!-- header -->

	<div id="mainmenu">
		<?php 
		$this->widget('application.extensions.mbmenu.MbMenu',array
		//$this->widget('zii.widgets.CMenu',array
		(
		'items'=>array
		(
			array('label'=>Yii::app()->lc->t('Login'), 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
			array('label'=>Yii::app()->lc->t('Home'), 'url'=>array('/site/index'),'visible'=>!Yii::app()->user->isGuest),
			array('label'=>Yii::app()->lc->t('Administration'), 'visible'=>Yii::app()->user->checkAccess('AdministrationViewMenu'), 'items'=>array
				(
					//array('label'=>'User', 'url'=>array('/user', 'view'=>'manage')),
					array('label'=>Yii::app()->lc->t('User'), 'url'=>array('/user/index', 'view'=>'manage')),
					array('label'=>Yii::app()->lc->t('Permissions'), 'url'=>array('/srbac/authitem/frontpage'))
				)
			),
			array('label'=>Yii::app()->lc->t('Manage'), 'visible'=>!Yii::app()->user->isGuest, 'items'=>array
				(
					array('label'=>Yii::app()->lc->t('Product'), 'url'=>array('/product/index'),'visible'=>Yii::app()->user->checkAccess('ProductIndex')),
					array('label'=>Yii::app()->lc->t('Price List'), 'url'=>array('/priceList/index'),'visible'=>Yii::app()->user->checkAccess('PriceListIndex')),
					array('label'=>Yii::app()->lc->t('Purhcase Order'), 'url'=>array('/purchaseOrder/index'),'visible'=>Yii::app()->user->checkAccess('PurchaseOrderIndex')),
					array('label'=>Yii::app()->lc->t('Area'), 'url'=>array('/area/index'),'visible'=>Yii::app()->user->checkAccess('AreaIndex')),
					array('label'=>Yii::app()->lc->t('Product Type'), 'url'=>array('/productType/index'),'visible'=>Yii::app()->user->checkAccess('ProductTypeIndex')),
					array('label'=>Yii::app()->lc->t('Category'), 'url'=>array('/category/index'),'visible'=>Yii::app()->user->checkAccess('CategoryIndex')),
					array('label'=>Yii::app()->lc->t('Sub Category'), 'url'=>array('/subCategory/index'),'visible'=>Yii::app()->user->checkAccess('SubCategoryIndex')),
					array('label'=>Yii::app()->lc->t('Nomenclator'), 'url'=>array('/nomenclator/index'),'visible'=>Yii::app()->user->checkAccess('NomenclatorIndex')),
					array('label'=>Yii::app()->lc->t('Service'), 'url'=>array('/service/index'),'visible'=>Yii::app()->user->checkAccess('ServiceIndex')),
					array('label'=>Yii::app()->lc->t('Project'), 'url'=>array('/project/index'),'visible'=>Yii::app()->user->checkAccess('ProjectIndex')),
					array('label'=>Yii::app()->lc->t('Customer'), 'url'=>array('/customer/index'),'visible'=>Yii::app()->user->checkAccess('CustomerIndex')),
					array('label'=>Yii::app()->lc->t('Importer'), 'url'=>array('/importer/index'),'visible'=>Yii::app()->user->checkAccess('ImporterIndex')),
					array('label'=>Yii::app()->lc->t('Product Requirements'), 'url'=>array('/productRequirement/index'),'visible'=>Yii::app()->user->checkAccess('ProductRequirementIndex')),
					array('label'=>Yii::app()->lc->t('Guild'), 'url'=>array('/guild/index'),'visible'=>Yii::app()->user->checkAccess('GuildIndex')),
					array('label'=>Yii::app()->lc->t('Supplier'), 'url'=>array('/supplier/index'),'visible'=>Yii::app()->user->checkAccess('SupplierIndex')),
					array('label'=>Yii::app()->lc->t('Brand'), 'url'=>array('/brand/index'),'visible'=>Yii::app()->user->checkAccess('BrandIndex')),
				)
			),
			array('label'=>Yii::app()->lc->t('Reports'), 'visible'=>!Yii::app()->user->isGuest, 'items'=>array
				(
					array('label'=>Yii::app()->lc->t('Costs'), 'url'=>array('/cost/index')),
				)
			),
		array('label'=>Yii::app()->lc->t('Logout').' ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
		
		)
		
		)); 
		 ?>		
	
	</div> <!-- mainmenu -->
	<div class="second-menu">
	
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>
		<div id="language" class="language">
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
		Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
		All Rights Reserved.<br/>
		Powered by WestIdeas. 	
	</div><!-- footer -->

</div><!-- page -->

</div>
</body>
</html>
