<?php
$this->breadcrumbs=array(
	'Stocks'=>array('index'),
	$model->project->description=>array('view','id'=>$model->Id, 'version'=>$model->version_number),
	'Add Products',
);

$this->menu=array(
	array('label'=>'List Budget', 'url'=>array('index')),
	array('label'=>'Create Budget', 'url'=>array('create')),
	array('label'=>'Update Budget', 'url'=>array('update', 'id'=>$model->Id, 'version'=>$model->version_number)),
	array('label'=>'Delete Budget', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->Id, 'version'=>$model->version_number),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Budget', 'url'=>array('admin')),
);
$this->widget('ext.processingDialog.processingDialog', array(
		'buttons'=>array('none'),
		'idDialog'=>'waiting',
));

Yii::app()->clientScript->registerScript(__CLASS__.'add-item-budget', "
function setTotals()
		{
			$.post(
				'".PriceListController::createUrl('AjaxGetTotals')."',
				 {
				 	Id: ".$model->Id.",
					version_number:".$model->version_number.",
				 },'json').success(
					function(data) 
					{ 
						if(data!='')
						{
							var response = jQuery.parseJSON(data);							
							$('#totals_price_w_discount').val(response.total_price_with_discount);					
							$('#totals_discount').val(response.total_discount);
							$('#totals_total_price').val(response.total_price);
						}
					}
				);		
		}
	$('#totals_percent_discount').keyup(function(){
		validateNumberInteger($('#totals_percent_discount'));
		if($('#totals_percent_discount').val()>100)	$('#totals_percent_discount').val(100);
	});							
	$('#totals_percent_discount').change(
						
		function(){
			$.post(
				'".PriceListController::createUrl('AjaxUpdatePercentDiscount')."',
				 {
				 	Id: ".$model->Id.",
					version_number:".$model->version_number.",
					percent_discount: $(this).val(),
				 },'json').success(
					 	function(data) 
					 		{ 
								if(data!='')
								{
									var response = jQuery.parseJSON(data);							
									$('#totals_price_w_discount').val(response.total_price_with_discount);					
									$('#totals_discount').val(response.total_discount);
									$('#totals_total_price').val(response.total_price);
								//	$(target).parent().parent().find('#saveok').animate({opacity: 'show'},4000,function(){ $(target).parent().parent().find('#saveok').animate({opacity: 'hide'},4000);});								
								}
							});
		
		}
		);
$('#budget-item-generic').find('input.txtQuantityGenericItem').each(
												function(index, item){
												
																$(item).keyup(function(){
			        												validateNumber($(this));
																});
																
																$(item).change(function(){
																	var target = $(this);
																	var price = $(this).parent().parent().find('input.txtPriceGenericItem').val();
																	
																	$.post(
																		'".PriceListController::createUrl('AjaxUpdateUpdateGenericItem')."',
																		 {
																		 	Id: $(this).attr('id'),
																			quantity:$(this).val(),
																			price: price
																		 },'json').success(
																			 	function(data) 
																			 		{ 
																						var response = jQuery.parseJSON(data);
																						$(target).parent().parent().find('input.txtTotalPriceGenericItem').val(response.total_price);
																						$(target).parent().parent().find('#saveok').animate({opacity: 'show'},4000,function(){ $(target).parent().parent().find('#saveok').animate({opacity: 'hide'},4000);});
																						setTotals(); 																						
																						
																					});
																		
																});
});	

$('#budget-item-generic').find('input.txtPriceGenericItem').each(
												function(index, item){
												
																$(item).keyup(function(){
			        												validateNumber($(this));
																});
																
																$(item).change(function(){
																	var target = $(this);
																	var quantity = $(this).parent().parent().find('input.txtQuantityGenericItem').val();
																	
																	$.post(
																		'".PriceListController::createUrl('AjaxUpdateUpdateGenericItem')."',
																		 {
																		 	Id: $(this).attr('id'),
																			quantity: quantity,
																			price: $(this).val()
																		 },'json').success(
																			 	function(data) 
																			 		{ 
																						var response = jQuery.parseJSON(data);
																						$(target).parent().parent().find('input.txtTotalPriceGenericItem').val(response.total_price);
																						$(target).parent().parent().find('#saveok').animate({opacity: 'show'},4000,function(){ $(target).parent().parent().find('#saveok').animate({opacity: 'hide'},4000);});
																						setTotals();
 																						
																						
																					});
																		
																});
});	
function updateGridViews()
{
		setTotals();
		$.fn.yiiGridView.update('budget-item-generic');
		$('div.grid-view').each(
		function(index){
			if($(this).attr('id').indexOf('budget-item-grid') != -1)
				$.fn.yiiGridView.update($(this).attr('id'));
		}
	)
}
		

$('.aareaTitle').click(function(){
	var idArea = $(this).attr('idArea');	
	
	if($( '#itemArea_' + idArea ).is(':visible')){
		$('#expandCollapse_' + idArea).text('+');
	}
	else{
		$('#expandCollapse_' + idArea).text('-');
	}
	$('#itemArea_' + idArea ).toggle('blind',{},1000);
	
});


function fillParentData(data)
{
	$('#IdItemBudgetParent').val(data.id);
	$('#parent_code').text(data.parent_code);
	$('#parent_model').text(data.parent_model);
	$('#parent_part_number').text(data.parent_part_number);
	$('#parent_customer_desc').text(data.parent_customer_desc);
	$('#parent_brand_desc').text(data.parent_brand_desc);
	$('#parent_supplier_name').text(data.parent_supplier_name);
	$('#parent_price').text(data.parent_price);
	if(data.parent_do_not_warning=='1')
	{
		$('#parent_do_not_warning').attr('checked', true);;
	}
	else
	{
		$('#parent_do_not_warning').attr('checked', false);
	}		
}
$('.ddl_id_service').change(
			function()
			{
				var idBudgetItem = $(this).attr('id');
				var idService = $(this).val();
				$.post(
						'".BudgetController::createUrl('AjaxSaveService')."',
						{
							Id_budget_item: idBudgetItem,Id_service:idService
						}
						).success(function(data)
						{
							//alert('success');				
					}).error(function(data)
						{
							//alert('error');				
					});	
			}
		);

$('.ddl_generic_discount_type').unbind('change');
$('.ddl_generic_discount_type').change(
			function()
			{
						var target = $(this);
						var idBudgetItem = $(this).attr('id');
						var discount_type = $(this).val();
						$.post(
						'".BudgetController::createUrl('AjaxSaveDiscountType')."',
						{
							Id_budget_item: idBudgetItem,discount_type:discount_type
						}
						).success(function(data)
						{
							var response = jQuery.parseJSON(data);
							$(target).parent().parent().find('input.txtTotalPriceGenericItem').val(response.total_price);
							$(target).parent().parent().find('#saveok').animate({opacity: 'show'},4000,function(){ $(target).parent().parent().find('#saveok').animate({opacity: 'hide'},4000);});
							setTotals();
								//alert('success');				
					}).error(function(data)
						{
							//alert('error');				
					});	
			}
		);
$('.ddl_discount_type').unbind('change');
$('.ddl_discount_type').change(
			function()
			{
						var target = $(this);
						var idBudgetItem = $(this).attr('id');
						var discount_type = $(this).val();
						$.post(
						'".BudgetController::createUrl('AjaxSaveDiscountType')."',
						{
							Id_budget_item: idBudgetItem,discount_type:discount_type
						}
						).success(function(data)
						{
							var response = jQuery.parseJSON(data);
							$(target).parent().parent().find('input.txtTotalPrice').val(response.total_price);
							setTotals();
								//alert('success');				
					}).error(function(data)
						{
							//alert('error');				
					});	
			}
		);
								
$('.txtDiscount').unbind('keyup');
$('.txtDiscount').keyup(function(){
	validateNumber($(this));
});
$('.txtGenericDiscount').unbind('keyup');
$('.txtGenericDiscount').keyup(function(){
	validateNumber($(this));
});
								
$('.txtDiscount').unbind('change');
$('.txtDiscount').change(
			function()
			{
						validateNumber($(this));
						var target = $(this);
						var idBudgetItem = $(this).attr('id');
						var discount = $(this).val();
						$.post(
						'".BudgetController::createUrl('AjaxSaveDiscountValue')."',
						{
							Id_budget_item: idBudgetItem,discount:discount
						}
						).success(function(data)
						{
							var response = jQuery.parseJSON(data);
							$(target).parent().parent().find('input.txtTotalPrice').val(response.total_price);
							setTotals();
								//alert('success');				
					}).error(function(data)
						{
							//alert('error');				
					});	
			}
		);
$('.txtGenericDiscount').unbind('change');
$('.txtGenericDiscount').change(
			function()
			{
						validateNumber($(this));
						var target = $(this);
						var idBudgetItem = $(this).attr('id');
						var discount = $(this).val();
						$.post(
						'".BudgetController::createUrl('AjaxSaveDiscountValue')."',
						{
							Id_budget_item: idBudgetItem,discount:discount
						}
						).success(function(data)
						{
							var response = jQuery.parseJSON(data);
							$(target).parent().parent().find('input.txtTotalPriceGenericItem').val(response.total_price);
							$(target).parent().parent().find('#saveok').animate({opacity: 'show'},4000,function(){ $(target).parent().parent().find('#saveok').animate({opacity: 'hide'},4000);});
							setTotals();
								//alert('success');				
					}).error(function(data)
						{
							//alert('error');				
					});	
			}
		);
								
$('.link-popup').click(function(){
	var idArea = $(this).attr('idArea');
	var idBudgetItem = $(this).attr('id');
	var idProduct = $(this).attr('idProduct');
	$('#ViewProductChild').attr('area',idArea);	
	$.post(
			'".BudgetController::createUrl('AjaxGetParentInfo')."',
			{
				IdBudgetItem: idBudgetItem
			},
			function(data)
			{
				fillParentData(data);				
		},'json');	
		
	$('#ViewProductChild').dialog('open');

	$.fn.yiiGridView.update('budget-item-children-grid', {
 		data: 'BudgetItem[Id_budget_item]=' + idBudgetItem
 	});
			
 	return false; 	
});

$('input:checkbox').live('click',function() {
	if($(this).attr('id')=='parent_do_not_warning')
	{
		$.post(
			'".BudgetController::createUrl('AjaxVerified')."',
			{
				IdBudgetItem: $('#IdItemBudgetParent').val(),
				isChecked:$(this).is(':checked')					
			});
	}
	else
	{
	var idProduct = $(this).attr('idProduct');
	var idBudgetItem = $(this).attr('idBudgetItem');
	var idBudgetItemParent = $(this).attr('idBudgetItemParent');
	
	if($(this).is(':checked'))
	{
		if(!$('#displayChildrenPrices').is(':visible'))
		{
			$('#displayChildrenPrices' ).toggle('blind',{},1000);
		}		
					
		selectSpecificRow('budget-item-children-grid', idBudgetItem);
	
		$.fn.yiiGridView.update('price-list-item-child-grid', {
				data: 'ProductSale[Id]=' + idProduct
			});			
	}
	else
	{
		if($('#displayChildrenPrices').is(':visible'))
		{
			$('#displayChildrenPrices' ).toggle('blind',{},1000);
		}		
					
		unselectRow('budget-item-children-grid');
		$.post(
			'".BudgetController::createUrl('AjaxQuitItem')."',
			{
				IdBudgetItem: idBudgetItem
			}).success(
				function(data) 
					{ 
				$.fn.yiiGridView.update('budget-item-children-grid', {
 					data: 'BudgetItem[Id_budget_item]=' + idBudgetItemParent
 				});
			});
	}
}
});

$('.btn-Assign-From-Stock').click(function(){
	if(!confirm('Are you sure you want to assign from stock?')) 
	{			
		return false;
	}
	var idProduct = $(this).attr('idProduct');
	var idBudgetItem = $(this).attr('idBudgetItem');
	var idArea = $(this).attr('idArea');
	$.post(
			'".BudgetController::createUrl('AjaxAssignFromStock')."',
			{
				IdProduct: idProduct,																 	
				IdBudgetItem: idBudgetItem
			}).success(
				function(data) 
				{ 
					updateGridViews();					
				});
});

$('.btn-View-Assign').click(function(){
	var idProduct = $(this).attr('idProduct');
	var idBudgetItem = $(this).attr('idBudgetItem');
	var idArea = $(this).attr('idArea');
	
	$('#ViewStockAssign').attr('area',idArea);	

	$.post(
			'".BudgetController::createUrl('AjaxViewAssign')."',
			{
				IdProduct: idProduct,																 	
				IdBudgetItem: idBudgetItem
			}).success(
				function(data) 
				{ 
					$('#popup-stock-assign-place-holder').html(data);
					$('.btn-un-assign-stock').click(function(){
						if(!confirm('Are you sure you want to un assign from stock?')) 
						{			
							return false;
						}
						
						var idProduct = $(this).attr('idProduct');
						var idBudgetItem = $(this).attr('idBudgetItem');	
						var idArea = $('#ViewStockAssign').attr('area');
						
						$.post(
								'".BudgetController::createUrl('AjaxUnAssignStock')."',
								{
									IdProduct: idProduct,																 	
									IdBudgetItem: idBudgetItem
								}).success(
									function(data) 
									{ 
										$('#ViewStockAssign').dialog('close');
										updateGridViews();
									});
						return false;
					});
					$('#ViewStockAssign').dialog('open');
				});
			
 	return false; 	
});


										

");

?>

<h1>Add product</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
			array('label'=>$model->getAttributeLabel('Id_project'),
			'type'=>'raw',
			'value'=>$model->project->description
		),
		'version_number',
		array('label'=>$model->getAttributeLabel('Id_budget_state'),
			'type'=>'raw',
			'value'=>$model->budgetState->description
		),
		'description',
		'percent_discount',
		'date_estimated_inicialization',
		'date_estimated_finalization',
	),
)); ?>

