<?php
$this->breadcrumbs=array(
	'Guilds'=>array('index'),
	$model->description,
);

$this->menu=array(
	array('label'=>'List Guild', 'url'=>array('index')),
	array('label'=>'Create Guild', 'url'=>array('create')),
	array('label'=>'Update Guild', 'url'=>array('update', 'id'=>$model->Id)),
	array('label'=>'Delete Guild', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->Id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Guild', 'url'=>array('admin')),
);
?>

<h1>View Guild</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'description',
	),
)); ?>
