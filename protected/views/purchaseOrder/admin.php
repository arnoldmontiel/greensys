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
		array(
				'name'=>'Id_supplier',
				'value'=>'$data->supplier->business_name',
		),
		array(
				'name'=>'Id_shipping_parameter',
				'value'=>'$data->shippingParameter->description',
		),
		array(
				'name'=>'Id_purchase_order_state',
				'value'=>'$data->purchaseOrderState->description',
		),
		array(
				'name'=>'Id_importer',
				'value'=>'$data->importer->contact->description',
		),
		array(
				'name'=>'Id_shipping_type',
				'value'=>'$data->shippingType->description',
		),
		'date_creation',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
