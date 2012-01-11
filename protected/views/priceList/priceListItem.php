<?php
$this->breadcrumbs=array(
	'Price List'=>array('index'),
	'Assign Product',
);

$this->menu=array(
	array('label'=>'List PriceList', 'url'=>array('index')),
	array('label'=>'Create PriceList', 'url'=>array('create')),
);

$this->showSideBar = true;

Yii::app()->clientScript->registerScript('priceListItem', "
$('#PriceList_Id').change(function(){
	
	if($(this).val()!= ''){
		$.fn.yiiGridView.update('price-list-item-grid', {
			data: $(this).serialize()
		});
		$.fn.yiiGridView.update('product-grid', {
			data: $(this).serialize()
		});
		$('#display').animate({opacity: 'show'},240);
		$.post('".PriceListController::createUrl('AjaxFillSidebar')."',
					$(this).serialize()
				).success(
					function(data) 
					{
						$('#sidebar').html(data);
						$( '#sidebar' ).show();	
					}
				);
	}
	else{
		$('#display').animate({opacity: 'hide'},240);
		$( '#sidebar' ).hide();	

	}
	return false;
}
);
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

");
?>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'priceList-form',
		'enableAjaxValidation'=>true,
));
		
		$model= PriceList::model();
		$priceListDB= PriceList::model()->findAll();
		?>
	
	<div id="priceList" style="margin-bottom: 5px">
		
		<?php	$priceLists = CHtml::listData($priceListDB, 'Id', 'PriceListDesc');?>

		<?php echo $form->labelEx($model,'Price List'); ?>

		<?php echo $form->dropDownList($model, 'Id', $priceLists,		
			array(
				'prompt'=>'Select a Price List'
			)		
		);
		?>
	</div>
		
	<div id="display"
	 style="display: none">

	<div class="gridTitle-decoration1" style="display: inline-block; width: 98%;height: 35px;">
		<div class="gridTitle1" style="display: inline-block;position: relative; width: 90%;vertical-align: top; margin-top: 4px;">
			Products
		</div>
		<div style="display: inline-block;position: relative; width: 20px;height:20px; vertical-align: middle;">
		<?php
		echo CHtml::imageButton(
                                'images/add_all_blue.png',
                                array(
                                'title'=>'Add current filtered products',
                                'style'=>'width:30px;',
                                'id'=>'addAll',
                                	'ajax'=> array(
										'type'=>'POST',
										'url'=>PriceListController::createUrl('AjaxAddFilteredProducts'),
										'beforeSend'=>'function(){
													if(!confirm("Are you sure you want to add all filtered products?")) 
														return false;
														}',
										'success'=>'js:function(data)
										{
											$.fn.yiiGridView.update("price-list-item-grid", {
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
		'id'=>'product-grid',
		'dataProvider'=>$modelProduct->searchSummary(),
		'filter'=>$modelProduct,
		'summaryText'=>'',	
		'selectionChanged'=>'js:function(id){
			$.get(	"'.PriceListController::createUrl('AjaxAddPriceListItem').'",
					{
						IdPriceList:$("#PriceList_Id :selected").attr("value"),
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
						function()
						{
							$(".messageError").animate({opacity: "show"},2000);
							$(".messageError").animate({opacity: "hide"},2000);
						});
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
                                'id'=>'deleteAll',
                                	'ajax'=> array(
										'type'=>'POST',
										'url'=>PriceListController::createUrl('AjaxDeleteFilteredProducts'),
										'beforeSend'=>'function(){
													if(!confirm("Are you sure you want to delete all filtered products?")) 
														return false;
														}',
										'success'=>'js:function(data)
										{
											$.fn.yiiGridView.update("price-list-item-grid", {
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
	'id'=>'price-list-item-grid',
	'dataProvider'=>$dataProvider->searchPriceList(),
 	'filter'=>$dataProvider,
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
																	
																	if($(this).parent().parent().find("input.txtMsrp").val() > 0){
																		profitRate = ($(this).val() / $(this).parent().parent().find("input.txtMsrp").val()).toFixed(2);
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
										$("#price-list-item-grid").find("input.txtProfitRate").each(
												function(index, item){
		
																$(item).keyup(function(){
			        												validateNumber($(this));
																});
												
																$(item).change(function(){
																	var target = $(this);
																	$.post(
																		"'.PriceListController::createUrl('AjaxUpdateProfitRate').'",
																		 {
																		 	idPriceListItem: $(this).attr("id"),
																			profitRate:$(this).val()
																		 }).success(
																			 	function() 
																			 		{ 
																			 			$(target).parent().parent().find("#saveok3").animate({opacity: "show"},4000);
																						$(target).parent().parent().find("#saveok3").animate({opacity: "hide"},4000); 
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
 				            'name'=>'code_supplier',
				            'value'=>'$data->product->code_supplier',
 
				),
				array(
 				            'name'=>'description_customer',
				            'value'=>'$data->product->description_customer',
 
				),
				array(
					'name'=>'msrp',
					'value'=>
                                    	'CHtml::textField("txtMsrp",
												$data->msrp,
												array(
														"id"=>$data->Id,
														"class"=>"txtMsrp",
														"style"=>"width:50px",
													)
											)',
							
					'type'=>'raw',
					
			        'htmlOptions'=>array('width'=>5),
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
														"style"=>"width:50px",
													)
											)',
	
					'type'=>'raw',
	
			        'htmlOptions'=>array('width'=>5),
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
														"style"=>"width:50px",
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
					'class'=>'CButtonColumn',
					'template'=>'{delete}',
					'buttons'=>array
					(
					        'delete' => array
							(
					            'url'=>'Yii::app()->createUrl("pricelist/DeletePriceListItem", array("id"=>$data->Id))',
							),
					),
				),
			),
)); ?>

</div><!-- display-->
	<?php $this->endWidget(); ?>

</div><!-- form -->

