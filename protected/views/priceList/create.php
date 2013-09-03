<?php
$this->breadcrumbs=array(
	'Price Lists'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Manage PriceList', 'url'=>array('admin')),
	array('label'=>'Manage Import Purch List', 'url'=>array('adminPurchListImport')),
	array('label'=>'Import Purch List from Excel', 'url'=>array('importPurchListFromExcel')),
	//array('label'=>'Clone PriceList', 'url'=>array('clonePriceList')),
);
?>

<h1>Create PriceList</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>