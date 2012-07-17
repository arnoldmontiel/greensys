<?php		

	$dataProvider = $modelProduct->searchSummary();
	$dataProvider = ($type == "byCat")?$modelProduct->searchByCategory():$dataProvider;
	$dataProvider = ($type == "byProd")?$modelProduct->searchByProduct():$dataProvider;
	
	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'product-grid_'. $idArea.$type,
		'dataProvider'=>$dataProvider,
		'filter'=>$modelProduct,
		'summaryText'=>'',	
		'selectionChanged'=>'js:function(){
		
			$.fn.yiiGridView.update("price-list-item-grid_'.$idArea.$type.'", {
				data: "ProductSale[Id]="+$.fn.yiiGridView.getSelection("product-grid_'.$idArea.$type.'")
			});
			
			var idProduct = $.fn.yiiGridView.getSelection("product-grid_'.$idArea.$type.'");
			if(idProduct!="")
			{
				$( "#displayPrices_'. $idArea.$type.'" ).animate({opacity: "show"},"slow");
			}
			else
			{
				$( "#displayPrices_'. $idArea.$type.'"  ).animate({opacity: "hide"},"slow");
			}
			
		}',
		'columns'=>array(	
				array(
					'name'=>'code',
				    'value'=>'$data->code',
				 
				),
				array(
 				    'name'=>'code_supplier',
				    'value'=>'$data->code_supplier',
 
				),
				array(
		 			'name'=>'brand_description',
					'value'=>'$data->brand->description',
				),
				array(
			 		'name'=>'category_description',
					'value'=>'$data->category->description',
				),
				'description_customer',
				'description_supplier',
				array(
					'value'=>'CHtml::image("images/save_ok.png","",array("id"=>"addok", "style"=>"display:none; float:left;", "width"=>"15px", "height"=>"15px"))',
					'type'=>'raw',
					'htmlOptions'=>array('width'=>20),
				),
			),
		));		
		?>	
		
<div id="displayPrices_<?php echo $idArea.$type; ?>" style="display: none">
<?php
 $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'price-list-item-grid_'. $idArea.$type,
	'dataProvider'=>$priceListItemSale->searchForBudget(),
	'filter'=>$priceListItemSale,
 	'summaryText'=>'',
 	'afterAjaxUpdate'=>'function(id, data){
 				$("#price-list-item-grid_'.$idArea.$type.'").find(":radio").each(
												function(index, item){
													$(item).change(function(){
															
														if(!confirm("Are you sure you want to select this price?")) 
														{
															$.fn.yiiGridView.update("price-list-item-grid_'.$idArea.$type.'");
															return false;
														}
														$.post(
															"'.BudgetController::createUrl('AjaxAddBudgetItem').'",
															{
																	IdBudget: "'.$model->Id.'",
																	IdVersion: "'.$model->version_number.'",
																 	IdPriceList: $(this).attr("idPriceList"),
																 	IdProduct: $(this).attr("idProduct"),
																 	IdArea: "'.$idArea.'",
																 	IdShippingType: $(this).attr("idShippingType")
															}).success(
																function(data) 
																{ 
																	$.fn.yiiGridView.update("budget-item-grid_'.$idArea.'", {
																		data: $(this).serialize()
																	});
																	$.fn.yiiGridView.update("price-list-item-grid_'.$idArea.$type.'");
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
		'msrp',
		'dealer_cost',
		'profit_rate',
 		array(
   			'name'=>'maritime_days',
  			'value'=>'$data->priceList->importer->currentMaritimeDelayDays',
 		),
		'maritime_cost',
		array(
 			'type'=>'raw',
 			'value'=>'CHtml::radioButton("rbtPrice","",array("idPriceList"=>$data->Id_price_list,"idProduct"=>$data->Id_product,"idShippingType"=>1))',
		),
 		array(
    		'name'=>'air_days',
   			'value'=>'$data->priceList->importer->currentAirDelayDays',
 		),
		'air_cost',
		 array(
	  			'type'=>'raw',
	  			'value'=>'CHtml::radioButton("rbtPrice","",array("idPriceList"=>$data->Id_price_list,"idProduct"=>$data->Id_product,"idShippingType"=>2))',
		 ),
	),
)); ?>
</div>