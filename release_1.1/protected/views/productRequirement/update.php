<?php
$this->breadcrumbs=array(
	'Product Requirements'=>array('index'),
	$model->description_short=>array('view','id'=>$model->Id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ProductRequirement', 'url'=>array('index')),
	array('label'=>'Create ProductRequirement', 'url'=>array('create')),
	array('label'=>'View ProductRequirement', 'url'=>array('view', 'id'=>$model->Id)),
	array('label'=>'Manage ProductRequirement', 'url'=>array('admin')),
);
?>

<h1>Update Product Requirement</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'modelNote'=>$modelNote)); ?>