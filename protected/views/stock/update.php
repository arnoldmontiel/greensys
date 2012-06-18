<?php
$this->breadcrumbs=array(
	'Stocks'=>array('index'),
	$model->Id=>array('view','id'=>$model->Id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Stock', 'url'=>array('index')),
	array('label'=>'Create Stock', 'url'=>array('create')),
	array('label'=>'View Stock', 'url'=>array('view', 'id'=>$model->Id)),
	array('label'=>'Manage Stock', 'url'=>array('admin')),
);
?>

<h1>Update Stock <?php echo $model->Id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>