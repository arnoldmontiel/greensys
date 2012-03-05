<?php
$this->breadcrumbs=array(
	'Measurement Types'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List MeasurementType', 'url'=>array('index')),
	array('label'=>'Manage MeasurementType', 'url'=>array('admin')),
);
?>

<h1>Create MeasurementType</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>