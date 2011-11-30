<?php
$this->breadcrumbs=array(
	'Multimedias'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Multimedia', 'url'=>array('index')),
	array('label'=>'Create Multimedia', 'url'=>array('create')),
	array('label'=>'Update Multimedia', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Multimedia', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Multimedia', 'url'=>array('admin')),
);
?>

<h1>View Multimedia #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'data',
		'name',
		'type',
		'size',
		'description',
	),
)); ?>
