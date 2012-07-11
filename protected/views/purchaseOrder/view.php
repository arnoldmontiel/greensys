<?php
$this->breadcrumbs=array(
	'Purchase Orders'=>array('index'),
	$model->Id,
);

$this->menu=array(
	array('label'=>'List PurchaseOrder', 'url'=>array('index')),
	array('label'=>'Create PurchaseOrder', 'url'=>array('create')),
	array('label'=>'Update PurchaseOrder', 'url'=>array('update', 'id'=>$model->Id)),
	array('label'=>'Delete PurchaseOrder', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->Id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage PurchaseOrder', 'url'=>array('admin')),
);
?>

<h1>View PurchaseOrder #<?php echo $model->Id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'Id',
		'Id_supplier',
		'Id_shipping_parameter',
		'date_creation',
		'Id_purchase_order_state',
		'Id_importer',
		'Id_shipping_type',
	),
)); ?>
