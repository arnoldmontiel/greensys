<?php
$this->breadcrumbs=array(
	'Price List Items'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List PriceListItem', 'url'=>array('index')),
	array('label'=>'Manage PriceListItem', 'url'=>array('admin')),
);
?>

<h1>Create PriceListItem</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>