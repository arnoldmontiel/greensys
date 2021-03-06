<?php 
Yii::app()->clientScript->registerScript(__CLASS__.'#price_list_sale', "
		
$('#addAll-sale').hover(
function () {
	$(this).attr('src','images/add_all_blue_light.png');
  },
  function () {
	$(this).attr('src','images/add_all_blue.png');
  }
);
$('#deleteAll-sale').hover(
function () {
	$(this).attr('src','images/delete_all_blue_light.png');
  },
  function () {
	$(this).attr('src','images/delete_all_blue.png');
  }
);
		
$('#addAll-sale').click(
		function()
		{
			if(!confirm('Are you sure you want to add all filtered products?'))
			{ 
				return false;
			}
			$.post('".PriceListController::createUrl('AjaxAddFilteredProductsSale')."',
				$.param(
					$('#product-grid-sale .filters input,  #product-grid-sale .filters select')
					)+'&Id_price_list='+$('#PriceList_Id').val(),
				function(data){
					$.fn.yiiGridView.update('price-list-item-grid-sale');
				}
			);	
			return false;		
		}
);


$('#deleteAll-sale').click(
		function()
		{
			if(!confirm('Are you sure you want to delete all filtered products?'))
			{ 
				return false;
			}
		
			$.post('".PriceListController::createUrl('AjaxDeleteFilteredProducts')."',
				$.param(
					$('#price-list-item-grid-sale .filters input,  #price-list-item-grid-sale .filters select')
					)+'&Id_price_list='+$('#PriceList_Id').val(),
				function(data){
					$.fn.yiiGridView.update('price-list-item-grid-sale');
				}
			);	
			return false;				
		}
);

");
?>
	<div class="gridTitle-decoration1" style="display: inline-block; width: 98%;height: 35px;margin-bottom: 5px;">
		<div class="gridTitle1" style="display: inline-block;position: relative; width: 90%;vertical-align: top; margin-top: 4px;">
								<?php 		echo CHtml::link('+ Select Products',
						'#',
						array(	'id'=>'expand-products',
								'onclick'=>'
									jQuery("#product-grid-sale-container").toggle("blind",{},1000);
									if($(this).html()=="+ Select Products")
									{
										$(this).html("- Select Products");
									}
									else
									{
										$(this).html("+ Select Products");
									}
									return false;
								'
								)
							)
					?>		
		
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
                                )
                                                         
                            ); 
		?>

		</div>
	</div>
	
	<div id="product-grid-sale-container" style="display:none">
	
	<?php		
	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'product-grid-sale',
		'dataProvider'=>$modelProduct->searchSummary(),
		'filter'=>$modelProduct,
		//'ajaxUrl'=>PriceListController::createUrl('AjaxUpdateProductGrid'),				
		'summaryText'=>'',	
		'selectableRows'=>0,
		'selectionChanged'=>'js:function(id){
			$(".messageError").animate({opacity: "hide"},2000);
			$.get(	"'.PriceListController::createUrl('AjaxAddPriceListItemSale').'",
					{
						Id_price_list:$("#PriceList_Id").val(),
						Id_product:$.fn.yiiGridView.getSelection("product-grid-sale")[0],
					}).success(
						function() 
						{
							markAddedRow("product-grid-sale");
							
							$.fn.yiiGridView.update("price-list-item-grid-sale", {
							data: $(this).serialize()+$("#PriceList_Id").serialize()
							});
							
							unselectRow("product-grid-sale");		
						})
					.error(
						function(data)
						{
							$(".messageError").html(data.responseText);
							$(".messageError").animate({opacity: "show"},2000.,function(){$(".messageError").animate({opacity: "hide"},2000)});
							unselectRow("product-grid-sale");
						});
		}',
		'columns'=>array(
				'model',
				'part_number',
				'code',	
				array(
		 			'name'=>'brand_description',
					'value'=>'$data->brand->description',
				),
				array(
			 		'name'=>'category_description',
					'value'=>'$data->category->description',
				),
				'short_description',
array
(
		'class'=>'CButtonColumn',
		'template'=>'{agregar}',
		'buttons'=>array
		(
				'agregar' => array
				(
						'click'=>'function(){
            								$(this).parent().parent().addClass("selected");
			$(".messageError").animate({opacity: "hide"},20);

			$.get(	"'.PriceListController::createUrl('AjaxAddPriceListItemSale').'",
					{
						Id_price_list:$("#PriceList_Id").val(),
						Id_product:$.fn.yiiGridView.getSelection("product-grid-sale")[0],
					}).success(
						function()
						{
							markAddedRow("product-grid-sale");
				
							$.fn.yiiGridView.update("price-list-item-grid-sale", {
							data: $(this).serialize()+$("#PriceList_Id").serialize()
							});
				
							unselectRow("product-grid-sale");
						})
					.error(
						function(data)
						{
							$(".messageError").html(data.responseText);
							$(".messageError").animate({opacity: "show"},2000.,function(){$(".messageError").animate({opacity: "hide"},2000)});
							unselectRow("product-grid-sale");
						});
					return false;
													}',
				),

		),
),

				array(
						'value'=>'CHtml::image("images/grid_warning.png","",array("title"=>$data->getWarningsDescription("hasPriceListPurch"),"style"=>$data->getHasWarnings("hasPriceListPurch")?"display":"display:none"))',
						'type'=>'raw',
						'htmlOptions'=>array('width'=>25),
				),
				array(
						'value'=>'CHtml::image("images/grid_warning.png","",array("title"=>$data->getWarningsDescription("hasMeasure"),"style"=>$data->getHasWarnings("hasMeasure")?"display":"display:none"))',
						'type'=>'raw',
						'htmlOptions'=>array('width'=>25),
				),
			),
		));		
		?>

