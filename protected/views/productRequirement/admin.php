<?php
$this->breadcrumbs=array(
	'Product Requirements'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List ProductRequirement', 'url'=>array('index')),
	array('label'=>'Create ProductRequirement', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('product-requirement-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Product Requirements</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'product-requirement-grid',
	'dataProvider'=>$model->searchProductReq(),
	'filter'=>$model,
	'columns'=>array(
		array(
		 			'name'=>'internal',
					'value'=>'CHtml::checkBox("internal",$data->internal,array("disabled"=>"disabled"))',
					'type'=>'raw',
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
