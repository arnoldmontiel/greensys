<?php
$this->breadcrumbs=array(
	'Product Types'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List ProductType', 'url'=>array('index')),
	array('label'=>'Create ProductType', 'url'=>array('create')),
);

?>

<h1>Manage Product Types</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'product-type-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'description',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
