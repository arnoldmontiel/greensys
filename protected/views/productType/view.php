<?php
$this->breadcrumbs=array(
	'Product Types'=>array('index'),
	$model->Id,
);

$this->menu=array(
	array('label'=>'List ProductType', 'url'=>array('index')),
	array('label'=>'Create ProductType', 'url'=>array('create')),
	array('label'=>'Update ProductType', 'url'=>array('update', 'id'=>$model->Id)),
	array('label'=>'Delete ProductType', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->Id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ProductType', 'url'=>array('admin')),
);
?>

<h1>View ProductType</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'description',
	),
)); ?>
