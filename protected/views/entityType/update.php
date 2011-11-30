<?php
$this->breadcrumbs=array(
	'Entity Types'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List EntityType', 'url'=>array('index')),
	array('label'=>'Create EntityType', 'url'=>array('create')),
	array('label'=>'View EntityType', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage EntityType', 'url'=>array('admin')),
);
?>

<h1>Update EntityType <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>