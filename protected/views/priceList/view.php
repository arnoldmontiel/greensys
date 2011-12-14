<?php
$this->breadcrumbs=array(
	'Price Lists'=>array('index'),
	$model->Id,
);

$this->menu=array(
	array('label'=>'List PriceList', 'url'=>array('index')),
	array('label'=>'Create PriceList', 'url'=>array('create')),
	array('label'=>'Update PriceList', 'url'=>array('update', 'id'=>$model->Id)),
	array('label'=>'Delete PriceList', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->Id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage PriceList', 'url'=>array('admin')),
);
?>

<h1>View PriceList #<?php echo $model->Id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'Id',
		'date_creation',
		'date_validity',
		'validity',
		'Id_supplier',
		'id_price_list_type',
	),
)); ?>
