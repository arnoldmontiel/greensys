<?php
$this->breadcrumbs=array(
	'Products'=>array('index'),
	'Manage',
);

$this->menu=array(	
	array('label'=>'Create Product', 'url'=>array('create')),
	array('label'=>'Assign Groups', 'url'=>array('productGroup')),
	array('label'=>'Assign Requirements', 'url'=>array('productRequirement')),
	array('label'=>'Manage Import', 'url'=>array('adminImport')),
	array('label'=>'Import From Excel', 'url'=>array('importFromExcel')),
	array('label'=>'Manage Measures Import', 'url'=>array('adminMeasuresImport')),
	array('label'=>'Import Measures From Excel', 'url'=>array('importMeasuresFromExcel')),
);

?>

<h1>Manage Products</h1>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'product-grid',
	'dataProvider'=>$model->searchSummary(),
	'filter'=>$model,
	'columns'=>array(			
			'model',
			'part_number',
			'code',
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
			'short_description',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
