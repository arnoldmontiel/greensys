<?php 
Yii::app()->clientScript->registerScript(__CLASS__.'#price_list_purchase', "
		
$('#addAll').hover(
function () {
	$(this).attr('src','images/add_all_blue_light.png');
  },
  function () {
	$(this).attr('src','images/add_all_blue.png');
  }
);
$('#deleteAll').hover(
function () {
	$(this).attr('src','images/delete_all_blue_light.png');
  },
  function () {
	$(this).attr('src','images/delete_all_blue.png');
  }
);

$('#addAll').click(
		function()
		{
			if(!confirm('Are you sure you want to add all filtered products?'))
			{ 
				return false;
			}
		
			$.post('".PriceListController::createUrl('AjaxAddFilteredProducts')."',
				$.param(
					$('#product-grid .filters input,  #product-grid .filters select')
					)+'&Id_price_list='+$('#PriceList_Id').val(),
				function(data){
					$.fn.yiiGridView.update('price-list-item-grid');
				}
			);	
			return false;				
		}
);

$('#deleteAll').click(
		function()
		{
			if(!confirm('Are you sure you want to delete all filtered products?'))
			{ 
				return false;
			}
		
			$.post('".PriceListController::createUrl('AjaxDeleteFilteredProducts')."',
				$.param(
					$('#price-list-item-grid .filters input,  #price-list-item-grid .filters select')
					)+'&Id_price_list='+$('#PriceList_Id').val(),
				function(data){
					$.fn.yiiGridView.update('price-list-item-grid');
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
									jQuery("#product-grid-container").toggle("blind",{},1000);
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
                                'id'=>'addAll',
                                )
                                                         
                            ); 
		?>

		</div>
	</div>
	<div id="product-grid-container" style="display:none">

	<?php		
	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'product-grid',
		'dataProvider'=>$modelProduct->searchSummary(),
		'filter'=>$modelProduct,
		'summaryText'=>'',	
		'selectableRows'=>0,
		'selectionChanged'=>'js:function(id){
			$(".messageError").animate({opacity: "hide"},2000);

			$.get(	"'.PriceListController::createUrl('AjaxAddPriceListItem').'",
					{
						IdPriceList:$("#PriceList_Id").val(),
						IdProduct:$.fn.yiiGridView.getSelection("product-grid")
					}).success(
						function() 
						{
							markAddedRow("product-grid");
							
							$.fn.yiiGridView.update("price-list-item-grid", {
							data: $(this).serialize()
							});
							
							unselectRow("product-grid");		
						})
					.error(
						function(data)
						{
							$(".messageError").html(data.responseText);
							$(".messageError").animate({opacity: "show"},2000.,function(){$(".messageError").animate({opacity: "hide"},2000)});
							unselectRow("product-grid");
						});
		}',
		'columns'=>array(	
				'model',
				'part_number',
				array(
					'name'=>'code',
				    'value'=>'CHtml::link($data->code,"#",array("id"=>$data->Id,"class"=>"product-link-popup"))',
					'type'=>'raw'				 
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

			$.get(	"'.PriceListController::createUrl('AjaxAddPriceListItem').'",
					{
						IdPriceList:$("#PriceList_Id").val(),
						IdProduct:$.fn.yiiGridView.getSelection("product-grid")
					}).success(
						function() 
						{
							markAddedRow("product-grid");
							
							$.fn.yiiGridView.update("price-list-item-grid", {
							data: $(this).serialize()
							});
							
							unselectRow("product-grid");		
						})
					.error(
						function(data)
						{
							$(".messageError").html(data.responseText);
							$(".messageError").animate({opacity: "show"},2000.,function(){$(".messageError").animate({opacity: "hide"},2000)});
							unselectRow("product-grid");
						});
									            		return false;
													}',
								),
				
						),
				),
				array(
					'value'=>'CHtml::image("images/save_ok.png","",array("id"=>"addok", "style"=>"display:none; float:left;", "width"=>"15px", "height"=>"15px"))',
					'type'=>'raw',
					'htmlOptions'=>array('width'=>20),
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
                                'id'=>'deleteAll',
                                )
                                                         
                            ); 
		?>
		</div>
		</div>
		<?php 

$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'price-list-item-grid',
	'dataProvider'=>$model->searchPriceList(),
 	'filter'=>$model,
	'summaryText'=>'',
 	'afterAjaxUpdate'=>'function(id, data){
 										$("#price-list-item-grid").find("input.txtMsrp").each(
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
										$("#price-list-item-grid").find("input.txtDealerCost").each(
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
// 										$("#price-list-item-grid").find("input.txtProfitRate").each(
// 												function(index, item){
		
// 																$(item).keyup(function(){
// 			        												validateNumber($(this));
// 																});
												
// 																$(item).change(function(){
// 																	var target = $(this);
// 																	$.post(
// 																		"'.PriceListController::createUrl('AjaxUpdateProfitRate').'",
// 																		 {
// 																		 	idPriceListItem: $(this).attr("id"),
// 																			profitRate:$(this).val()
// 																		 }).success(
// 																			 	function() 
// 																			 		{ 
// 																			 			$(target).parent().parent().find("#saveok3").animate({opacity: "show"},4000);
// 																						$(target).parent().parent().find("#saveok3").animate({opacity: "hide"},4000); 
// 																					});
																		
// 																});
// 													});	
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
					'value'=>
                                    	'CHtml::textField("txtMsrp",
												$data->msrp,
												array(
														"id"=>$data->Id,
														"class"=>"txtMsrp",
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
					'name'=>'dealer_cost',
					'value'=>
                                    	'CHtml::textField("txtDealerCost",
												$data->dealer_cost,
												array(
														"id"=>$data->Id,
														"class"=>"txtDealerCost",
														"style"=>"width:50px;text-align:right;",
													)
											)',
	
					'type'=>'raw',
					'htmlOptions'=>array("style"=>"text-align:right;"),
				),
				array(
					'value'=>'CHtml::image("images/save_ok.png","",array("id"=>"saveok2", "style"=>"display:none", "width"=>"20px", "height"=>"20px"))',
					'type'=>'raw',
					'htmlOptions'=>array('width'=>25),
				),
				array(
					'name'=>'profit_rate',
					'value'=>
                                    	'CHtml::textField("txtProfitRate",
												$data->profit_rate,
												array(
														"id"=>$data->Id,
														"class"=>"txtProfitRate",
														"disabled"=>"disabled",
														"style"=>"width:50px;text-align:right;",
													)
											)',

					'type'=>'raw',

			        'htmlOptions'=>array('width'=>5),
				),
				array(
					'value'=>'CHtml::image("images/save_ok.png","",array("id"=>"saveok3", "style"=>"display:none", "width"=>"20px", "height"=>"20px"))',
					'type'=>'raw',
					'htmlOptions'=>array('width'=>25),
				),
				array(
						'value'=>'CHtml::image("images/grid_warning.png","",array("title"=>$data->product->getWarningsDescription("hasMeasure"),"style"=>$data->product->getHasWarnings("hasMeasure")?"display":"display:none"))',
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
