<?php
$this->breadcrumbs=array(
	'Movement Types'=>array('index'),
	$model->Id=>array('view','id'=>$model->Id),
	'Update',
);

$this->menu=array(
	array('label'=>'List MovementType', 'url'=>array('index')),
	array('label'=>'Create MovementType', 'url'=>array('create')),
	array('label'=>'View MovementType', 'url'=>array('view', 'id'=>$model->Id)),
	array('label'=>'Manage MovementType', 'url'=>array('admin')),
);
?>

<h1>Update MovementType <?php echo $model->Id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>