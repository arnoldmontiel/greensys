<?php
$this->breadcrumbs=array(
	'Customers'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Customer', 'url'=>array('index')),
	array('label'=>'Create Customer', 'url'=>array('create')),
);

?>

<h1>Manage Customers</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'customer-grid',
	'dataProvider'=>$model->searchCustomer(),
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
		),
	),
)); ?>
