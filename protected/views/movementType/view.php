<?php
$this->breadcrumbs=array(
	'Movement Types'=>array('index'),
	$model->Id,
);

$this->menu=array(
	array('label'=>'List MovementType', 'url'=>array('index')),
	array('label'=>'Create MovementType', 'url'=>array('create')),
	array('label'=>'Update MovementType', 'url'=>array('update', 'id'=>$model->Id)),
	array('label'=>'Delete MovementType', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->Id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage MovementType', 'url'=>array('admin')),
);
?>

<h1>View MovementType #<?php echo $model->Id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'Id',
		'description',
	),
)); ?>
