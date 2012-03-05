<?php
$this->breadcrumbs=array(
	'Areas'=>array('index'),
	$model->description,
);

$this->menu=array(
	array('label'=>'List Area', 'url'=>array('index')),
	array('label'=>'Create Area', 'url'=>array('create')),
	array('label'=>'Update Area', 'url'=>array('update', 'id'=>$model->Id)),
	array('label'=>'Delete Area', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->Id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Area', 'url'=>array('admin')),
	array('label'=>'Assign Products', 'url'=>array('productArea')),
	array('label'=>'Assign Categories', 'url'=>array('categoryArea')),
	array('label'=>'Assign Services', 'url'=>array('serviceArea')),
);
?>

<h1>View Area</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'description',
		array('label'=>$model->getAttributeLabel('main'),
					'type'=>'raw',
					'value'=>CHtml::checkBox("main",$model->main,array("disabled"=>"disabled"))
		),
	),
)); ?>
