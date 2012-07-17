<?php
$this->breadcrumbs=array(
	'Purchase Orders'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List PurchaseOrder', 'url'=>array('index')),
	array('label'=>'Create PurchaseOrder', 'url'=>array('create')),
);

?>

<h1>Manage Purchase Orders</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'purchase-order-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'Id',
		'Id_supplier',
		'Id_shipping_parameter',
		'date_creation',
		'Id_purchase_order_state',
		'Id_importer',
		/*
		'Id_shipping_type',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
