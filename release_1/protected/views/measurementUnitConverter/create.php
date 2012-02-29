<?php
$this->breadcrumbs=array(
	'Measurement Unit Converters'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List MeasurementUnitConverter', 'url'=>array('index')),
	array('label'=>'Manage MeasurementUnitConverter', 'url'=>array('admin')),
);
?>

<h1>Create MeasurementUnitConverter</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>