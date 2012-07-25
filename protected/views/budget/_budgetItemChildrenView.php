
<div id="display">


<table id="yw3" class="detail-view">
	<tbody>
		<tr class="odd">
			<th>Code</th>
			<td id="parent_code"></td>
		</tr>
		<tr class="even">
			<th>Description Customer</th>
			<td id="parent_customer_desc"></td>
		</tr>
		<tr class="odd">
			<th>Brand Description</th>
			<td id="parent_brand_desc"></td>
		</tr>
		<tr class="even">
			<th>Supplier Name</th>
			<td id="parent_supplier_name"></td>
		</tr>
		<tr class="odd">
			<th>Price</th>
			<td id="parent_price"></td>
		</tr>
	</tbody>
</table>
<?php 
echo CHtml::hiddenField("IdItemBudgetParent","",array("id"=>"IdItemBudgetParent"));

$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'budget-item-children-grid',
	'dataProvider'=>$modelBudgetItem->search(),
	'ajaxUrl'=>BudgetController::createUrl('AjaxBudgetItemChildrenView'),
	'enableSorting'=>false,
	'selectableRows'=>1,
	'summaryText'=>'',
	'afterAjaxUpdate'=>'function(id, data){
							$.post(
								"'.BudgetController::createUrl('AjaxGetChildrenTotalPrice').'",
									{
										IdBudgetItem: $("#IdItemBudgetParent").val()
									}).success(
									function(data) 
									{ 
										$("#children_total_price").val(data);
									});
									
							$("#budget-item-children-grid").find("input.txtQuantity").each(
									function(index, item){

														$(item).keyup(function(){
															validateNumber($(this));
														});
														$(item).change(function(){
																	
															var target = $(this);
															var profitRate = 0;
																	
															$.post(
																"'.BudgetController::createUrl('AjaxUpdateQuantity').'",
																	{
																		IdBudgetItem: $(this).attr("id"),
																		quantity:$(this).val()
																	}).success(
																	function() 
																	{ 
																		$(target).parent().parent().find("#saveok").animate({opacity: "show"},4000);
																		$(target).parent().parent().find("#saveok").animate({opacity: "hide"},4000);
																	});
																		
														});
									});
			}	',
	'columns'=>array(
				array(
					'name'=>'product_code',
				    'value'=>'$data->product->code',		
					'footer'=>'Total'
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
					'footer'=>'<input id="children_total_price" class="txt-children-total-price" type="text" name="txt_purchase_order_price_shipping_total"  disabled="disabled" style="width:50px;text-align:right;">',
				),
				array(
					'name'=>'quantity',
					'value'=>
                                    	'CHtml::textField("txtQuantity",
												$data->quantity,
												array(
														"id"=>$data->Id,
														"class"=>"txtQuantity",
														"disabled"=>"disabled",
														"style"=>"width:50px;text-align:right;",
													)
											)',

					'type'=>'raw',
					'htmlOptions'=>array("style"=>"text-align:right;"),
				),
				array(
					'value'=>'CHtml::image("images/save_ok.png","",array("id"=>"saveok", "style"=>"display:none", "width"=>"20px", "height"=>"20px"))',
					'type'=>'raw',
					'htmlOptions'=>array('width'=>25),
				),
				array(
 					'type'=>'raw',
 					'value'=>'CHtml::checkBox("chkChild",$data->is_included,array("idProduct"=>$data->Id_product, 
 																				"idBudgetItem"=>$data->Id, 
 																				"idBudgetItemParent"=>$data->Id_budget_item,
 																				"disabled"=>"disabled"))',
				),
			),
)); 

?>
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