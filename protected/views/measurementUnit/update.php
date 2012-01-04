<?php
$this->breadcrumbs=array(
	'Measurement Units'=>array('index'),
	$model->Id=>array('view','id'=>$model->Id),
	'Update',
);

$this->menu=array(
	array('label'=>'List MeasurementUnit', 'url'=>array('index')),
	array('label'=>'Create MeasurementUnit', 'url'=>array('create')),
	array('label'=>'View MeasurementUnit', 'url'=>array('view', 'id'=>$model->Id)),
	array('label'=>'Manage MeasurementUnit', 'url'=>array('admin')),
);
?>

<h1>Update MeasurementUnit <?php echo $model->Id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>