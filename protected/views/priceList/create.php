<?php
$this->breadcrumbs=array(
	'Price Lists'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Manage PriceList', 'url'=>array('admin')),
	array('label'=>'Clone PriceList', 'url'=>array('clonePriceList')),
);
?>

<h1>Create PriceList</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>