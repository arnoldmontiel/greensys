<?php
$this->breadcrumbs=array(
	'Purchase Order States'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List PurchaseOrderState', 'url'=>array('index')),
	array('label'=>'Manage PurchaseOrderState', 'url'=>array('admin')),
);
?>

<h1>Create PurchaseOrderState</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>