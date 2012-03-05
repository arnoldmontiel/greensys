<?php
$this->breadcrumbs=array(
	'Price List Items',
);

$this->menu=array(
	array('label'=>'Create PriceListItem', 'url'=>array('create')),
	array('label'=>'Manage PriceListItem', 'url'=>array('admin')),
);
?>

<h1>Price List Items</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
