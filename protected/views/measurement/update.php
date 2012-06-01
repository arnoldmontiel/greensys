<?php
$this->breadcrumbs=array(
	'Measurements'=>array('index'),
	$model->Id=>array('view','id'=>$model->Id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Measurement', 'url'=>array('index')),
	array('label'=>'Create Measurement', 'url'=>array('create')),
	array('label'=>'View Measurement', 'url'=>array('view', 'id'=>$model->Id)),
	array('label'=>'Manage Measurement', 'url'=>array('admin')),
);
?>

<h1>Update Measurement <?php echo $model->Id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>