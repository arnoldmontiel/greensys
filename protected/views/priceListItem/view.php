<?php
$this->breadcrumbs=array(
	'Price List Items'=>array('index'),
	$model->Id,
);

$this->menu=array(
	array('label'=>'List PriceListItem', 'url'=>array('index')),
	array('label'=>'Create PriceListItem', 'url'=>array('create')),
	array('label'=>'Update PriceListItem', 'url'=>array('update', 'id'=>$model->Id)),
	array('label'=>'Delete PriceListItem', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->Id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage PriceListItem', 'url'=>array('admin')),
);
?>

<h1>View PriceListItem #<?php echo $model->Id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'Id',
		'id_product',
		'Id_price_list',
		'cost',
	),
)); ?>
