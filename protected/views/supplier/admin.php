<?php
$this->breadcrumbs=array(
	'Suppliers'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Supplier', 'url'=>array('index')),
	array('label'=>'Create Supplier', 'url'=>array('create')),
);

?>

<h1>Manage Suppliers</h1>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'supplier-grid',
	'dataProvider'=>$model->searchSupplier(),
	'filter'=>$model,
	'columns'=>array(
		'business_name',
		array(
 			'name'=>'description',
			'value'=>'$data->contact->description',
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
