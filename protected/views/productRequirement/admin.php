<?php
$this->breadcrumbs=array(
	'Product Requirements'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List ProductRequirement', 'url'=>array('index')),
	array('label'=>'Create ProductRequirement', 'url'=>array('create')),
);

?>

<h1>Manage Product Requirements</h1>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'product-requirement-grid',
	'dataProvider'=>$model->searchProductReq(),
	'filter'=>$model,
	'columns'=>array(
		array(
 			'name'=>"internal",
 			'type'=>'raw',
 			'value'=>'CHtml::checkBox("internal",$data->internal,array("disabled"=>"disabled"))',
 			'filter'=>CHtml::listData(
				array(
					array('id'=>'0','value'=>'No'),
					array('id'=>'1','value'=>'Yes')
				)
				,'id','value'
			),
		),
		
		'description_short',
		array(
		 			'name'=>'guild_description',
					'value'=>'$data->guild->description',
		),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
