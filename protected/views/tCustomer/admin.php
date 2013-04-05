<?php
$this->breadcrumbs=array(
	'Customers'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Listar Clientes', 'url'=>array('index')),
	array('label'=>'Asignacion Clientes', 'url'=>array('assign')),
	array('label'=>'Crear Cliente', 'url'=>array('create')),
);

?>

<h1>Administrar Clientes</h1>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'customer-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
 			'name'=>'name',
			'value'=>'$data->person->name',
		),
		array(
 			'name'=>'last_name',
			'value'=>'$data->person->last_name',
		),
		array(
 			'name'=>'telephone_1',
			'value'=>'$data->contact->telephone_1',
		),
		array(
 			'name'=>'email',
			'value'=>'$data->contact->email',
		),
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view}{update}',
		),
	),
)); ?>
