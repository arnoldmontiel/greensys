<?php
$this->breadcrumbs=array(
	'Products'=>array('index'),
	'Assing Products',
);
$this->menu=array(
	array('label'=>'List Product', 'url'=>array('index')),
	array('label'=>'Create Product', 'url'=>array('create')),
	array('label'=>'Manage Product', 'url'=>array('admin')),
);
$this->trashDraggableId = 'ddlAssigment';
?>
<div class="form">
	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'productGroup-form',
		'enableAjaxValidation'=>true,
	)); ?>

	<?php 	// Organize the dataProvider data into a Zii-friendly array
		$items = CHtml::listData($dataProvider->getData(), 'Id', 'description_customer');
		?>
	<div style="row;width:100%;margin:2px;">
		<div style="width:51%;float:left;">
				
		<?php echo $form->labelEx($model,'Product'); ?>
		<?php echo $form->dropDownList($model, 'Id', $items,		
			array(
				'ajax' => array(
				'type'=>'POST',
				'url'=>ProductController::createUrl('AjaxFillProductGroup'),
				'update'=>'#ddlAssigment', //selector to update
				'success'=>'js:function(data)
				{
					if($("#Product_Id :selected").attr("value")=="")
					{
						$("#ddlAssigment").html(data);
						$( "#category" ).animate({opacity: "hide"},"slow");
						$( "#product" ).animate({opacity: "hide"},"slow");
						$( "#productProduct" ).animate({opacity: "hide"},"slow");
					}
					else
					{
						$("#ddlAssigment").html(data);
						$( "#category" ).animate({opacity: "show"},"slow");
						$( "#product" ).animate({opacity: "show"},"slow");
						$( "#productProduct" ).animate({opacity: "show"},"slow");
					}
				}',
				//leave out the data key to pass all form values through
				),'prompt'=>'Select a Product'
			)		
		);
		?>
		</div>
		<div id="category" style="width:49%;float:left; display:none">
		<?php $modelCategory = Category::model(); ?>
		<?php echo $form->labelEx($modelCategory,'Category'); ?>
		<?php echo $form->dropDownList($modelCategory, 'Id', CHtml::listData($modelCategory->findAll(), 'Id', 'description'),		
			array(
				'ajax' => array(
				'type'=>'POST',
				'url'=>ProductController::createUrl('AjaxFillProducts'),
				'update'=>'#product', //selector to update
				'success'=>'js:function(data)
				{
					if($("#Category_Id :selected").attr("value")=="")
					{
						$("#product").html(data);
						$( "#product" ).animate({opacity: "hide"},"slow");
						//$( "#productProduct" ).animate({opacity: "hide"},"slow");
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
						//$( "#productProduct" ).animate({opacity: "show"},"slow");
					}
				}',
				//leave out the data key to pass all form values through
				),'prompt'=>'Select a Category'
			)		
		);
		?>
		</div>
	<img id="saveok" src="images/save_ok.png" alt="" 
	  style="position: relative;float:rigth; display: none;width:20px; height:20px;" />		
	</div>
				

	<div id="productProduct" class="assigned-items"  style="display: none">
		
	<?php		
		
		
		$this->widget('ext.dragdroplist.dragdroplist', array(
				'id'=>'ddlAssigment',	// default is class="ui-sortable" id="yw0"
				'items' => array(),
				'options'=>array(
					'revert'=> true,
					'stop'=>'js:function(event, ui){
							$(ui.item).children().animate({opacity: "show"},2000);
							$(ui.item).children().animate({opacity: "hide"},4000);
					}',
					'start'=>'var id=$(ui.item).attr("id");var wasSuccess = false;',
					'receive'=>
							'js:function(event, ui) 
							{ 
								id = $(ui.item).attr("id");
								$.post(
									"'.ProductController::createUrl('AjaxAddProductGroup').'",
									 {
									 	IdProductParent:ddlProductId = $("#Product_Id :selected").attr("value"),
										IdProductChild:$(ui.item).attr("id")
									 }).success(
									 	function() 
									 		{
											}); 
							}', 				
					'remove'=>
							'js:function(event, ui) 
							{ 
								$.post(
									"'.ProductController::createUrl('AjaxRemoveProductGroup').'",
									 {
									 	IdProductParent:ddlProductId = $("#Product_Id :selected").attr("value"),
										IdProductChild:$(ui.item).attr("id")
									}); 
							}', 				
		),
		));
		?>
		</div>
		<div id="product" class="selectable-items" style="display: none">
		<?php 				
			$this->widget('ext.draglist.draglist', array(
			'id'=>'dlProduct',
			'items' => array(),
			'options'=>array(
					'helper'=> 'clone',
					'connectToSortable'=>'#ddlAssigment',
						),
			));				
		?>
		</div>
	
	<?php $this->endWidget(); ?>

	<div id="display"></div>
</div><!-- form -->