</div>

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
								'style'=>'width:30px;',
                                'id'=>'deleteAll-sale',                                	
                                )
                                                         
                            ); 
		?>
		</div>
		</div>
		<?php 
	$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'price-list-item-grid-sale',
	//'ajaxUrl'=>PriceListController::createUrl('AjaxUpdatePriceListItemGrid'),
	'dataProvider'=>$model->searchPriceList(),
 	'filter'=>$model,
	'summaryText'=>'',
 	'afterAjaxUpdate'=>'function(id, data){
 										$("#price-list-item-grid-sale").find("input.txtMaritimeCost").each(
												function(index, item){
																$(item).keyup(function(){
			        												validateNumber($(this));
																});
												
																$(item).change(function(){
																	
																	var target = $(this);
																	
																	$.post(
																		"'.PriceListController::createUrl('AjaxUpdateMaritimeCost').'",
																		 {
																		 	id_price_list_item: $(this).attr("id"),
																			maritime_cost:$(this).val()
																		 }).success(
																			 	function() 
																			 		{ 
																			 			$(target).parent().parent().find("#saveok2-sale").animate({opacity: "show"},4000,
																						function(){$(target).parent().parent().find("#saveok2-sale").animate({opacity: "hide"},4000);});																						
																					});
																		
																});
													});	
										$("#price-list-item-grid-sale").find("input.txtAirCost").each(
												function(index, item){
		
																$(item).keyup(function(){
			        												validateNumber($(this));
																});
												
																$(item).change(function(){
																	var target = $(this);
																	
																	$.post(
																		"'.PriceListController::createUrl('AjaxUpdateAirCost').'",
																		 {
																		 	id_price_list_item: $(this).attr("id"),
																			air_cost:$(this).val()
																		 }).success(
																			 	function() 
																			 		{ 
																			 			$(target).parent().parent().find("#saveok1-sale").animate({opacity: "show"},4000,
																						function(){$(target).parent().parent().find("#saveok1-sale").animate({opacity: "hide"},4000);});																						
																					});
																		
																});
													});	
 									}',	
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
					'name'=>'msrp',
					'value'=>'$data->msrp',
					'type'=>'raw',
			        'htmlOptions'=>array("style"=>"width:50px;text-align:right;"),
				),
				array(
					'name'=>'dealer_cost',
					'value'=>'$data->dealer_cost',
					'type'=>'raw',
			        'htmlOptions'=>array("style"=>"width:50px;text-align:right;"),
				),
				array(
					'name'=>'profit_rate',
					'value'=>'$data->profit_rate',
					'type'=>'raw',
			        'htmlOptions'=>array("style"=>"width:50px;text-align:right;"),
				),
					array(
							'name'=>'AirPurchaseCost',
							'value'=>'$data->AirPurchaseCost',
							'type'=>'raw',
							'htmlOptions'=>array("style"=>"width:50px;text-align:right;"),
					),
						
				array(
					'name'=>'air_cost',
					'value'=>
                                    	'CHtml::textField("txtAirCost",
												$data->air_cost,
												array(
														"id"=>$data->Id,
														"class"=>"txtAirCost",
														"style"=>"width:50px;text-align:right;",
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
			        'htmlOptions'=>array("style"=>"width:50px;text-align:right;"),
				),
				array(
					'name'=>'maritime_cost',
					'value'=>
                                    	'CHtml::textField("txtMaritimeCost",
												$data->maritime_cost,
												array(
														"id"=>$data->Id,
														"class"=>"txtMaritimeCost",
														"style"=>"width:50px;text-align:right;",
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
					            'url'=>'Yii::app()->createUrl("priceList/AjaxDeletePriceListItem", array("id"=>$data->Id))',
							),
					),
				),
			),
)); ?>
