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

	$.fn.yiiGridView.update('price-list-item-grid', {
		data: $(this).serialize()
	})
	$('#price-list-item-grid').find('input.txtCost').each(
						function(index, item){
		
							alert(index);
							 $(item).live( 'keyup', function(){
							 		alert(22);
    								validateNumber($(this));
  							});
							
							$(item).change(function(){
														var target = $(this);
														$.post(
															'".PriceListController::createUrl('AjaxUpdateCost')."',
															 {
															 	idPriceListItem:ddlProductId = $(this).attr('id'),
																cost:$(this).val()
															}).success(
																 	function() 
																 		{ 
																 			$(target).parent().parent().find('#saveok').animate({opacity: 'show'},4000);
																			$(target).parent().parent().find('#saveok').animate({opacity: 'hide'},4000); 
																		});
															
														});
								
								
								
							}
						);
	return false;
});


");


	
	
	
	
	
?>
<script type="text/javascript">

$(document).ready(function() {
	$('#price-list-item-grid').find('input.txtCost').each(
			function(index, item){
				$(item).keyup(function(){
			        validateNumber($(this));
				});
				$(item).change(function(){
											var target = $(this);
											$.post(
												"<?php echo PriceListController::createUrl('AjaxUpdateCost')?>",
												 {
												 	idPriceListItem:ddlProductId = $(this).attr('id'),
													cost:$(this).val()
												}).success(
													 	function() 
													 		{ 
													 			$(target).parent().parent().find('#saveok').animate({opacity: 'show'},4000);
																$(target).parent().parent().find('#saveok').animate({opacity: 'hide'},4000); 
															});
												
											});
					
					
					
				}
			);
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
		$modelPriceListItem = PriceListItem::model();
		$model= PriceList::model();
		$priceListDB= PriceList::model()->findAll();
		?>
		<div id="category" style="width:100%;float:left;">
		<?php $modelCategory = Category::model(); ?>
		<?php echo $form->labelEx($modelCategory,'Category'); ?>
		<?php echo $form->dropDownList($modelCategory, 'Id', CHtml::listData($modelCategory->findAll(), 'Id', 'description'),		
			array(
				'ajax' => array(
				'type'=>'POST',
				'url'=>PriceListController::createUrl('AjaxFillProducts'),
				'update'=>'#product', //selector to update
				'success'=>'js:function(data)
				{
					if($("#Category_Id :selected").attr("value")=="")
					{
						$("#product").html(data);
						$( "#product" ).animate({opacity: "hide"},"slow");
						$( "#dropContent" ).animate({opacity: "hide"},"slow");
					}
					else
					{
						$("#product").html(data);
						$( "#product" ).animate({opacity: "show"},"slow");
						$( "#product" ).children().children().each(
						function(index, item){
							$(item).draggable({"helper":"clone","connectToSortable":"#ddlAssigment"});
						}
						);
						$( "#dropContent" ).animate({opacity: "show"},"slow");
					}
				}',
				//leave out the data key to pass all form values through
				),'prompt'=>'Select a Category'
			)		
		);
		?>
		</div>
		<div id="product" class="selectable-items"style="width:50%;float:left;display: none">
		<?php
		$this->widget('ext.draglist.draglist', array(
					'id'=>'dlProduct',
					'items' => array(),
					'options'=>array(
							//'scope'=>'products',
							'helper'=> 'clone',
		),
		));
		?>
		</div>
		<div id="dropContent" style="width:50%;float:left;display: none">
			<?php  
			$this->beginWidget('zii.widgets.jui.CJuiDroppable', array(
				// additional javascript options for the droppable plugin
				'id'=>'droppable',
				'options'=>array(
				//'scope'=>'products',
				'activeClass'=> "ui-state-hover",
				'drop'=> 'js:function( event, ui ) {
					//id = $(ui.ui.draggable).attr("id");
					$.post(
						"'.PriceListController::createUrl('AjaxCreateDialog').'",
						 {
						 	IdPriceList: $("#PriceList_Id :selected").attr("value"),
							IdProduct:$(ui.draggable).attr("id")
						 },
						 function(data) {
  							$("#priceListDialogDiv").html(data);
						}); 
					$("#priceListItemDialog").dialog("open");			
				}'
			
				),
				'htmlOptions'=>array('style'=> 'width: 50%; height: 250px; padding: 0.5em; float: rigth; margin: 20px;'),
			));
			echo 'Drop here to assign';			 	
			$this->endWidget();
			?>
		</div>	            
		<div id="priceList" style="width:60%;float:left">
		
	<?php	$priceLists = CHtml::listData($priceListDB, 'Id', 'date_validity');?>

	<?php echo $form->labelEx($model,'Price List'); ?>

		<?php echo $form->dropDownList($model, 'Id', $priceLists,		
			array(
				'prompt'=>'Select a Price List'
			)		
		);
		?>
		</div>
	
<?php 


$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'price-list-item-grid',
	'dataProvider'=>$dataProvider->search(),
 	'filter'=>$dataProvider, 	
	'columns'=>array(
				array(
				 				            'name'=>'Id',
								            'value'=>'$data->Id',
				 
				),
				array(
 				            'name'=>'Id_price_list',
				            'value'=>'$data->priceList->supplier->business_name',
				           
				),
				array(
 				            'name'=>'id_product',
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
					
				),
			),
)); ?>
	<?php $this->endWidget(); ?>

</div><!-- form -->

<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', array( // the dialog
    'id'=>'priceListItemDialog',
    'options'=>array(
        'title'=>'Assign Product',
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>250,
        'height'=>250,
        'open'=>'js:function(event,ui){}',
		'buttons'=>array('Assing'=>'js:function() {
							$.post(
								"'.PriceListController::createUrl('AjaxAddPriceListItem').'",
								 {
								 	IdProduct:$( "#IdProduct" ).val(),
									IdPriceList:$( "#IdPriceList" ).val(),
									Cost:$( "#Cost" ).val()
								 }).success(
									 	function() 
									 		{
									 		$.post(
									 			"'.PriceListController::createUrl('AjaxFillPriceListItemGrid').'",
									 			{IdPriceList: $("#PriceList_Id :selected").attr("value")},
									 			function(data) {
  													$("#PriceListItems").html(data);
  													$("#PriceListItems").find("input.txtCost").each(
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
															
															}// end function(index, item)
															
													);//end .each 
								
												}
									 		);
											}
											
											);							
							
							$( this ).dialog( "close" );
					}',
				'Cancel'=>'js:function() {
					$( this ).dialog( "close" );
				}'
			),        
    ),
));?>
<div class="divForForm" id="priceListDialogDiv">
	
</div>
 
<?php $this->endWidget();?>

