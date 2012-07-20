
<div id="display">



<?php 

$this->widget('zii.widgets.CDetailView', array(
	'data'=>$modelBudgetItemParent,
	'attributes'=>array(
		array('label'=>$modelBudgetItemParent->getAttributeLabel('product_code'),
					'type'=>'raw',
					'value'=>$modelBudgetItemParent->product->code
		),
		array('label'=>$modelBudgetItemParent->getAttributeLabel('product_customer_desc'),
			'type'=>'raw',
			'value'=>$modelBudgetItemParent->product->description_customer
		),
		array('label'=>$modelBudgetItemParent->getAttributeLabel('product_brand_desc'),
			'type'=>'raw',
			'value'=>$modelBudgetItemParent->product->brand->description
		),
		array('label'=>$modelBudgetItemParent->getAttributeLabel('product_supplier_name'),
			'type'=>'raw',
			'value'=>$modelBudgetItemParent->product->supplier->business_name
		),
		array('label'=>$modelBudgetItemParent->getAttributeLabel('price'),
			'type'=>'raw',
			'value'=>$modelBudgetItemParent->price
		),
	)
));

$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'budget-item-children-grid_'.$idArea,
	'dataProvider'=>$modelBudgetItem->search(),
	'enableSorting'=>false,
	'summaryText'=>'',
	'columns'=>array(
				array(
					'name'=>'product_code',
				    'value'=>'$data->product->code',				 
				),
				array(
					'name'=>'parent_product_code',
				    'value'=>'$data->budgetItem->product->code',
	
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
 					'name'=>'price',
				    'value'=>'$data->price',
					'type'=>'raw',
			        'htmlOptions'=>array('style'=>'text-align: right;'),
				),
				array(
					'class'=>'CButtonColumn',
					'template'=>($canEdit)?'{delete}':'',
					'buttons'=>array
					(
					        'delete' => array
							(
					            'url'=>'Yii::app()->createUrl("budget/AjaxDeleteBudgetItem", array("id"=>$data->Id))',
							),
					),
				),
			),
)); ?>
</div>