<br>

<div id="display">

<?php

echo CHtml::link('Servicios',
		'#',
		array(	
				
				'id'=>'services',
				'onclick'=>'
				$("#editServices").dialog( "open" );
				return false;
			'
		)
);
//Edit description
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
		'id'=>'editServices',
		// additional javascript options for the dialog plugin
		'options'=>array(
				'title'=>'Editar servicios',
				'autoOpen'=>false,
				'modal'=>true,
				'width'=> '550',
				'buttons'=>	array(
						'Close'=>'js:function()
									{
									jQuery("#editServices").dialog( "close" );

						}',
						),
		),
));
$modelProjectService = new ProjectService();
$modelProjectService->Id_project = $model->Id_project;
 
echo $this->renderPartial('_formServiceProject', array('model'=>$modelProjectService));
	
$this->endWidget('zii.widgets.jui.CJuiDialog');

echo '</br>';
echo '</br>';

	foreach($areaProjects as $item)
	{ 
	?>
		<div class="gridTitle-decoration1" style="display: inline-block; width: 98%;height: 35px;">
			<div class="gridTitle1" idArea="<?php echo $item->Id_area; ?>" style="display: inline-block;position: relative; width: 90%;vertical-align: top; margin-top: 4px;">
				<?php 
					echo CHtml::link('+ '.$item->area->description,
						'#',
						array(	'description'=>$item->area->description,
								'state'=>'+',
								'id'=>'expand-products',
								'onclick'=>'
									jQuery("#itemArea_'.$item->Id_area.'").toggle("blind",{},1000);
									jQuery("#expand-products'.$item->Id_area.'").toggle("blind",{},1000);
									if($(this).attr("state")=="+")
									{
										$(this).attr("state","-");
										$(this).html("- "+$(this).attr("description"));
									}
									else
									{
										if(jQuery("#expand-products'.$item->Id_area.'").html()=="- Products"){
											jQuery("#expand-products'.$item->Id_area.'").html("+ Products");
											jQuery("#selectProducts_'.$item->Id_area.'").toggle("blind",{},1000);
										}
										$(this).attr("state","+");
										$(this).html("+ "+$(this).attr("description"));
									}
									return false;
								'
								)
							);
							
							echo CHtml::link(" ( ".($item->description!=""?$item->description:"Editar")." ) ",
									'#',
									array(	'description'=>$item->description,
											'id'=>'edit-description-'.$item->Id,
											'onclick'=>'
							jQuery("#editAreaDescription'.$item->Id.'").dialog( "open" );
														return false;
													'
									)
							);

							//Edit description
							$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
									'id'=>'editAreaDescription'.$item->Id,
									// additional javascript options for the dialog plugin
									'options'=>array(
											'title'=>'Editar descripción',
											'autoOpen'=>false,
											'modal'=>true,
											'width'=> '550',
											'buttons'=>	array(
													'Grabar'=>'js:function()
														{
														jQuery("#waiting").dialog("open");
														jQuery.post("'.Yii::app()->createUrl("project/ajaxUpdateAreaDescription").'", $("#project-area-form-'.$item->Id.'").serialize(),
														function(data) {
															if(data!=null)
															{
																//actualizar
																jQuery("#editAreaDescription'.$item->Id.'").dialog( "close" );
																$("#edit-description-'.$item->Id.'").html(data.description);
															}
														jQuery("#waiting").dialog("close");
													},"json"
												);
							
											}',
													'Cancelar'=>'js:function(){jQuery("#editAreaDescription'.$item->Id.'").dialog( "close" );
																		}'),
									),
							));
							echo $this->renderPartial('_formAreaProject', array('model'=>$item));
							
							$this->endWidget('zii.widgets.jui.CJuiDialog');


				?>
				<div style="float: right;margin-right:400px">
				<?php 
					echo CHtml::link('+ Products',
						'#',
						array(	'description'=>$item->area->description,
								'state'=>'+',
								'style'=>'display:none',
								'id'=>'expand-products'.$item->Id_area,
								'onclick'=>'
									jQuery("#selectProducts_'.$item->Id_area.'").toggle("blind",{},1000);
									if($(this).html()=="+ Products")
									{
										$(this).html("- Products");
									}
									else
									{
										$(this).html("+ Products");
									}
									return false;
								'
								)
							)
				?></div>
					</div>
		</div>
		<br>&nbsp;
		<div id="itemArea_<?php echo $item->Id_area; ?>" style="display: none">
		<?php		
		$modelBudgetItem->Id_area = $item->Id_area;		
		$modelProduct->product_area_id = $item->Id_area;
		
		echo $this->renderPartial('_selectItem', array('model'=>$model,
													   'idArea'=>$item->Id_area,
													   'modelProduct'=>$modelProduct,
													   'priceListItemSale'=>$priceListItemSale,
													   'modelBudgetItem'=>$modelBudgetItem));
		?>		
		</div><!-- close itemArea -->
