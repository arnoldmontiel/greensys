<?php
$this->breadcrumbs=array(
	'Shipping Types'=>array('index'),
	$model->Id,
);

$this->menu=array(
	array('label'=>'List ShippingType', 'url'=>array('index')),
	array('label'=>'Create ShippingType', 'url'=>array('create')),
	array('label'=>'Update ShippingType', 'url'=>array('update', 'id'=>$model->Id)),
	array('label'=>'Delete ShippingType', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->Id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ShippingType', 'url'=>array('admin')),
);
?>

<h1>View ShippingType #<?php echo $model->Id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'Id',
		'description',
	),
)); ?>
