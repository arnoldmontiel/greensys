<?php
$this->breadcrumbs=array(
	'Stocks'=>array('index'),
	$model->movementType->description,
);

$this->menu=array(
	array('label'=>'List Stock', 'url'=>array('index')),
	array('label'=>'Create Stock', 'url'=>array('create')),
	array('label'=>'Update Stock', 'url'=>array('update', 'id'=>$model->Id)),
	array('label'=>'Move Stock', 'url'=>array('moveStock', 'id'=>$model->Id)),
	array('label'=>'Delete Stock', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->Id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Stock', 'url'=>array('admin')),
);
?>

<h1>View Stock</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		array('label'=>$model->getAttributeLabel('Id_movement_type'),
			'type'=>'raw',
			'value'=>$model->movementType->description
		),
		array('label'=>$model->getAttributeLabel('Id_project'),
			'type'=>'raw',
			'value'=>$model->project->description
		),
		'username',
		'creation_date',
		'description',
	),
)); ?>
