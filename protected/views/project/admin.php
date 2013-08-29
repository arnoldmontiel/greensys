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


<?php
$data =$model->search();
$data->setPagination(array('pageSize' => 20,)); 
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'project-grid',
	'dataProvider'=>$data,
	'filter'=>$model,
	'columns'=>array(
		array('name'=>'Id_customer','value'=>'$data->customer->contact->description'),
		'description',
		'address',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
