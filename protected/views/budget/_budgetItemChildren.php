
<div id="display">



<?php 

// $this->widget('zii.widgets.CDetailView', array(
// 	'data'=>$modelBudgetItemParent,
// 	'attributes'=>array(
// 		array('label'=>$modelBudgetItemParent->getAttributeLabel('product_code'),
// 					'type'=>'raw',
// 					'value'=>$modelBudgetItemParent->product->code
// 		),
// 		array('label'=>$modelBudgetItemParent->getAttributeLabel('product_customer_desc'),
// 			'type'=>'raw',
// 			'value'=>$modelBudgetItemParent->product->description_customer
// 		),
// 		array('label'=>$modelBudgetItemParent->getAttributeLabel('product_brand_desc'),
// 			'type'=>'raw',
// 			'value'=>$modelBudgetItemParent->product->brand->description
// 		),
// 		array('label'=>$modelBudgetItemParent->getAttributeLabel('product_supplier_name'),
// 			'type'=>'raw',
// 			'value'=>$modelBudgetItemParent->product->supplier->business_name
// 		),
// 		array('label'=>$modelBudgetItemParent->getAttributeLabel('price'),
// 			'type'=>'raw',
// 			'value'=>$modelBudgetItemParent->price
// 		),
// 	)
// ));

$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'budget-item-children-grid',
	'dataProvider'=>$modelBudgetItem->search(),
	'ajaxUrl'=>BudgetController::createUrl('AjaxBudgetItemChildren'),
	'enableSorting'=>false,
	'selectableRows'=>1,
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
 					'type'=>'raw',
 					'value'=>'CHtml::checkBox("chkChild",$data->is_included,array("idProduct"=>$data->Id_product, "idBudgetItem"=>$data->Id))',
				),
			),
)); ?>
</div>

<div id="displayChildrenPrices" style="display: none">
<?php
 $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'price-list-item-child-grid',
	'dataProvider'=>$priceListItemSale->searchForBudget(),
 	'ajaxUrl'=>BudgetController::createUrl('AjaxBudgetItemChildren'),
 	'summaryText'=>'',
 	'afterAjaxUpdate'=>'function(id, data){
 				$("#price-list-item-child-grid").find(":radio").each(
												function(index, item){
													$(item).change(function(){
														
 														var idBudgetItem = $.fn.yiiGridView.getSelection("budget-item-children-grid"); 
														if(!confirm("Are you sure you want to select this price?")) 
														{
															$.fn.yiiGridView.update("price-list-item-child-grid", {
																data: "ProductSale[Id]=" + $(this).attr("idProduct")
															});
															return false;
														}
														$.post(
															"'.BudgetController::createUrl('AjaxUpdateChildPrice').'",
															{
																 	IdPriceList: $(this).attr("idPriceList"),
																 	IdProduct: $(this).attr("idProduct"),																 	
																 	IdShippingType: $(this).attr("idShippingType"),
																 	IdBudgetItem: idBudgetItem,
																 	price: $(this).attr("price")
															}).success(
																function(data) 
																{ 
																	$.fn.yiiGridView.update("budget-item-children-grid", {
 																		data: "BudgetItem[Id]=" + idBudgetItem
 																	});
																	$("#displayChildrenPrices" ).toggle("blind",{},1000);
																});
														
													});
												}
										);
 		}',
	'columns'=>array(
		array(
 			'name'=>'importer_desc',
			'value'=>'$data->priceList->importer->contact->description',
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
 		array(
   			'name'=>'maritime_days',
  			'value'=>'$data->priceList->importer->currentMaritimeDelayDays',
 			'type'=>'raw',
  			'htmlOptions'=>array('style'=>'text-align: right;'),
 		),
 		array(
    		'name'=>'maritime_cost',
   			'value'=>'$data->maritime_cost',
  			'type'=>'raw',
   			'htmlOptions'=>array('style'=>'text-align: right;'),
 		),
		array(
 			'type'=>'raw',
 			'value'=>'CHtml::radioButton("rbtChildPrice","",array("price"=>$data->maritime_cost, "idPriceList"=>$data->Id_price_list,"idProduct"=>$data->Id_product,"idShippingType"=>1))',
		),
 		array(
    		'name'=>'air_days',
   			'value'=>'$data->priceList->importer->currentAirDelayDays',
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
	  			'type'=>'raw',
	  			'value'=>'CHtml::radioButton("rbtChildPrice","",array("price"=>$data->air_cost, "idPriceList"=>$data->Id_price_list,"idProduct"=>$data->Id_product,"idShippingType"=>2))',
		 ),
	),
)); ?>
</div>