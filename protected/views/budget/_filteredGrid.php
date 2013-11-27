<?php		

	$dataProvider = $modelProduct->searchSummary();
	$dataProvider = ($type == "byCat")?$modelProduct->searchByCategory():$dataProvider;
	$dataProvider = ($type == "byProd")?$modelProduct->searchByProduct():$dataProvider;
	
	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'product-grid_'. $idAreaProject.$idArea.$type,
		'dataProvider'=>$dataProvider,
		'filter'=>$modelProduct,
		'summaryText'=>'',	
		'selectionChanged'=>0,
		'columns'=>array(	
				array(
					'name'=>'model',
				    'value'=>'$data->model',				 
				),
				array(
					'name'=>'part_number',
				    'value'=>'$data->part_number',				 
				),
				array(
					'name'=>'code',
				    'value'=>'$data->code',				 
				),
				array(
		 			'name'=>'brand_description',
					'value'=>'$data->brand->description',
				),
				array(
			 		'name'=>'category_description',
					'value'=>'$data->category->description',
				),
				'short_description',
				array(
						'value'=>'CHtml::image("images/grid_warning.png","",array("title"=>$data->getWarningsDescription("hasPriceListSale"),"style"=>$data->getHasWarnings("hasPriceListSale")?"display":"display:none"))',
						'type'=>'raw',
						'htmlOptions'=>array('width'=>25),
				),
				array
				(
				    'class'=>'CButtonColumn',
				    'template'=>'{selectRowBtn}',
				    'buttons'=>array
					(
						'selectRowBtn' => array
						(
							'imageUrl'=>'images/rbn_no.png',
							'click'=>'function(){
								if($(this).parent().parent().hasClass("selected"))
								{
									$(this).children().attr("src","images/rbn_no.png");
									$("#product-grid_'.$idAreaProject.$idArea.$type.'").find("tr").removeClass("selected");
								}
								else
								{
									$("#product-grid_'.$idAreaProject.$idArea.$type.'").find("tr").removeClass("selected");
									$("#product-grid_'.$idAreaProject.$idArea.$type.'").find(".selectRowBtn").children().attr("src","images/rbn_no.png");
									$(this).parent().parent().addClass("selected");
									$(this).children().attr("src","images/rbn_yes.png")
								}
								
								$.fn.yiiGridView.update("price-list-item-grid_'.$idAreaProject.$idArea.$type.'", {
									data: "ProductSale[Id]="+$.fn.yiiGridView.getSelection("product-grid_'.$idAreaProject.$idArea.$type.'")
								});
								
								var idProduct = $.fn.yiiGridView.getSelection("product-grid_'.$idAreaProject.$idArea.$type.'");
								if(idProduct!="")
								{
									$( "#displayPrices_'.$idAreaProject. $idArea.$type.'" ).animate({opacity: "show"},"slow");
								}
								else
								{
									$( "#displayPrices_'.$idAreaProject. $idArea.$type.'"  ).animate({opacity: "hide"},"slow");
								}
								return false;
							}',
						),
				
					),
				),
			),
		));		
		?>	
		
<div id="displayPrices_<?php echo $idAreaProject.$idArea.$type; ?>" style="display: none">
<?php
 $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'price-list-item-grid_'.$idAreaProject. $idArea.$type,
	'dataProvider'=>$priceListItemSale->searchForBudget(),
	'filter'=>$priceListItemSale,
 	'emptyText'=>Yii::app()->lc->t('The selected product has not been included in a price list of sales.'),
 	'summaryText'=>'',
 	'afterAjaxUpdate'=>'function(id, data){
 				$("#price-list-item-grid_'.$idAreaProject.$idArea.$type.'").find(":radio").each(
												function(index, item){
													$(item).change(function(){
															
														if(!confirm("Are you sure you want to select this price?")) 
														{
															$.fn.yiiGridView.update("price-list-item-grid_'.$idAreaProject.$idArea.$type.'");
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
																 	IdAreaProject: "'.$idAreaProject.'",
 																	IdShippingType: $(this).attr("idShippingType")
															}).success(
																function(data) 
																{ 
																	$.fn.yiiGridView.update("budget-item-grid_'.$idAreaProject.$idArea.'", {
																		data: $(this).serialize()
																	});
																	$.fn.yiiGridView.update("price-list-item-grid_'.$idAreaProject.$idArea.$type.'");
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
 			'value'=>'CHtml::radioButton("rbtPrice","",array("idPriceList"=>$data->Id_price_list,"idProduct"=>$data->Id_product,"idShippingType"=>1))',
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
	  			'value'=>'CHtml::radioButton("rbtPrice","",array("idPriceList"=>$data->Id_price_list,"idProduct"=>$data->Id_product,"idShippingType"=>2))',
		 ),
	),
)); ?>
</div>