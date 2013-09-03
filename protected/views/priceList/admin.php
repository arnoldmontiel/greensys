<?php
$this->breadcrumbs=array(
	'Price Lists'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Create PriceList', 'url'=>array('create')),
	array('label'=>'Manage Import Purch List', 'url'=>array('adminPurchListImport')),
	array('label'=>'Import Purch List from Excel', 'url'=>array('importPurchListFromExcel')),
	//array('label'=>'Clone PriceList', 'url'=>array('clonePriceList')),
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

<?php
$names=$model->attributeNames();
 $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'price-list-grid',
	'dataProvider'=>$model->searchSummary(),
	'filter'=>$model,
	'columns'=>array(
 		array(
  			'name'=>"Id_price_list_type",//$model->getAttributeLabel('validity'),
  			'type'=>'raw',
  			'value'=>'isset($data->priceListType)?$data->priceListType->name:""',
  			'filter'=>CHtml::listData(
 				array(
 					array('id'=>'1','value'=>'Compra'),
 					array('id'=>'2','value'=>'Venta')
 				)
 				,'id','value'
 			),
 		),
		array(
			'name'=>'supplier_business_name',
			'value'=>'isset($data->supplier)?$data->supplier->business_name:""',
		),
		array(
			'name'=>'Id_importer',
			'value'=>'isset($data->importer)?$data->importer->contact->description:""',
		),
		'description',	
		'date_creation',
		'date_validity',
 		array(
 			'name'=>"validity",//$model->getAttributeLabel('validity'),
 			'type'=>'raw',
 			'value'=>'CHtml::checkBox("validity",$data->validity,array("disabled"=>"disabled"))',
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
