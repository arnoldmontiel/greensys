<?php
$this->breadcrumbs=array(
	'Volts'=>array('index'),
	$model->Id,
);

$this->menu=array(
	array('label'=>'List Volts', 'url'=>array('index')),
	array('label'=>'Create Volts', 'url'=>array('create')),
	array('label'=>'Update Volts', 'url'=>array('update', 'id'=>$model->Id)),
	array('label'=>'Delete Volts', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->Id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Volts', 'url'=>array('admin')),
);
?>

<h1>View Volts #<?php echo $model->Id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'Id',
		'volts',
	),
)); ?>
