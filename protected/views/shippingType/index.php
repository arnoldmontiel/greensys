<?php
$this->breadcrumbs=array(
	'Shipping Types',
);

$this->menu=array(
	array('label'=>'Create ShippingType', 'url'=>array('create')),
	array('label'=>'Manage ShippingType', 'url'=>array('admin')),
);
?>

<h1>Shipping Types</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
