<?php
$this->breadcrumbs=array(
	'Price Lists'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List PriceList', 'url'=>array('index')),
	array('label'=>'Create PriceList', 'url'=>array('create')),
	array('label'=>'Assing Products', 'url'=>array('priceListItem')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('price-list-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Price Lists</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'price-list-grid',
	'dataProvider'=>$model->searchSummary(),
	'filter'=>$model,
	'columns'=>array(
		array(
			'name'=>'supplier_business_name',
			'value'=>'$data->supplier->business_name',
		),
		'description',
		'date_creation',
		'date_validity',
 		array(
 			'name'=>"validity",//$model->getAttributeLabel('validity'),
 			'type'=>'boolean',
 			'value'=>$model->validity,
 		),		
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
