<?php
$this->breadcrumbs=array(
	'Price Lists'=>array('index'),
	$model->description,
);

$this->menu=array(	
	array('label'=>'Create PriceList', 'url'=>array('create')),
	array('label'=>'Manage PriceList', 'url'=>array('admin')),
	array('label'=>'Update PriceList', 'url'=>array('update', 'id'=>$model->Id)),
	array('label'=>'Delete PriceList', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->Id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Assing Products', 'url'=>array('priceListItem','PriceList'=>array('Id'=>$model->Id))),
	array('label'=>'Clone PriceList', 'url'=>array('clonePriceList')),
);
?>

<h1>View PriceList - <?php echo $model->priceListType->name;?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'description',
		array('label'=>$model->getAttributeLabel('Id_price_list_type'),
			'type'=>'raw',
			'value'=>$model->priceListType->name,
		),
		'date_creation',
		'date_validity',
		array('label'=>$model->getAttributeLabel('validity'),
			'type'=>'raw',
			'value'=>CHtml::checkBox("validity",$model->validity,array("disabled"=>"disabled"))
		),
		array('label'=>$model->getAttributeLabel('Id_importer'),
			'type'=>'raw',
			'value'=>$model->importer->contact->description
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
 				            'name'=>'model',
				            'value'=>'$data->product->model',				 
				),
				array(
 				            'name'=>'part_number',
				            'value'=>'$data->product->part_number',				 
				),
				array(
 				            'name'=>'code',
				            'value'=>'$data->product->code',				 
				),
				array(
 				            'name'=>'brand_description',
				            'value'=>'$data->product->brand->description',
				),
				array(
 				            'name'=>'product_short_description',
				            'value'=>'$data->product->short_description', 
				),
				array(
					'name'=>'profit_rate',
					'value'=>'$data->profit_rate',
					'type'=>'raw',
			        'htmlOptions'=>array('style'=>'text-align: right;'),
				),
				array(
					'name'=>'air_cost',
					'value'=>'$data->air_cost',
					'type'=>'raw',
			        'htmlOptions'=>array('style'=>'text-align: right;'),
				),
				array(
					'name'=>'maritime_cost',
					'value'=>'$data->maritime_cost',
					'type'=>'raw',
			        'htmlOptions'=>array('style'=>'text-align: right;'),
				),
	),
)); ?>
