<?php
$this->breadcrumbs=array(
	'Volts'=>array('index'),
	$model->Id=>array('view','id'=>$model->Id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Volts', 'url'=>array('index')),
	array('label'=>'Create Volts', 'url'=>array('create')),
	array('label'=>'View Volts', 'url'=>array('view', 'id'=>$model->Id)),
	array('label'=>'Manage Volts', 'url'=>array('admin')),
);
?>

<h1>Update Volts <?php echo $model->Id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>