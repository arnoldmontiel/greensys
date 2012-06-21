<?php
$this->breadcrumbs=array(
	'Stocks'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Stock', 'url'=>array('index')),
	array('label'=>'Manage Stock', 'url'=>array('admin')),
);
?>

<h1>Create Stock</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,
												'movementTypes'=>$movementTypes,
												'projects'=>$projects,
												'users'=>$users,
												)); ?>