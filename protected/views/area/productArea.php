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
	<div style="row;width:300px;margin:2px;">
		
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
						$( "#product" ).animate({opacity: "hide"},"slow");
						$( "#productArea" ).animate({opacity: "hide"},"slow");
					}
					else
					{
						$("#ddlAssigment").html(data);
						$( "#product" ).animate({opacity: "show"},"slow");
						$( "#productArea" ).animate({opacity: "show"},"slow");
					}
				}',
				//leave out the data key to pass all form values through
				),'prompt'=>'Select an Area'
			)		
		);
		?>
		
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
					'start'=>'var id=$(ui.item).attr("id");',
							'stop'=>'js:function(event, ui) 
									{
										$(ui.item).attr("id",id);
									}', 				
		
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
									 			$( "#saveok" ).animate({opacity: "show"},2000);
												$( "#saveok" ).animate({opacity: "hide"},4000); 
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
			'items' => $itemsProduct,
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
