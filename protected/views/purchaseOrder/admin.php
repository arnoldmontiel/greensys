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
		'code',
		array(
				'name'=>'Id_supplier',
				'value'=>'$data->supplier->business_name',
		),
		array(
				'name'=>'Id_purchase_order_state',
				'value'=>'$data->purchaseOrderState->description',
		),
		'date_creation',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
