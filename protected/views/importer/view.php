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

<h1>View Importer </h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'description',
		array('label'=>$model->contact->getAttributeLabel('telephone_1'),
			'type'=>'raw',
			'value'=>$model->contact->telephone_1
		),
		array('label'=>$model->contact->getAttributeLabel('telephone_2'),
			'type'=>'raw',
			'value'=>$model->contact->telephone_2
		),
		array('label'=>$model->contact->getAttributeLabel('telephone_3'),
			'type'=>'raw',
			'value'=>$model->contact->telephone_3
		),
		array('label'=>$model->contact->getAttributeLabel('email'),
			'type'=>'raw',
			'value'=>$model->contact->email
		),
		array('label'=>$model->contact->getAttributeLabel('address'),
			'type'=>'raw',
			'value'=>$model->contact->address
		),
	),
)); ?>
