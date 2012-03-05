<?php
$this->breadcrumbs=array(
	'Measurement Units'=>array('index'),
	$model->Id,
);

$this->menu=array(
	array('label'=>'List MeasurementUnit', 'url'=>array('index')),
	array('label'=>'Create MeasurementUnit', 'url'=>array('create')),
	array('label'=>'Update MeasurementUnit', 'url'=>array('update', 'id'=>$model->Id)),
	array('label'=>'Delete MeasurementUnit', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->Id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage MeasurementUnit', 'url'=>array('admin')),
);
?>

<h1>View MeasurementUnit #<?php echo $model->Id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'Id',
		'description',
		'short_description',
		'Id_measurement_type',
	),
)); ?>
