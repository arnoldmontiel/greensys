<?php
$this->breadcrumbs=array(
	'Price List'=>array('index'),
	'Assign Product',
);

$this->menu=array(
	array('label'=>'List PriceList', 'url'=>array('index')),
	array('label'=>'Create PriceList', 'url'=>array('create')),
);


Yii::app()->clientScript->registerScript('search', "


$('#PriceList_Id').change(function(){
	
	if($(this).val()!= ''){
		$.fn.yiiGridView.update('price-list-item-grid', {
			data: $(this).serialize()
		});
		$.fn.yiiGridView.update('product-grid', {
			data: $(this).serialize()
		});
		$('#price-list-item-grid').animate({opacity: 'show'},40);
		$('#product-grid').animate({opacity: 'show'},40);
		$('#addAll').animate({opacity: 'show'},40);
		$('#deleteAll').animate({opacity: 'show'},40);
		$('.gridTitle').animate({opacity: 'show'},40);
	}
	else{
		$('#price-list-item-grid').animate({opacity: 'hide'},40);
		$('#product-grid').animate({opacity: 'hide'},40);
		$('#addAll').animate({opacity: 'hide'},40);
		$('#deleteAll').animate({opacity: 'hide'},40);
		$('.gridTitle').animate({opacity: 'hide'},40);
	}
	return false;
});


");
	
	
?>
<script type="text/javascript">

$(document).ready(function() {
	$('#price-list-item-grid').animate({opacity: "hide"},40);
	$('#product-grid').animate({opacity: "hide"},40);
	$('.gridTitle').animate({opacity: "hide"},40);
});

	

function validateNumber(obj)
{
	var value=$(obj).val();
    var orignalValue=value;
    value=value.replace(/[0-9]*/g, "");			
   	var msg="Only Decimal Values allowed."; 						
   	value=value.replace(/\./, "");

    if (value!=""){
    	orignalValue=orignalValue.replace(value, "");
    	$(obj).val(orignalValue);
    	alert(msg);
    }
}
</script>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'priceList-form',
		'enableAjaxValidation'=>true,
));
		
		$model= PriceList::model();
		$priceListDB= PriceList::model()->findAll();
		?>
	
	<div id="priceList" style="width:60%;float:left">
		
		<?php	$priceLists = CHtml::listData($priceListDB, 'Id', 'PriceListDesc');?>

		<?php echo $form->labelEx($model,'Price List'); ?>

		<?php echo $form->dropDownList($model, 'Id', $priceLists,		
			array(
				'prompt'=>'Select a Price List'
			)		
		);
		?>
	</div>
		

	<div style="width:100%;height:70px;margin-bottom:30px;margin-top:20px">
		<div style="width:20%;float:left;  clear: both;margin-top:30px;">
			<p class="gridTitle"><b>Products</b></p>
		</div>
		<div style="float:right;right:0;margin-top:25px">
		<?php
		echo CHtml::imageButton(
                                'images/add_all.png',
                                array(
                                'title'=>'Add current filtered products',
                                'width'=>'30px',
                                'style'=>'display:none',
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
		'selectionChanged'=>'js:function(){
			$.get(	"'.PriceListController::createUrl('AjaxAddPriceListItem').'",
					{
						IdPriceList:$("#PriceList_Id :selected").attr("value"),
						IdProduct:$.fn.yiiGridView.getSelection("product-grid")
					}).success(
						function() 
						{
							$.fn.yiiGridView.update("price-list-item-grid", {
							data: $(this).serialize()
							});
						})
					.error(
						function()
						{
							$(".messageError").animate({opacity: "show"},2000);
							$(".messageError").animate({opacity: "hide"},2000);
						});
		}',
		'columns'=>array(	
			array('name'=>'Id',
			'value'=>'$data->Id',
			'visible'=>false,
			),
			array(
		 		'name'=>'supplier_description',
				'value'=>'$data->supplier->business_name',
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
			),
		));		
		?>



		<p class="messageError"><?php
		echo Yii::app()->lc->t('Product has already been added to selected Price List');
		?></p>
	

		<div style="width:100%;height:30px;margin-bottom:30px;margin-top:20px">
			<div style="width:40%;float:left;  clear: both;margin-top:30px;">
				<p class="gridTitle"><b>Price List Items</b></p>
			</div>
		<div style="float:right;right:0;margin-top:25px">

<?php
		echo CHtml::imageButton(
                                'images/delete_all.png',
                                array(
                                'title'=>'Delete current filtered products',
                                'width'=>'30px',
                                'style'=>'display:none',
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
 	'afterAjaxUpdate'=>'function(id, data){
 										$("#price-list-item-grid").animate({opacity: "show"},400);
 										$("#price-list-item-grid").find("input.txtCost").each(
												function(index, item){
		
																$(item).keyup(function(){
			        												validateNumber($(this));
																});
												
																$(item).change(function(){
																	var target = $(this);
																	$.post(
																		"'.PriceListController::createUrl('AjaxUpdateCost').'",
																		 {
																		 	idPriceListItem:ddlProductId = $(this).attr("id"),
																			cost:$(this).val()
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
 				            'name'=>'code_supplier',
				            'value'=>'$data->product->code_supplier',
 
				),
				array(
 				            'name'=>'code',
				            'value'=>'$data->product->code',
				 
				),
				array(
 				            'name'=>'description_customer',
				            'value'=>'$data->product->description_customer',
 
				),
				array(
					'name'=>'cost',
					'value'=>
                                    	'CHtml::textField("txtCost",
												$data->cost,
												array(
														"id"=>$data->Id,
														"class"=>"txtCost",
														"height"=>"10px"
													)
											)',
							
					'type'=>'raw',
					
			        'htmlOptions'=>array('width'=>5),
				),
				array(
					'value'=>'CHtml::image("images/save_ok.png","",array("id"=>"saveok", "style"=>"display:none", "width"=>"20px", "height"=>"20px"))',
					'type'=>'raw',
					'htmlOptions'=>array('width'=>20),
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


	<?php $this->endWidget(); ?>

</div><!-- form -->

