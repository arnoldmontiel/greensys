<?php
$this->breadcrumbs=array(
	'Shipping Types'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ShippingType', 'url'=>array('index')),
	array('label'=>'Manage ShippingType', 'url'=>array('admin')),
);
?>

<h1>Create ShippingType</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>