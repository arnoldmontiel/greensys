<?php
$this->breadcrumbs=array(
	'Stocks'=>array('index'),
	$model->movementType->description=>array('view','id'=>$model->Id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Stock', 'url'=>array('index')),
	array('label'=>'Create Stock', 'url'=>array('create')),
	array('label'=>'View Stock', 'url'=>array('view', 'id'=>$model->Id)),
	array('label'=>'Manage Stock', 'url'=>array('admin')),
);
?>

<h1>Update Stock</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,
												'movementTypes'=>$movementTypes,
												'projects'=>$projects,
												'users'=>$users,
												'modelProduct'=>$modelProduct,)); ?>