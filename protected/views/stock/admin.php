<?php
$this->breadcrumbs=array(
	'Stocks'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Stock', 'url'=>array('index')),
	array('label'=>'Create Stock', 'url'=>array('create')),
);

?>

<h1>Manage Stocks</h1>


<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'stock-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
 			'name'=>'movement_type_desc',
			'value'=>'$data->movementType->description',
		),
		array(
 			'name'=>'project_desc',
			'value'=>'$data->project->description',
		),
		'username',
		'creation_date',
		'description',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
