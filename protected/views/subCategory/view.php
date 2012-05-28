<?php
$this->breadcrumbs=array(
	'Sub Categories'=>array('index'),
	$model->Id,
);

$this->menu=array(
	array('label'=>'List SubCategory', 'url'=>array('index')),
	array('label'=>'Create SubCategory', 'url'=>array('create')),
	array('label'=>'Update SubCategory', 'url'=>array('update', 'id'=>$model->Id)),
	array('label'=>'Delete SubCategory', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->Id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SubCategory', 'url'=>array('admin')),
);
?>

<h1>View SubCategory #<?php echo $model->Id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'Id',
		'description',
	),
)); ?>
