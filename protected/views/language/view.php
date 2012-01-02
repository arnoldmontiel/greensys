<?php
$this->breadcrumbs=array(
	'Languages'=>array('index'),
	$model->Id,
);

$this->menu=array(
	array('label'=>'List Language', 'url'=>array('index')),
	array('label'=>'Create Language', 'url'=>array('create')),
	array('label'=>'Update Language', 'url'=>array('update', 'id'=>$model->Id)),
	array('label'=>'Delete Language', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->Id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Language', 'url'=>array('admin')),
);
?>

<h1>View Language #<?php echo $model->Id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'lang',
		'language',
		'region',
	),
)); ?>
