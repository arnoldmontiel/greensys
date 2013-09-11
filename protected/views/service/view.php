<?php
$this->breadcrumbs=array(
	'Services'=>array('index'),
	$model->description,
);

$this->menu=array(
	array('label'=>'List Service', 'url'=>array('index')),
	array('label'=>'Create Service', 'url'=>array('create')),
	array('label'=>'Update Service', 'url'=>array('update', 'id'=>$model->Id)),
	array('label'=>'Delete Service', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->Id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Service', 'url'=>array('admin')),
	array('label'=>'Assing Categories', 'url'=>array('serviceCategory','Service'=>array('Id'=>$model->Id))),
);
?>

<h1>View Service</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'description',
		'long_description',
	),
)); ?>
