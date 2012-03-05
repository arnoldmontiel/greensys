<?php
$this->breadcrumbs=array(
	'Measurement Unit Converters'=>array('index'),
	$model->Id,
);

$this->menu=array(
	array('label'=>'List MeasurementUnitConverter', 'url'=>array('index')),
	array('label'=>'Create MeasurementUnitConverter', 'url'=>array('create')),
	array('label'=>'Update MeasurementUnitConverter', 'url'=>array('update', 'id'=>$model->Id)),
	array('label'=>'Delete MeasurementUnitConverter', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->Id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage MeasurementUnitConverter', 'url'=>array('admin')),
);
?>

<h1>View MeasurementUnitConverter #<?php echo $model->Id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'Id',
		'Id_measurement_from',
		'Id_measurement_to',
		'factor',
	),
)); ?>