<?php				
	}
?>
	<br>
	 <div style="display: inline-block; float: left;margin-right:20px;">
			<?php echo CHtml::link( 'Nuevo Item','#',array('onclick'=>'jQuery("#CreateNewBudgetItem").dialog("open"); return false;'));?>
	</div>
<?php
	$this->widget('zii.widgets.grid.CGridView', array(
					'id'=>'budget-item-generic',
					'dataProvider'=>$modelBudgetItemGeneric->searchGenericItem(),
					'summaryText'=>'',
					'afterAjaxUpdate'=>'function(id, data){
									$("#budget-item-generic").find(".txtGenericDiscount").each(
										function(index, item)
										{
											$(item).unbind("change");
											$(item).change(
												function()
												{
															validateNumber($(this));
															var target = $(this);
															var idBudgetItem = $(this).attr("id");
															var discount = $(this).val();
															$.post(
															"'.BudgetController::createUrl("AjaxSaveDiscountValue").'",
															{
																Id_budget_item: idBudgetItem,discount:discount
															}
															).success(function(data)
															{
																var response = jQuery.parseJSON(data);
																$(target).parent().parent().find("input.txtTotalPriceGenericItem").val(response.total_price);
																setTotals();
													}).error(function(data)
															{
														});	
												}
											);
										}
							
									);

									$("#budget-item-generic").find(".ddl_generic_discount_type").each(
										function(index, item)
										{
											$(item).unbind("change");
											$(item).change(
												function()
												{
													var target = $(this);
													var idBudgetItem = $(this).attr("id");
													var discount_type = $(this).val();
													$.post(
															"'.BudgetController::createUrl('AjaxSaveDiscountType').'",
															{
																Id_budget_item: idBudgetItem,discount_type:discount_type
															}
															).success(function(data)
															{
																var response = jQuery.parseJSON(data);
																$(target).parent().parent().find("input.txtTotalPriceGenericItem").val(response.total_price);
																setTotals();
																//alert("success");				
														}).error(function(data)
															{
																//alert("error");				
														},"json");	
												}
											);
										}
							
									);

									$("#budget-item-generic").find("input.txtQuantityGenericItem").each(
												function(index, item){
												
																$(item).keyup(function(){
			        												validateNumber($(this));
																});
																
																$(item).change(function(){
																	var target = $(this);
																	var price = $(this).parent().parent().find("input.txtPriceGenericItem").val();
																	$.post(
																		"'.PriceListController::createUrl('AjaxUpdateUpdateGenericItem').'",
																		 {
																		 	Id: $(this).attr("id"),
																			quantity:$(this).val(),
																			price: price
																		 },"json").success(
																			 	function(data) 
																			 		{ 
																						var response = jQuery.parseJSON(data);
																						$(target).parent().parent().find("#saveok").animate({opacity: "show"},4000,function(){ $(target).parent().parent().find("#saveok").animate({opacity: "hide"},4000);});
																						$(target).parent().parent().find("input.txtTotalPriceGenericItem").val(response.total_price);
																						setTotals();																						
																					});
																		
																});
													});
									$("#budget-item-generic").find("input.txtPriceGenericItem").each(
												function(index, item){
												
																$(item).keyup(function(){
			        												validateNumber($(this));
																});
																
																$(item).change(function(){
																	var target = $(this);
																	var quantity = $(this).parent().parent().find("input.txtQuantityGenericItem").val();
																	
																	$.post(
																		"'.PriceListController::createUrl('AjaxUpdateUpdateGenericItem').'",
																		 {
																		 	Id: $(this).attr("id"),
																			quantity: quantity,
																			price: $(this).val()
																		 },"json").success(
																			 	function(data) 
																			 		{
																						var response = jQuery.parseJSON(data);
																						$(target).parent().parent().find("#saveok").animate({opacity: "show"},4000,function(){ $(target).parent().parent().find("#saveok").animate({opacity: "hide"},4000);});
																						$(target).parent().parent().find("input.txtTotalPriceGenericItem").val(response.total_price);
																						setTotals();
																						
																					});
																		
																});
													});		
										
					}',
					'columns'=>array(
							'description',
							array(
								'name'=>'quantity',
								'value'=>
			                                    	'CHtml::textField("txtQuantityGenericItem",
															$data->quantity,
															array(
																	"id"=>$data->Id,
																	"class"=>"txtQuantityGenericItem",
																	"style"=>"width:50px;text-align:right;",
																)
														)',
			
								'type'=>'raw',
								'htmlOptions'=>array("style"=>"text-align:right;"),
							),
							array(
									'name'=>'price',
									'value'=>
				                                    	'CHtml::textField("txtPriceGenericItem",
																$data->price,
																array(
																		"id"=>$data->Id,
																		"class"=>"txtPriceGenericItem",
																		"style"=>"width:50px;text-align:right;",
																	)
															)',
		
									'type'=>'raw',
									'htmlOptions'=>array("style"=>"text-align:right;"),
							),
							array(
									'name'=>'discount',
									'value'=>
									'CHtml::textField("txtDiscount",
																				$data->discount,
																				array(
																						"id"=>$data->Id,
																						"class"=>"txtGenericDiscount",
																						"disabled"=>"",
																						"style"=>"width:50px;text-align:right;",
																					)
																			)',
							
									'type'=>'raw',
							
									'htmlOptions'=>array('width'=>5),
							),
							
							array(
									'name'=>'discount_type',
									'value'=>(true)?'
														CHtml::dropDownList("discount_type", $data->discount_type,array("%","$"),array(
														"id"=>$data->Id,"class"=>"ddl_generic_discount_type","style"=>"width:50px"
														) );':'($data->discount_type==0)?"%":"$";',
									'type'=>(true)?'raw':'html',
									'htmlOptions'=>array('style'=>"width:20px"),
							),

							array(									
									'name'=>'total_price',
									'value'=>
				                                    	'CHtml::textField("txtTotalPriceGenericItem",
																$data->totalPrice,
																array(
																		"id"=>$data->Id,
																		"class"=>"txtTotalPriceGenericItem",
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
									'class'=>'CButtonColumn',
									'template'=>'{delete}',
									'deleteConfirmation'=>"js:'Are you sure you want to delete this item?'",
									'buttons'=>array
									(
									        'delete' => array
												(
									            	'url'=>'Yii::app()->createUrl("budget/AjaxDeleteBudgetItem", array("id"=>$data->Id))',
												),
											),
									),
							),
					));



