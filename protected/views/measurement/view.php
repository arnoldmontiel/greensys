<?php
$this->breadcrumbs=array(
	'Measurements'=>array('index'),
	$model->Id,
);

$this->menu=array(
	array('label'=>'List Measurement', 'url'=>array('index')),
	array('label'=>'Create Measurement', 'url'=>array('create')),
	array('label'=>'Update Measurement', 'url'=>array('update', 'id'=>$model->Id)),
	array('label'=>'Delete Measurement', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->Id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Measurement', 'url'=>array('admin')),
);
?>

<h1>View Measurement #<?php echo $model->Id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'Id',
		'description',
	),
)); ?>
