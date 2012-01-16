<?php
$this->breadcrumbs=array(
	'Importers'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Importer', 'url'=>array('index')),
	array('label'=>'Create Importer', 'url'=>array('create')),
);


?>

<h1>Manage Importers</h1>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'importer-grid',
	'dataProvider'=>$model->searchSummary(),
	'filter'=>$model,
	'columns'=>array(
		array(
 			'name'=>'contact_description',
			'value'=>'$data->contact->description',
		),
		array(
 			'name'=>'contact_telephone_1',
			'value'=>'$data->contact->telephone_1',
		),
		array(
 			'name'=>'contact_telephone_2',
			'value'=>'$data->contact->telephone_2',
		),
		array(
 			'name'=>'contact_email',
			'value'=>'$data->contact->email',
		),
array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