$this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'attributes'=>array(
				array('label'=>$model->getAttributeLabel('subTotalPrice'),
						'type'=>'raw',
						'htmlOptions'=>array('style' => 'text-align: right;'),
						'value'=>
						CHtml::textField("totalPrice",
								$model->totalPrice,
								array(
										'id'=>"totals_total_price",
										"disabled"=>"disabled",
										"style"=>"width:60px;float:right;text-align:right;",
								)
						),
				),

				array('label'=>$model->getAttributeLabel('percent_discount'),
						'type'=>'raw',
						'htmlOptions'=>array('style' => 'text-align: right;'),
						'value'=>
						CHtml::textField("percen_discount",
								$model->percent_discount,
								array(
										'id'=>"totals_percent_discount",
										"style"=>"width:30px;display:inline-block;text-align:right;",
								)
						)." %".
						CHtml::textField("TotalDiscount",
								$model->TotalDiscount,
								array(
										'id'=>"totals_discount",
										"disabled"=>"disabled",
										"style"=>"width:60px;float:right;text-align:right;display:inline-block;",
								)
						),
				),
				array('label'=>$model->getAttributeLabel('totalPrice'),
						'type'=>'raw',
						'htmlOptions'=>array('style' => 'text-align: right;'),
						'value'=>
						CHtml::textField("TotalPriceWithDiscount",
								$model->TotalPriceWithDiscount,
								array(
										'id'=>"totals_price_w_discount",
										"disabled"=>"disabled",
										"style"=>"width:60px;float:right;text-align:right;",
								)
						),
				),
		),
));

	?>
