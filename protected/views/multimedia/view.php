<?php
$this->breadcrumbs=array(
	'Multimedias'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Multimedia', 'url'=>array('index')),
	array('label'=>'Create Multimedia', 'url'=>array('create')),
	array('label'=>'Update Multimedia', 'url'=>array('update', 'id'=>$model->Id)),
	array('label'=>'Delete Multimedia', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->Id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Multimedia', 'url'=>array('admin')),
);
?>

<h1>View Multimedia #<?php echo $model->Id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'content',
		'name',
		'type',
		'size',
		'description',
		'content_small',
		'size_small',
		'Id_entity_type',
		'Id_product',
	),
)); ?>
