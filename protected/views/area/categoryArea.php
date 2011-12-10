<?php
$this->breadcrumbs=array(
	'Areas'=>array('index'),
	'Assing',
);
$this->menu=array(
	array('label'=>'List Area', 'url'=>array('index')),
	array('label'=>'Create Area', 'url'=>array('create')),
	array('label'=>'Manage Area', 'url'=>array('admin')),
	array('label'=>'Assign Products', 'url'=>array('productArea')),
);
$this->trashDraggableId = 'ddlAssigment';

?>

<div class="form">
	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'categoryArea-form',
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
				'url'=>AreaController::createUrl('AjaxFillCategoryArea'),
				'update'=>'#ddlAssigment', 
				'success'=>'js:function(data)
				{
					if($("#Area_Id :selected").attr("value")=="")
					{
						$("#ddlAssigment").html(data);
						$( "#category" ).animate({opacity: "hide"},"slow");
						$( "#categoryArea" ).animate({opacity: "hide"},"slow");
					}
					else
					{
						$("#ddlAssigment").html(data);
						$( "#category" ).animate({opacity: "show"},"slow");
						$( "#categoryArea" ).animate({opacity: "show"},"slow");
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
	<div id="categoryArea"class="assigned-items" style="display: none">
	<?php 
		
		$itemsCategory = CHtml::listData($dataProviderCategory->getData(), 'Id', 'description');
		
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
									"'.AreaController::createUrl('AjaxAddCategoryArea').'",
									 {
									 	areaId:ddlAreaId = $("#Area_Id :selected").attr("value"),
										IdCategory:$(ui.item).attr("id")
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
								var IdCategory = $(ui.item).attr("id");
								$.post(
									"'.AreaController::createUrl('AjaxRemoveCategoryArea').'",
									 {
									 	areaId:ddlAreaId = $("#Area_Id :selected").attr("value"),
										IdCategory:$(ui.item).attr("id")
									}); 
							}', 				
		),
		));
		?>
		</div>
		<div id="category" class="selectable-items" style="display: none">
		<?php 
		$this->widget('ext.draglist.draglist', array(
		'id'=>'dlCategory',
		'items' => $itemsCategory,
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
