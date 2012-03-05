<?php
$this->breadcrumbs=array(
	'Measurement Unit Converters'=>array('index'),
	$model->Id=>array('view','id'=>$model->Id),
	'Update',
);

$this->menu=array(
	array('label'=>'List MeasurementUnitConverter', 'url'=>array('index')),
	array('label'=>'Create MeasurementUnitConverter', 'url'=>array('create')),
	array('label'=>'View MeasurementUnitConverter', 'url'=>array('view', 'id'=>$model->Id)),
	array('label'=>'Manage MeasurementUnitConverter', 'url'=>array('admin')),
);
?>

<h1>Update MeasurementUnitConverter <?php echo $model->Id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>