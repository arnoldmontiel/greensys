<?php
$this->breadcrumbs=array(
	'Product Types'=>array('index'),
	$model->Id=>array('view','id'=>$model->Id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ProductType', 'url'=>array('index')),
	array('label'=>'Create ProductType', 'url'=>array('create')),
	array('label'=>'View ProductType', 'url'=>array('view', 'id'=>$model->Id)),
	array('label'=>'Manage ProductType', 'url'=>array('admin')),
);
?>

<h1>Update ProductType </h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>