<?php
$this->breadcrumbs=array(
	'Importers'=>array('index'),
	$model->Id,
);

$this->menu=array(
	array('label'=>'List Importer', 'url'=>array('index')),
	array('label'=>'Create Importer', 'url'=>array('create')),
	array('label'=>'Update Importer', 'url'=>array('update', 'id'=>$model->Id)),
	array('label'=>'Delete Importer', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->Id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Importer', 'url'=>array('admin')),
);
?>

<h1>View Importer #<?php echo $model->Id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'Id',
		'description',
		'Id_contact',
	),
)); ?>
