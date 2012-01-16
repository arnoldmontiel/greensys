<?php
$this->breadcrumbs=array(
	'Nomenclators'=>array('index'),
	$model->description,
);

$this->menu=array(
	array('label'=>'List Nomenclator', 'url'=>array('index')),
	array('label'=>'Create Nomenclator', 'url'=>array('create')),
	array('label'=>'Update Nomenclator', 'url'=>array('update', 'id'=>$model->Id)),
	array('label'=>'Delete Nomenclator', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->Id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Nomenclator', 'url'=>array('admin')),
);
?>

<h1>View Nomenclator</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'description',
	),
)); ?>
