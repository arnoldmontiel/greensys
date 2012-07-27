<?php
$this->breadcrumbs=array(
	'Products'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Product', 'url'=>array('index')),
	array('label'=>'Create Product', 'url'=>array('create')),
	array('label'=>'Assign Groups', 'url'=>array('productGroup')),
	array('label'=>'Assign Requirements', 'url'=>array('productRequirement')),

);

?>

<h1>Manage Products</h1>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'product-grid',
	'dataProvider'=>$model->searchSummary(),
	'filter'=>$model,
	'columns'=>array(
			array(
		 		'name'=>'code',
				'value'=>'$data->code',
			),			
			array(
		 		'name'=>'code_supplier',
				'value'=>'$data->code_supplier',
			),			
			array(
		 		'name'=>'supplier_description',
				'value'=>'$data->supplier->business_name',
			),
			array(
	 			'name'=>'brand_description',
				'value'=>'$data->brand->description',
			),
			array(
		 		'name'=>'category_description',
				'value'=>'$data->category->description',
			),
				'description_customer',
				'description_supplier',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
