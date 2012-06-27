<?php 
Yii::app()->clientScript->registerScript(__CLASS__.'#price_list_sale', "
$('#addAll-sale').hover(
function () {
	$(this).attr('src','images/add_all_blue_light.png');
  },
  function () {
	$(this).attr('src','images/add_all_blue.png');
  S}
);
$('#deleteAll-sale').hover(
function () {
	$(this).attr('src','images/delete_all_blue_light.png');
  },
  function () {
	$(this).attr('src','images/delete_all_blue.png');
  }
);
");
?>
	<div class="gridTitle-decoration1" style="display: inline-block; width: 98%;height: 35px;">
		<div class="gridTitle1" style="display: inline-block;position: relative; width: 90%;vertical-align: top; margin-top: 4px;">
			Products
				<?php echo CHtml::link( '(New Product)','#',array('onclick'=>'jQuery("#CreateProduct").dialog("open"); return false;'));?>
			</div>
		<div style="display: inline-block;position: relative; width: 20px;height:20px; vertical-align: middle;">
		<?php
		echo CHtml::imageButton(
                                'images/add_all_blue.png',
                                array(
                                'title'=>'Add current filtered products',
                                'style'=>'width:30px;',
                                'id'=>'addAll-sale',
                                	'ajax'=> array(
										'type'=>'POST',
										'url'=>PriceListController::createUrl('AjaxAddFilteredProducts'),
										'beforeSend'=>'function(){
													if(!confirm("Are you sure you want to add all filtered products?")) 
														return false;
														}',
										'success'=>'js:function(data)
										{
											$.fn.yiiGridView.update("price-list-item-grid-sale", {
												data: $(this).serialize()
											});
										}'
                                	)
                                )
                                                         
                            ); 
		?>

		</div>
	</div>
	

	<?php		
	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'product-grid-sale',
		'dataProvider'=>$modelProduct->searchSummary(),
		'filter'=>$modelProduct,
		'summaryText'=>'',	
		'selectionChanged'=>'js:function(id){
			$.get(	"'.PriceListController::createUrl('AjaxAddPriceListItemSale').'",
					{
						Id_price_list:$("#PriceList_Id :selected").attr("value"),
						Id_product:$.fn.yiiGridView.getSelection("product-grid-sale")[0],
					}).success(
						function() 
						{
							markAddedRow("product-grid-sale");
							
							$.fn.yiiGridView.update("price-list-item-grid-sale", {
							data: $(this).serialize()
							});
							
							unselectRow("product-grid-sale");		
						})
					.error(
						function(data)
						{
							$(".messageError").animate({opacity: "show"},2000);
							$(".messageError").animate({opacity: "hide"},2000);
							unselectRow("product-grid-sale");
						});
		}',
		'columns'=>array(	
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
				'description_customer',
				'description_supplier',
				array(
					'value'=>'CHtml::image("images/save_ok.png","",array("id"=>"addok-sale", "style"=>"display:none; float:left;", "width"=>"15px", "height"=>"15px"))',
					'type'=>'raw',
					'htmlOptions'=>array('width'=>20),
				),
			),
		));		
		?>



		<p class="messageError"><?php
		echo Yii::app()->lc->t('Product has already been added to selected Price List');
		?></p>
	

	<div class="gridTitle-decoration1" style="display: inline-block; width: 98%;height: 35px;">
		<div class="gridTitle1" style="display: inline-block;position: relative; width: 90%;vertical-align: top; margin-top: 4px;">
			Price List Items
		</div>
		<div style="display: inline-block;position: relative; width: 20px;height:20px; vertical-align: middle;">
<?php
		echo CHtml::imageButton(
                                'images/delete_all_blue.png',
                                array(
                                'title'=>'Delete current filtered products',
                                'width'=>'30px',
                                'id'=>'deleteAll-sale',
                                	'ajax'=> array(
										'type'=>'POST',
										'url'=>PriceListController::createUrl('AjaxDeleteFilteredProducts'),
										'beforeSend'=>'function(){
													if(!confirm("Are you sure you want to delete all filtered products?")) 
														return false;
														}',
										'success'=>'js:function(data)
										{
											$.fn.yiiGridView.update("price-list-item-grid-sale", {
												data: $(this).serialize()
											});
										}'
                                	)
                                )
                                                         
                            ); 
		?>
		</div>
		</div>
		<?php 

