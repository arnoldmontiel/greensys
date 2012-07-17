<?php
$this->breadcrumbs=array(
	'Purchase Order States'=>array('index'),
	$model->Id,
);

$this->menu=array(
	array('label'=>'List PurchaseOrderState', 'url'=>array('index')),
	array('label'=>'Create PurchaseOrderState', 'url'=>array('create')),
	array('label'=>'Update PurchaseOrderState', 'url'=>array('update', 'id'=>$model->Id)),
	array('label'=>'Delete PurchaseOrderState', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->Id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage PurchaseOrderState', 'url'=>array('admin')),
);
?>

<h1>View PurchaseOrderState #<?php echo $model->Id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'Id',
		'description',
	),
)); ?>
