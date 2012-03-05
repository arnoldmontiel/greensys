<?php
$this->breadcrumbs=array(
	'Measurement Units'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List MeasurementUnit', 'url'=>array('index')),
	array('label'=>'Manage MeasurementUnit', 'url'=>array('admin')),
);
?>

<h1>Create MeasurementUnit</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>