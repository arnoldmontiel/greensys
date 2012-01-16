<?php
$this->breadcrumbs=array(
	'Areas'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Area', 'url'=>array('index')),
	array('label'=>'Create Area', 'url'=>array('create')),
	array('label'=>'Assign Products', 'url'=>array('productArea')),
	array('label'=>'Assign Categories', 'url'=>array('categoryArea')),
	array('label'=>'Assign Services', 'url'=>array('serviceArea')),
);

?>

<h1>Manage Areas</h1>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'area-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'description',
		array(
 			'name'=>"main",
 			'type'=>'raw',
 			'value'=>'CHtml::checkBox("main",$data->main,array("disabled"=>"disabled"))',
 			'filter'=>CHtml::listData(
				array(
					array('id'=>'0','value'=>'No'),
					array('id'=>'1','value'=>'Yes')
					)
					,'id','value'
			),
		),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
