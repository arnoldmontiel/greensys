<?php
$this->breadcrumbs=array(
	'Price Lists'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List PriceList', 'url'=>array('index')),
	array('label'=>'Manage PriceList', 'url'=>array('admin')),
	array('label'=>'Assing Products', 'url'=>array('priceListItem')),
);
?>

<h1>Create PriceList</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>