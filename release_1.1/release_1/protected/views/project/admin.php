<?php
$this->breadcrumbs=array(
	'Projects'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Project', 'url'=>array('index')),
	array('label'=>'Create Project', 'url'=>array('create')),
	array('label'=>'Assing Areas', 'url'=>array('projectArea')),
);

?>

<h1>Manage Projects</h1>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'project-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'description',
		'address',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