</div>

<?php				
//Project create
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
			'id'=>'CreateNewBudgetItem',
// additional javascript options for the dialog plugin
			'options'=>array(
					'title'=>'Nuevo Item',
					'autoOpen'=>false,
					'modal'=>true,
					'width'=> '550',
					'buttons'=>	array(							
							'Grabar'=>'js:function()
							{
							jQuery("#waiting").dialog("open");
							jQuery.post("'.Yii::app()->createUrl("budget/ajaxCreateBudgetItem").'", $("#budget-item-form").serialize(),
							function(data) {
								if(data!=null)
								{
									//actualizar
									setTotals();
									$.fn.yiiGridView.update("budget-item-generic");
									jQuery("#CreateNewBudgetItem").dialog( "close" );
									$("#BudgetItem_description").val("");
									$("#BudgetItem_quantity").val(1);
									$("#BudgetItem_price").val(0);
								}
							jQuery("#waiting").dialog("close");
						},"json"
					);

				}',
				'Cancelar'=>'js:function(){jQuery("#CreateNewBudgetItem").dialog( "close" );
											$("#BudgetItem_description").val("");
											$("#BudgetItem_quantity").val(1);
											$("#BudgetItem_price").val(0);
											}'),
),
));
$modelNewBudgetItem = new BudgetItem();
$modelNewBudgetItem->Id_budget = $model->Id;
$modelNewBudgetItem->version_number = $model->version_number;
$modelNewBudgetItem->price = 0;
$modelNewBudgetItem->quantity = 1;
echo $this->renderPartial('_formBudgetItem', array('model'=>$modelNewBudgetItem));