$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'price-list-item-grid-sale',
	'dataProvider'=>$model->searchPriceList(),
 	'filter'=>$model,
	'summaryText'=>'',
 	'afterAjaxUpdate'=>'function(id, data){
 										$("#price-list-item-grid-sale").find("input.txtMsrp").each(
												function(index, item){
		
																$(item).keyup(function(){
			        												validateNumber($(this));
																});
												
																$(item).change(function(){
																	
																	var target = $(this);
																	var profitRate = 0;
																	
																	if($(this).parent().parent().find("input.txtDealerCost").val() > 0){
																		profitRate = ($(this).val() / $(this).parent().parent().find("input.txtDealerCost").val()).toFixed(2);
																	}
																	
																	$.post(
																		"'.PriceListController::createUrl('AjaxUpdateMsrp').'",
																		 {
																		 	idPriceListItem: $(this).attr("id"),
																			msrp:$(this).val(),
																			profitRate: profitRate
																		 }).success(
																			 	function() 
																			 		{ 
																			 			$(target).parent().parent().find("#saveok").animate({opacity: "show"},4000);
																						$(target).parent().parent().find("#saveok").animate({opacity: "hide"},4000);
																						if(profitRate> 0){
																							$(target).parent().parent().find("input.txtProfitRate").val(profitRate);
																							$(target).parent().parent().find("#saveok3").animate({opacity: "show"},4000);
 																							$(target).parent().parent().find("#saveok3").animate({opacity: "hide"},4000);
																						}
																					});
																		
																});
													});	
										$("#price-list-item-grid-sale").find("input.txtDealerCost").each(
												function(index, item){
		
																$(item).keyup(function(){
			        												validateNumber($(this));
																});
												
																$(item).change(function(){
																	var target = $(this);
																	var profitRate = 0;
																	
																	if($(this).val() > 0){
																		profitRate = ($(this).parent().parent().find("input.txtMsrp").val() / $(this).val()).toFixed(2);
																	}
																	
																	$.post(
																		"'.PriceListController::createUrl('AjaxUpdateDealerCost').'",
																		 {
																		 	idPriceListItem: $(this).attr("id"),
																			dealerCost:$(this).val(),
																			profitRate: profitRate
																		 }).success(
																			 	function() 
																			 		{ 
																			 			$(target).parent().parent().find("#saveok2").animate({opacity: "show"},4000);
																						$(target).parent().parent().find("#saveok2").animate({opacity: "hide"},4000);
																						if(profitRate> 0){
																							$(target).parent().parent().find("input.txtProfitRate").val(profitRate);
																							$(target).parent().parent().find("#saveok3").animate({opacity: "show"},4000);
 																							$(target).parent().parent().find("#saveok3").animate({opacity: "hide"},4000);
																						} 
																					});
																		
																});
													});	
 									}',	
			'columns'=>array(
				array(
 				            'name'=>'code',
				            'value'=>'$data->product->code',
				 
				),
				array(
 				            'name'=>'description_customer',
				            'value'=>'$data->product->description_customer',
 
				),
				array(
					'name'=>'msrp',
					'value'=>'$data->msrp',
					'type'=>'raw',
			        'htmlOptions'=>array('width'=>5),
				),
				array(
					'name'=>'dealer_cost',
					'value'=>'$data->dealer_cost',
					'type'=>'raw',
			        'htmlOptions'=>array('width'=>5),
				),
				array(
					'name'=>'profit_rate',
					'value'=>'$data->profit_rate',
					'type'=>'raw',
			        'htmlOptions'=>array('width'=>5),
				),
					array(
							'name'=>'AirPurchaseCost',
							'value'=>'$data->AirPurchaseCost',
							'type'=>'raw',
							'htmlOptions'=>array('width'=>5),
					),
						
				array(
					'name'=>'air_cost',
					'value'=>
                                    	'CHtml::textField("txtAirCost",
												$data->air_cost,
												array(
														"id"=>$data->Id,
														"class"=>"pli-air-cost",
														"style"=>"width:50px",
													)
											)',

					'type'=>'raw',

			        'htmlOptions'=>array('width'=>5),
				),
				array(
					'value'=>'CHtml::image("images/save_ok.png","",array("id"=>"saveok1-sale", "style"=>"display:none", "width"=>"20px", "height"=>"20px"))',
					'type'=>'raw',
					'htmlOptions'=>array('width'=>25),
					),
				array(
					'name'=>'MaritimePurchaseCost',
					'value'=>'$data->MaritimePurchaseCost',
					'type'=>'raw',
			        'htmlOptions'=>array('width'=>5),
				),
				array(
					'name'=>'maritime_cost',
					'value'=>
                                    	'CHtml::textField("txtMaritimeCost",
												$data->maritime_cost,
												array(
														"id"=>$data->Id,
														"class"=>"pli-maritime-cost",
														"style"=>"width:50px",
													)
											)',

					'type'=>'raw',

			        'htmlOptions'=>array('width'=>5),
				),
				array(
					'value'=>'CHtml::image("images/save_ok.png","",array("id"=>"saveok2-sale", "style"=>"display:none", "width"=>"20px", "height"=>"20px"))',
					'type'=>'raw',
					'htmlOptions'=>array('width'=>25),
				),
				array(
					'class'=>'CButtonColumn',
					'template'=>'{delete}',
					'buttons'=>array
					(
					        'delete' => array
							(
					            'url'=>'Yii::app()->createUrl("pricelist/AjaxDeletePriceListItem", array("id"=>$data->Id))',
							),
					),
				),
			),
)); ?>
