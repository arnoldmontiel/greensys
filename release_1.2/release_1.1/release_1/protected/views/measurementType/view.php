<?php
$this->breadcrumbs=array(
	'Measurement Types'=>array('index'),
	$model->Id,
);

$this->menu=array(
	array('label'=>'List MeasurementType', 'url'=>array('index')),
	array('label'=>'Create MeasurementType', 'url'=>array('create')),
	array('label'=>'Update MeasurementType', 'url'=>array('update', 'id'=>$model->Id)),
	array('label'=>'Delete MeasurementType', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->Id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage MeasurementType', 'url'=>array('admin')),
);
?>

<h1>View MeasurementType #<?php echo $model->Id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'Id',
		'description',
	),
)); ?>