$this->endWidget('zii.widgets.jui.CJuiDialog');


//Product View Child
	$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
				'id'=>'ViewProductChild',
	// additional javascript options for the dialog plugin
				'options'=>array(
						'title'=>'Children Product',
						'autoOpen'=>false,
						'modal'=>true,
						'width'=> '700',
						'buttons'=>	array(
								'cerrar'=>'js:function(){
									jQuery("#ViewProductChild").dialog( "close" );
									updateGridViews();
									//$.fn.yiiGridView.update("budget-item-grid_" + $("#ViewProductChild").attr("area"));
									}',
	),
	),
	));
	echo CHtml::openTag('div',array('id'=>'popup-child-view-place-holder','style'=>'position:relative;display:inline-block;width:97%'));
	
	$modelBudgetItem = new BudgetItem('search');
	$modelBudgetItem->unsetAttributes();  // clear any default values
	
	$priceListItemSale = new PriceListItem();
	$priceListItemSale->unsetAttributes();
	
	
	echo $this->renderPartial('_budgetItemChildren', array(	'modelBudgetItem'=>$modelBudgetItem,
																		   'priceListItemSale'=>$priceListItemSale,
	));
	
	echo CHtml::closeTag('div');
	
	$this->endWidget('zii.widgets.jui.CJuiDialog');

//View Stock Assign
	$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
					'id'=>'ViewStockAssign',
	// additional javascript options for the dialog plugin
					'options'=>array(
							'title'=>'Assign',
							'autoOpen'=>false,
							'modal'=>true,
							'width'=> '700',
							'buttons'=>	array(
									'cerrar'=>'js:function(){jQuery("#ViewStockAssign").dialog( "close" );
															//$.fn.yiiGridView.update("budget-item-grid_" + $("#ViewStockAssign").attr("area"));
															}',
	),
	),
	));
	echo CHtml::openTag('div',array('id'=>'popup-stock-assign-place-holder','style'=>'position:relative;display:inline-block;width:97%'));	
	echo CHtml::closeTag('div');
	
	$this->endWidget('zii.widgets.jui.CJuiDialog');
?>