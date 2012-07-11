<?php
$this->breadcrumbs=array(
	'Shipping Types'=>array('index'),
	$model->Id=>array('view','id'=>$model->Id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ShippingType', 'url'=>array('index')),
	array('label'=>'Create ShippingType', 'url'=>array('create')),
	array('label'=>'View ShippingType', 'url'=>array('view', 'id'=>$model->Id)),
	array('label'=>'Manage ShippingType', 'url'=>array('admin')),
);
?>

<h1>Update ShippingType <?php echo $model->Id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>