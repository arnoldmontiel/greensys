<?php
$this->breadcrumbs=array(
	'Product Requirements'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ProductRequirement', 'url'=>array('index')),
	array('label'=>'Manage ProductRequirement', 'url'=>array('admin')),
);
?>

<h1>Create ProductRequirement</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'modelNote'=>$modelNote)); ?>