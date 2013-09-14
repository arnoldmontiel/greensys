
<div id="display">

<?php
$settings = new Settings();

$criteria = new CDbCriteria;
$criteria->order ="description";
$serviceList = CHtml::listData(Service::model()->findAll($criteria), 'Id', 'description');

$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'budget-item-grid_'.$idService,
	'dataProvider'=>$modelBudgetItem->search(),
 	'filter'=>$modelBudgetItem,
	'summaryText'=>'',
	'afterAjaxUpdate'=>'function(id, data){
				setTotals();	
				$.fn.yiiGridView.update("budget-item-generic");		
		
				$("#budget-item-grid_'.$idService.'").find(".txtDiscount").each(
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
											$(target).parent().parent().find("input.txtTotalPrice").val(response.total_price);
											setTotals();
								}).error(function(data)
										{
									});	
							}
						);
					}
		
				);
		
		
		
				$("#budget-item-grid_'.$idService.'").find(".ddl_discount_type").each(
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
											$(target).parent().parent().find("input.txtTotalPrice").val(response.total_price);
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
		
			$("#budget-item-grid_'.$idService.'").find(".ddl_id_service").each(
					function(index, item)
					{
						$(item).unbind("change");
						$(item).change(
							function()
							{
								var idBudgetItem = $(this).attr("id");
								var idService = $(this).val();
								$.post(
										"'.BudgetController::createUrl('AjaxSaveService').'",
										{
											Id_budget_item: idBudgetItem,Id_service:idService
										}
										).success(function(data)
										{
											//alert("success");				
									}).error(function(data)
										{
											//alert("error");				
									});	
							}
						);
					}
		
				);
		
 				$("#budget-item-grid_'.$idService.'").find(".link-popup").each(
												function(index, item){
													$(item).unbind("click");		
													$(item).click(function(){
															
														var idService = $(this).attr("idService");
														var idBudgetItem = $(this).attr("id");
														var idProduct = $(this).attr("idProduct");
														$("#ViewProductChild").attr("service",idService);	
														$.post(
																"'.BudgetController::createUrl('AjaxGetParentInfo').'",
																{
																	IdBudgetItem: idBudgetItem
																},
																function(data)
																{
																	fillParentData(data);				
															},"json");	
															
														$("#ViewProductChild").dialog("open");
														
														$.fn.yiiGridView.update("budget-item-children-grid", {
													 		data: "BudgetItem[Id_budget_item]=" + idBudgetItem
													 	});
																
													 	return false; 	
														
													});
												}
										);
				$("#budget-item-grid_'.$idService.'").find(".btn-Assign-From-Stock").each(
												function(index, item){
												
													$(item).unbind("click");		
													$(item).click(function(){
														if(!confirm("Are you sure you want to assign from stock?")) 
														{			
															return false;
														}	
														var idProduct = $(this).attr("idProduct");
														var idBudgetItem = $(this).attr("idBudgetItem");
														var idService = $(this).attr("idService");
	
														$.post(
														"'.BudgetController::createUrl('AjaxAssignFromStock').'",
														{
															IdProduct: idProduct,																 	
															IdBudgetItem: idBudgetItem
														}).success(
															function(data) 
															{ 
																updateGridViews();
																//$.fn.yiiGridView.update("budget-item-grid_" + idService);
																
															}); 	
														
													});
												}
										);
				$("#budget-item-grid_'.$idService.'").find(".btn-View-Assign").each(
												function(index, item){
												
														$(item).unbind("click");		
														$(item).click(function(){
														var idProduct = $(this).attr("idProduct");
														var idBudgetItem = $(this).attr("idBudgetItem");
														var idService = $(this).attr("idService");
														
														$("#ViewStockAssign").attr("service",idService);	
													
														$.post(
																"'.BudgetController::createUrl('AjaxViewAssign').'",
																{
																	IdProduct: idProduct,																 	
																	IdBudgetItem: idBudgetItem
																}).success(
																	function(data) 
																	{ 
																		$("#popup-stock-assign-place-holder").html(data);
																		
																		$(".btn-un-assign-stock").click(function(){
																			if(!confirm("Are you sure you want to un assign from stock?")) 
																			{			
																				return false;
																			}
																			
																			var idProduct = $(this).attr("idProduct");
																			var idBudgetItem = $(this).attr("idBudgetItem");	
																			var idService = $("#ViewStockAssign").attr("service");
																			
																			$.post(
																					"'.BudgetController::createUrl('AjaxUnAssignStock').'",
																					{
																						IdProduct: idProduct,																 	
																						IdBudgetItem: idBudgetItem
																					}).success(
																						function(data) 
																						{ 
																							$("#ViewStockAssign").dialog("close");
																							updateGridViews();
																						});
																			return false;
																		});
					
																		$("#ViewStockAssign").dialog("open");
																		
																	});
														
													});
												}
										);
 		}',
	'columns'=>array(
				array(
					'name'=>'product_model',
				    'value'=>'$data->product->model',				 
				),			
				array(
						'name'=>'product_part_number',
						'value'=>'$data->product->part_number',
				),
				array(
					'name'=>'product_code',
				    'value'=>'$data->product->code',				 
				),
				array(
 					'name'=>'product_brand_desc',
				    'value'=>'$data->product->brand->description',
	
				),
				array(
					'name'=>'children_count',
					'value'=>'CHtml::link(($data->childrenCount > 0)?$data->childrenCount:"","#",array("id"=>$data->Id, "idService"=>$data->Id_service, "idProduct"=>$data->Id_product, "class"=>"link-popup"))',
					'type'=>'raw',
				),
				array(
					'name'=>'children_included',
					'value'=>'($data->childrenCount > 0)?$data->childrenIncluded:""',
					'type'=>'html',
				),
				array(
					
				    'value'=>($canEdit)?'$data->hasStockAssigned?
				    		 CHtml::button("View Stock Assign",
				    					array("class"=>"btn-View-Assign",
				    							"idBudgetItem"=>$data->Id,
				    							"idProduct"=>$data->Id_product,
				    							"idService"=>$data->Id_service,))
				    		: 
				    		 CHtml::button(($data->product->stockCount)>0?"Assign from stock":"No Stock",
				    					array("class"=>"btn-Assign-From-Stock",
				    							"idBudgetItem"=>$data->Id,
				    							"idProduct"=>$data->Id_product,
				    							"idService"=>$data->Id_service,
				    							"disabled"=>($data->product->stockCount > 0)?"":"disabled", ))'
				    		:'
							$data->hasStockAssigned?
							CHtml::button("View Stock Assign",
							array("class"=>"btn-View-Assign",
				    							"idBudgetItem"=>$data->Id,
				    							"idProduct"=>$data->Id_product,
				    							"idService"=>$data->Id_service,))
							:
							CHtml::button(($data->product->stockCount)>0?"Assign from stock":"No Stock",
							array("class"=>"btn-Assign-From-Stock",
				    							"idBudgetItem"=>$data->Id,
				    							"idProduct"=>$data->Id_product,
				    							"idService"=>$data->Id_service,
				    							"disabled"=>"disabled", ))'
				    		,
					'type'=>'raw'				 
				),
				array(
 					'name'=>'price',
				    'value'=>'"'.$settings->getEscapedCurrencyShortDescription().' ".$data->price',
					'type'=>'raw',
			        'htmlOptions'=>array('style'=>'text-align: right;width:90px;'),
				),
				array(
						'name'=>'discount',
						'value'=>
						'CHtml::textField("txtDiscount",
													(($data->discount_type==0)?"% ":"'.$settings->getEscapedCurrencyShortDescription().' ").$data->discount,
													array(
															"id"=>$data->Id,
															"class"=>"txtDiscount",
															"disabled"=>'.(($canEdit)?'""':'"disabled"').',
															"style"=>"width:90px;text-align:right;",
														)
												)',
				
						'type'=>'raw',
				
						'htmlOptions'=>array('width'=>5),
				),
				
					($canEdit)?array(
							'name'=>'discount_type',
							'value'=>($canEdit)?'
								CHtml::dropDownList("discount_type", $data->discount_type,array("%","'.$settings->getEscapedCurrencyShortDescription().'"),array(
								"id"=>$data->Id,"class"=>"ddl_discount_type","style"=>"width:50px"
								) );':'($data->discount_type==0)?"%":"$";',
							'type'=>($canEdit)?'raw':'html',
							'htmlOptions'=>array('style'=>"width:20px"),
					):array('visible'=>false)
				,
				array(
						'name'=>'total_price',
						'value'=>
						'CHtml::textField("txtTotalPrice",
														"'.$settings->getEscapedCurrencyShortDescription().' ".$data->totalPrice,
														array(
																"id"=>$data->Id,
																"class"=>"txtTotalPrice",
																"disabled"=>"disbled",
																"style"=>"width:90px;text-align:right;",
															)
													)',
				
						'type'=>'raw',
				
						'htmlOptions'=>array('width'=>5),
				),
				array(
						'value'=>
							'CHtml::image("images/grid_warning.png","",
								array("title"=>"Pending check products",
									"style"=>!$data->DoNotWarning?"display":"display:none",
									"id"=>$data->Id, "idService"=>$data->Id_service, "idProduct"=>$data->Id_product, "class"=>"link-popup"
								)
							)',
						'type'=>'raw',
						'htmlOptions'=>array('width'=>25),
				),
				
				array(
					'visible'=>($canEdit)?true:false,
					'class'=>'CButtonColumn',
					'template'=>($canEdit)?'{delete}':'',
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
)); ?>
</div>