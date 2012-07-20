
<div id="display">



<?php 

$this->widget('zii.widgets.CDetailView', array(
	'data'=>$modelProduct,
	'attributes'=>array(
			'code',
		'code_supplier',
		array('label'=>$modelProduct->getAttributeLabel('Id_supplier'),
					'type'=>'raw',
					'value'=>$modelProduct->supplier->business_name
		),
		array('label'=>$modelProduct->getAttributeLabel('Id_brand'),
			'type'=>'raw',
			'value'=>$modelProduct->brand->description
		),
		array('label'=>$modelProduct->getAttributeLabel('Id_category'),
			'type'=>'raw',
			'value'=>$modelProduct->category->description
		),
		array('label'=>$modelProduct->getAttributeLabel('Id_sub_category'),
			'type'=>'raw',
			'value'=>$modelProduct->subCategory->description
		),
		array('label'=>$modelProduct->getAttributeLabel('Id_product_type'),
			'type'=>'raw',
			'value'=>$modelProduct->productType->description
		),
		array('label'=>$modelProduct->getAttributeLabel('Id_nomenclator'),
			'type'=>'raw',
			'value'=>$modelProduct->nomenclator->description
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