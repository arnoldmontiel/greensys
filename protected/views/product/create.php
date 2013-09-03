<?php
$this->breadcrumbs=array(
	'Products'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Manage Product', 'url'=>array('admin')),
	array('label'=>'Assign Groups', 'url'=>array('productGroup')),
	array('label'=>'Assign Requirements', 'url'=>array('productRequirement')),
	array('label'=>'Manage Import', 'url'=>array('adminImport')),
	array('label'=>'Import From Excel', 'url'=>array('importFromExcel')),
	array('label'=>'Manage Measures Import', 'url'=>array('adminMeasuresImport')),
	array('label'=>'Import Measures From Excel', 'url'=>array('importMeasuresFromExcel')),
);
?>

<h1>Create Product</h1>

<?php echo $this->renderPartial('_form', array(
											'model'=>$model,
											'modelHyperlink'=>$modelHyperlink,
											'modelNote'=>$modelNote,
											'ddlSubCategory'=>$ddlSubCategory,
											'ddlRacks'=>$ddlRacks,
											)); ?>