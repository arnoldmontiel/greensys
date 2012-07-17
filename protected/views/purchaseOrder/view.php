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
	array('label'=>'Assign Products', 'url'=>array('assignProducts', 'id'=>$model->Id)),
);
?>

<h1>View PurchaseOrder</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		array('label'=>$model->getAttributeLabel('Id_supplier'),
				'type'=>'raw',
				'value'=>$model->supplier->business_name
		),
		'date_creation',
		array('label'=>$model->getAttributeLabel('Id_purchase_order_state'),
				'type'=>'raw',
				'value'=>$model->purchaseOrderState->description
		),
		array('label'=>$model->getAttributeLabel('Id_importer'),
				'type'=>'raw',
				'value'=>$model->importer->contact->description
		),
		array('label'=>$model->getAttributeLabel('Id_shipping_parameter'),
				'type'=>'raw',
				'value'=>$model->shippingParameter->description
		),
		'Id_shipping_type',
	),
)); ?>

