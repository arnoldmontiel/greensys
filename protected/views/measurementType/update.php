<?php
$this->breadcrumbs=array(
	'Measurement Types'=>array('index'),
	$model->Id=>array('view','id'=>$model->Id),
	'Update',
);

$this->menu=array(
	array('label'=>'List MeasurementType', 'url'=>array('index')),
	array('label'=>'Create MeasurementType', 'url'=>array('create')),
	array('label'=>'View MeasurementType', 'url'=>array('view', 'id'=>$model->Id)),
	array('label'=>'Manage MeasurementType', 'url'=>array('admin')),
);
?>

<h1>Update MeasurementType <?php echo $model->Id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>