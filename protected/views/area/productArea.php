<?php
$this->breadcrumbs=array(
	'Areas'=>array('index'),
	'Assing Products',
);
$this->menu=array(
	array('label'=>'List Area', 'url'=>array('index')),
	array('label'=>'Create Area', 'url'=>array('create')),
	array('label'=>'Manage Area', 'url'=>array('admin')),
	array('label'=>'Assign Categories', 'url'=>array('categoryArea')),
	array('label'=>'Assign Services', 'url'=>array('serviceArea')),
);
$this->trashDraggableId = 'ddlAssigment';
?>
<div class="form">
	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'productArea-form',
		'enableAjaxValidation'=>true,
	)); ?>

	<?php 	// Organize the dataProvider data into a Zii-friendly array
		$items = CHtml::listData($dataProvider->getData(), 'Id', 'description');
		?>
	<div style="row;width:100%;margin:2px;">
		<div style="width:51%;float:left;">
				
		<?php echo $form->labelEx($model,'Area'); ?>
		<?php echo $form->dropDownList($model, 'Id', CHtml::listData($model->findAll(), 'Id', 'description'),		
			array(
				'ajax' => array(
				'type'=>'POST',
				'url'=>AreaController::createUrl('AjaxFillProductArea'),
				'update'=>'#ddlAssigment', //selector to update
				'success'=>'js:function(data)
				{
					if($("#Area_Id :selected").attr("value")=="")
					{
						$("#ddlAssigment").html(data);
						$( "#category" ).animate({opacity: "hide"},"slow");
						$( "#product" ).animate({opacity: "hide"},"slow");
						$( "#productArea" ).animate({opacity: "hide"},"slow");
					}
					else
					{
						$("#ddlAssigment").html(data);
						$( "#category" ).animate({opacity: "show"},"slow");
						$( "#product" ).animate({opacity: "show"},"slow");
						$( "#productArea" ).animate({opacity: "show"},"slow");
					}
				}',
				//leave out the data key to pass all form values through
				),'prompt'=>'Select an Area'
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
				'url'=>AreaController::createUrl('AjaxFillProducts'),
				'update'=>'#product', //selector to update
				'success'=>'js:function(data)
				{
					if($("#Category_Id :selected").attr("value")=="")
					{
						$("#product").html(data);
						$( "#product" ).animate({opacity: "hide"},"slow");
						//$( "#productArea" ).animate({opacity: "hide"},"slow");
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
						//$( "#productArea" ).animate({opacity: "show"},"slow");
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
				

	<div id="productArea" class="assigned-items"  style="display: none">
		
	<?php		
		
		$itemsProduct = CHtml::listData($dataProviderProduct->getData(), 'Id', 'description_customer');
		
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
									"'.AreaController::createUrl('AjaxAddProductArea').'",
									 {
									 	areaId:ddlAreaId = $("#Area_Id :selected").attr("value"),
										IdProduct:$(ui.item).attr("id")
									 }).success(
									 	function() 
									 		{
											}); 
							}', 				
					'remove'=>
							'js:function(event, ui) 
							{ 
								$.post(
									"'.AreaController::createUrl('AjaxRemoveProductArea').'",
									 {
									 	areaId:ddlAreaId = $("#Area_Id :selected").attr("value"),
										IdProduct:$(ui.item).attr("id")
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
			'items' => array(),//$itemsProduct,
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
