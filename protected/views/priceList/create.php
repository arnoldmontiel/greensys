<?php
$this->breadcrumbs=array(
	'Price Lists'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List PriceList', 'url'=>array('index')),
	array('label'=>'Manage PriceList', 'url'=>array('admin')),
);
?>

<h1>Create PriceList</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>