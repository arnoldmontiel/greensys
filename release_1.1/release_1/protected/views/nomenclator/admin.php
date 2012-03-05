<?php
$this->breadcrumbs=array(
	'Nomenclators'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Nomenclator', 'url'=>array('index')),
	array('label'=>'Create Nomenclator', 'url'=>array('create')),
);


?>

<h1>Manage Nomenclators</h1>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'nomenclator-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'description',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
