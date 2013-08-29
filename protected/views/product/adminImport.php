<?php
$this->breadcrumbs=array(
	'Products'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Create Product', 'url'=>array('create')),
	array('label'=>'Manage Product', 'url'=>array('admin')),
	array('label'=>'Assign Groups', 'url'=>array('productGroup')),
	array('label'=>'Assign Requirements', 'url'=>array('productRequirement')),
	array('label'=>'Import From Excel', 'url'=>array('importFromExcel')),
);

?>

<h1>Manage Products</h1>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'product-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
			'file_name',
			'total_rows',
			'date',
			array(
				'class'=>'CButtonColumn',
				'template'=>'{view}',
				'buttons'=>array
				(
					'view' => array
								(
									'url'=>'Yii::app()->createUrl("product/importResults", array("id"=>$data->Id))',
								),
				),
			),
	),
)); ?>
