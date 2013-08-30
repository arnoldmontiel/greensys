
<div id="display">

<?php 
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'budget-item-grid_'.$idArea,
	'dataProvider'=>$modelBudgetItem->search(),
 	'filter'=>$modelBudgetItem,
	'summaryText'=>'',
	'afterAjaxUpdate'=>'function(id, data){
 				$("#budget-item-grid_'.$idArea.'").find(".link-popup").each(
												function(index, item){
													$(item).click(function(){
															
														var idArea = $(this).attr("idArea");
														var idBudgetItem = $(this).attr("id");
														var idProduct = $(this).attr("idProduct");
														$("#ViewProductChild").attr("area",idArea);	
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
				$("#budget-item-grid_'.$idArea.'").find(".btn-Assign-From-Stock").each(
												function(index, item){
												
													$(item).click(function(){
														if(!confirm("Are you sure you want to assign from stock?")) 
														{			
															return false;
														}	
														var idProduct = $(this).attr("idProduct");
														var idBudgetItem = $(this).attr("idBudgetItem");
														var idArea = $(this).attr("idArea");
	
														$.post(
														"'.BudgetController::createUrl('AjaxAssignFromStock').'",
														{
															IdProduct: idProduct,																 	
															IdBudgetItem: idBudgetItem
														}).success(
															function(data) 
															{ 
																updateGridViews();
																//$.fn.yiiGridView.update("budget-item-grid_" + idArea);
																
															}); 	
														
													});
												}
										);
				$("#budget-item-grid_'.$idArea.'").find(".btn-View-Assign").each(
												function(index, item){
												
													$(item).click(function(){
														var idProduct = $(this).attr("idProduct");
														var idBudgetItem = $(this).attr("idBudgetItem");
														var idArea = $(this).attr("idArea");
														
														$("#ViewStockAssign").attr("area",idArea);	
													
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
																			var idArea = $("#ViewStockAssign").attr("area");
																			
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
					'value'=>'CHtml::link(($data->childrenCount > 0)?$data->childrenCount:"","#",array("id"=>$data->Id, "idArea"=>$data->Id_area, "idProduct"=>$data->Id_product, "class"=>"link-popup"))',
					'type'=>'raw'
				),
				array(
					'name'=>'children_included',
					'value'=>'($data->childrenCount > 0)?$data->childrenIncluded:""',
					'type'=>'raw'
				),
				array(
					
				    'value'=>($canEdit)?'$data->hasStockAssigned?
				    		 CHtml::button("View Stock Assign",
				    					array("class"=>"btn-View-Assign",
				    							"idBudgetItem"=>$data->Id,
				    							"idProduct"=>$data->Id_product,
				    							"idArea"=>$data->Id_area,))
				    		: 
				    		 CHtml::button(($data->product->stockCount)>0?"Assign from stock":"No Stock",
				    					array("class"=>"btn-Assign-From-Stock",
				    							"idBudgetItem"=>$data->Id,
				    							"idProduct"=>$data->Id_product,
				    							"idArea"=>$data->Id_area,
				    							"disabled"=>($data->product->stockCount > 0)?"":"disabled", ))'
				    		:'
							$data->hasStockAssigned?
							CHtml::button("View Stock Assign",
							array("class"=>"btn-View-Assign",
				    							"idBudgetItem"=>$data->Id,
				    							"idProduct"=>$data->Id_product,
				    							"idArea"=>$data->Id_area,))
							:
							CHtml::button(($data->product->stockCount)>0?"Assign from stock":"No Stock",
							array("class"=>"btn-Assign-From-Stock",
				    							"idBudgetItem"=>$data->Id,
				    							"idProduct"=>$data->Id_product,
				    							"idArea"=>$data->Id_area,
				    							"disabled"=>"disabled", ))'
				    		,
					'type'=>'raw'				 
				),
				array(
 					'name'=>'price',
				    'value'=>'$data->totalPrice',
					'type'=>'raw',
			        'htmlOptions'=>array('style'=>'text-align: right;'),
				),
				array(
						'value'=>
							'CHtml::image("images/grid_warning.png","",
								array("title"=>"Pending check products",
									"style"=>!$data->DoNotWarning?"display":"display:none",
									"id"=>$data->Id, "idArea"=>$data->Id_area, "idProduct"=>$data->Id_product, "class"=>"link-popup"
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