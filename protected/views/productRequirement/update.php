<?php
$this->breadcrumbs=array(
	'Product Requirements'=>array('index'),
	$model->description_short=>array('view','id'=>$model->Id),
	'Update',
);

$this->menu=array(
	array('label'=>'List', 'url'=>array('index')),
	array('label'=>'Create', 'url'=>array('create')),
	array('label'=>'View', 'url'=>array('view', 'id'=>$model->Id)),
	array('label'=>'Manage', 'url'=>array('admin')),
	array('label'=>'update', 'url'=>array('admin')),
	array('label'=>'update', 'url'=>array('admin')),
	array('label'=>'Update Resources', 'url'=>array('updateMultimedia', 'id'=>$model->Id)),
		
);
?>

<h1>Update Product Requirement</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'modelNote'=>$modelNote)); ?>