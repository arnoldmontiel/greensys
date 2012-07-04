<?php
$this->breadcrumbs=array(
	'Price Lists'=>array('index'),
	$model->description,
);

$this->menu=array(
	array('label'=>'List PriceList', 'url'=>array('index')),
	array('label'=>'Create PriceList', 'url'=>array('create')),
	array('label'=>'Update PriceList', 'url'=>array('update', 'id'=>$model->Id)),
	array('label'=>'Delete PriceList', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->Id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage PriceList', 'url'=>array('admin')),
	array('label'=>'Assing Products', 'url'=>array('priceListItem','PriceList'=>array('Id'=>$model->Id))),
	array('label'=>'Clone PriceList', 'url'=>array('clonePriceList')),
);
?>

<h1>View PriceList</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'description',
		'date_creation',
		'date_validity',
		array('label'=>$model->getAttributeLabel('validity'),
			'type'=>'raw',
			'value'=>CHtml::checkBox("validity",$model->validity,array("disabled"=>"disabled"))
		),
		array('label'=>$model->getAttributeLabel('Id_supplier'),
			'type'=>'raw',
			'value'=>$model->supplier->business_name
		),
),
)); ?>

<?php 
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'price-list-item-grid',
	'dataProvider'=>$modelPriceListItem->searchPriceList(),
 	'filter'=>$modelPriceListItem,
	'summaryText'=>'',
	'columns'=>array(
				array(
 				            'name'=>'code',
				            'value'=>'$data->product->code',				 
				),
				array(
 				            'name'=>'code_supplier',
				            'value'=>'$data->product->code_supplier',
				),
				array(
 				            'name'=>'description_customer',
				            'value'=>'$data->product->description_customer', 
				),
				array(
					'name'=>'msrp',
					'value'=>'$data->msrp',							
					'type'=>'raw',					
			        'htmlOptions'=>array('style'=>'text-align: right;'),
				),
				array(
					'name'=>'dealer_cost',
					'value'=>'$data->dealer_cost',
					'type'=>'raw',
			        'htmlOptions'=>array('style'=>'text-align: right;'),
				),
				array(
					'name'=>'profit_rate',
					'value'=>'$data->profit_rate',
					'type'=>'raw',
			        'htmlOptions'=>array('style'=>'text-align: right;'),
				),
			),
)); ?>
