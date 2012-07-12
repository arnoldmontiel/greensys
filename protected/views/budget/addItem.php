<?php
$this->breadcrumbs=array(
	'Stocks'=>array('index'),
	$model->project->description,
);

$this->menu=array(
	array('label'=>'List Stock', 'url'=>array('index')),
	array('label'=>'Create Stock', 'url'=>array('create')),
	array('label'=>'Update Stock', 'url'=>array('update', 'id'=>$model->Id)),
	array('label'=>'Delete Stock', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->Id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Stock', 'url'=>array('admin')),
);
Yii::app()->clientScript->registerScript(__CLASS__.'add-item-budget', "

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
	 
<div class="gridTitle-decoration1" style="display: inline-block; width: 98%;height: 35px;">
	<div class="gridTitle1" style="display: inline-block;position: relative; width: 90%;vertical-align: top; margin-top: 4px;">
		Select Products
	</div>
</div>
<?php		
	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'product-grid',
		'dataProvider'=>$modelProduct->searchSummary(),
		'filter'=>$modelProduct,
		'summaryText'=>'',	
		'selectionChanged'=>'js:function(){
		
			$.fn.yiiGridView.update("price-list-item-grid", {
				data: "ProductSale[Id]="+$.fn.yiiGridView.getSelection("product-grid")
			});
			
			var idProduct = $.fn.yiiGridView.getSelection("product-grid");
			if(idProduct!="")
			{
				$( "#displayPrices" ).animate({opacity: "show"},"slow");
			}
			else
			{
				$( "#displayPrices" ).animate({opacity: "hide"},"slow");
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

<div id="displayPrices" style="display: none">
<?php
 $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'price-list-item-grid',
	'dataProvider'=>$priceListItemSale->searchForBudget(),
	'filter'=>$priceListItemSale,
 	'afterAjaxUpdate'=>'function(id, data){
 				$("#price-list-item-grid").find(":radio").each(
												function(index, item){
													$(item).change(function(){
															
														if(!confirm("Are you sure you want to select this price?")) 
														{
															$.fn.yiiGridView.update("price-list-item-grid");
															return false;
														}
														$.post(
															"'.BudgetController::createUrl('AjaxAddBudgetItem').'",
															{
																	IdBudget: "'.$model->Id.'",
																 	IdPriceList: $(this).attr("idPriceList"),
																 	IdProduct: $(this).attr("idProduct"),
																 	IdShippingType: $(this).attr("idShippingType")
															}).success(
																function(data) 
																{ 
																	$.fn.yiiGridView.update("budget-item-grid", {
																		data: $(this).serialize()
																	});
																	$.fn.yiiGridView.update("price-list-item-grid");
																});
														
													});
												}
										);
 		}',
	'columns'=>array(
		array(
 			'name'=>'Id_product',
			'value'=>'$data->priceList->importer->contact->description',
		),
		'msrp',
		'maritime_cost',
		array(
 			'type'=>'raw',
 			'value'=>'CHtml::radioButton("rbtPrice","",array("idPriceList"=>$data->Id_price_list,"idProduct"=>$data->Id_product,"idShippingType"=>1))',
		),
		'air_cost',
		 array(
	  			'type'=>'raw',
	  			'value'=>'CHtml::radioButton("rbtPrice","",array("idPriceList"=>$data->Id_price_list,"idProduct"=>$data->Id_product,"idShippingType"=>2))',
		 ),
	),
)); ?>
</div>

	<p class="messageError"><?php
		echo Yii::app()->lc->t('Product has already been added');
		?></p>

	<div class="gridTitle-decoration1" style="display: inline-block; width: 98%;height: 35px;">
		<div class="gridTitle1" style="display: inline-block;position: relative; width: 90%;vertical-align: top; margin-top: 4px;">
			Items
		</div>
	</div>
			<?php 

$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'budget-item-grid',
	'dataProvider'=>$modelBudgetItem->search(),
 	'filter'=>$modelBudgetItem,
	'summaryText'=>'',
 	'afterAjaxUpdate'=>'function(id, data){
 										$("#stock-item-grid").find("input.txtQuantity").each(
												function(index, item){
		
																$(item).keyup(function(){
			        												validateNumber($(this));
																});
												
																$(item).change(function(){
																	
																	var target = $(this);
																	
																	$.post(
																		"'.BudgetController::createUrl('AjaxUpdateQuantity').'",
																		 {
																		 	idStockItem: $(this).attr("id"),
																			quantity:$(this).val()
																		 }).success(
																			 	function() 
																			 		{ 
																			 			$(target).parent().parent().find("#saveok").animate({opacity: "show"},4000);
																						$(target).parent().parent().find("#saveok").animate({opacity: "hide"},4000);
																					});
																		
																});
													});	
 									}',	
	'columns'=>array(
				array(
					'name'=>'product_code',
				    'value'=>'$data->product->code',
				 
				),
				array(
					'name'=>'product_code_supplier',
				    'value'=>'$data->product->code_supplier',
	
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
				'price',
				array(
					'class'=>'CButtonColumn',
					'template'=>'{delete}',
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