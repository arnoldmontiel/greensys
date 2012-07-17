<?php
$this->breadcrumbs=array(
	'Purchase Order States',
);

$this->menu=array(
	array('label'=>'Create PurchaseOrderState', 'url'=>array('create')),
	array('label'=>'Manage PurchaseOrderState', 'url'=>array('admin')),
);
?>

<h1>Purchase Order States</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
