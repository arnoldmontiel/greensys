<?php
$this->breadcrumbs=array(
	'Price Lists',
);

$this->menu=array(
	array('label'=>'Create PriceList', 'url'=>array('create')),
	array('label'=>'Manage PriceList', 'url'=>array('admin')),
	array('label'=>'Assing Products', 'url'=>array('priceListItem')),
	//array('label'=>'Clone PriceList', 'url'=>array('clonePriceList')),
);
?>

<h1>Price Lists Purchases</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

<h1>Price Lists Sales</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProviderSale,
	'itemView'=>'_viewSale',
)); ?>


