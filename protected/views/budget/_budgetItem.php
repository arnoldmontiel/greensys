
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
 		}',
	'columns'=>array(
				array(
					'name'=>'product_code',
				    'value'=>'$data->product->code',				 
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
				    'value'=>'$data->totalPrice',
					'type'=>'raw',
			        'htmlOptions'=>array('style'=>'text-align: right;'),
				),
				array(
					'class'=>'CButtonColumn',
					'template'=>($canEdit)?'{delete}':'',
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