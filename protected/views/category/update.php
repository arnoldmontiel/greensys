<?php
$this->breadcrumbs=array(
	'Categories'=>array('index'),
	$model->Id=>array('view','id'=>$model->Id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Category', 'url'=>array('index')),
	array('label'=>'Create Category', 'url'=>array('create')),
	array('label'=>'View Category', 'url'=>array('view', 'id'=>$model->Id)),
	array('label'=>'Manage Category', 'url'=>array('admin')),
);
?>

<h1>Update Category <?php echo $model->Id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>