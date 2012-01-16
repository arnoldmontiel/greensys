<?php
$this->breadcrumbs=array(
	'Guilds'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Guild', 'url'=>array('index')),
	array('label'=>'Create Guild', 'url'=>array('create')),
);

?>

<h1>Manage Guilds</h1>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'guild-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'description',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
