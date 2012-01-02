<?php
$this->breadcrumbs=array(
	'Languages'=>array('index'),
	$model->Id=>array('view','id'=>$model->Id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Language', 'url'=>array('index')),
	array('label'=>'Create Language', 'url'=>array('create')),
	array('label'=>'View Language', 'url'=>array('view', 'id'=>$model->Id)),
	array('label'=>'Manage Language', 'url'=>array('admin')),
);
?>

<h1>Update Language <?php echo $model->Id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>