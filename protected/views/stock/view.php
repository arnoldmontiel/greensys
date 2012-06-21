<?php
$this->breadcrumbs=array(
	'Stocks'=>array('index'),
	$model->movementType->description,
);

$this->menu=array(
	array('label'=>'List Stock', 'url'=>array('index')),
	array('label'=>'Create Stock', 'url'=>array('create')),
	array('label'=>'Update Stock', 'url'=>array('update', 'id'=>$model->Id)),
	array('label'=>'Move Stock', 'url'=>array('moveStock', 'id'=>$model->Id)),
	array('label'=>'Delete Stock', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->Id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Stock', 'url'=>array('admin')),
);
?>

<h1>View Stock</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		array('label'=>$model->getAttributeLabel('Id_movement_type'),
			'type'=>'raw',
			'value'=>$model->movementType->description
		),
		array('label'=>$model->getAttributeLabel('Id_project'),
			'type'=>'raw',
			'value'=>isset($model->project)?$model->project->description:""
		),
		'username',
		'creation_date',
		'description',
	),
)); ?>

	<div class="gridTitle-decoration1" style="display: inline-block; width: 97%;height: 35px;margin-top: 10px;">
		<div class="gridTitle1" style="display: inline-block;position: relative; width: 90%;vertical-align: top; margin-top: 4px;">
			Moved Stock
		</div>
	</div>
			<?php 

$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'stock-item-grid',
	'dataProvider'=>$modelStockItem->search(),
 	'filter'=>$modelStockItem,
	'summaryText'=>'',
	'columns'=>array(
				array(
					'name'=>'product_code',
				    'value'=>'$data->product->code',
				),
				array(
					'name'=>'product_code_supplier',
				    'value'=>'$data->product->code_supplier',
	
				),
				array(
					'name'=>'product_customer_desc',
				    'value'=>'$data->product->description_customer',
				),
				array(
 					'name'=>'product_brand_desc',
				    'value'=>'$data->product->brand->description',
				),
				array(
 					'name'=>'product_supplier_name',
				    'value'=>'$data->product->supplier->business_name',
				),
				array(
					'name'=>'quantity',
					'value'=>'$data->quantity',
					'type'=>'raw',
			        'htmlOptions'=>array('width'=>5,'style'=>'text-align:right;'),
				),
			),
)); ?>