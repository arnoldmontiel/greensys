<?php
$this->breadcrumbs=array(
	'Products'=>array('index'),
	$model->Id,
);

$this->menu=array(
	array('label'=>'List Product', 'url'=>array('index')),
	array('label'=>'Create Product', 'url'=>array('create')),
	array('label'=>'Update Product', 'url'=>array('update', 'id'=>$model->Id)),
	array('label'=>'Delete Product', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->Id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Product', 'url'=>array('admin')),
);
?>

<h1>View Product #<?php echo $model->Id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'Id',
		'id_brand',
		'Id_category',
		'Id_nomenclator',
		'description_customer',
		'description_supplier',
		'code',
		'code_supplier',
		'discontinued',
		'length',
		'width',
		'height',
		'profit_rate',
		'msrp',
		'time_instalation',
		'hide',
		'weight',
	),
)); ?>
