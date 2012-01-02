<?php
$this->breadcrumbs=array(
	'Services'=>array('index'),
	'Assing Categories',
);
$this->menu=array(
	array('label'=>'List Service', 'url'=>array('index')),
	array('label'=>'Create Service', 'url'=>array('create')),
	array('label'=>'Manage Service', 'url'=>array('admin')),
);
$this->trashDraggableId = 'ddlAssigment';
?>
<div class="form">
	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'serviceCategoy-form',
		'enableAjaxValidation'=>true,
	)); ?>

	<?php 	// Organize the dataProvider data into a Zii-friendly array
		$items = CHtml::listData($dataProvider->getData(), 'Id', 'description');
		?>
	<div style="row;width:100%;margin:2px;">
		<div style="width:51%;float:left;">
				
		<?php echo $form->labelEx($model,'Service'); ?>
		<?php echo $form->dropDownList($model, 'Id', $items,		
			array(
				'ajax' => array(
				'type'=>'POST',
				'url'=>ServiceController::createUrl('AjaxFillServiceCategory'),
				'update'=>'#ddlAssigment', //selector to update
				'success'=>'js:function(data)
				{
					if($("#Product_Id :selected").attr("value")=="")
					{
						$("#ddlAssigment").html(data);
						$( "#category" ).animate({opacity: "hide"},"slow");
						$( "#service" ).animate({opacity: "hide"},"slow");
						$( "#serviceCategory" ).animate({opacity: "hide"},"slow");
					}
					else
					{
						$("#ddlAssigment").html(data);
						$( "#category" ).animate({opacity: "show"},"slow");
						$( "#product" ).animate({opacity: "show"},"slow");
						$( "#serviceCategory" ).animate({opacity: "show"},"slow");
					}
				}',
				//leave out the data key to pass all form values through
				),'prompt'=>'Select a Service'
			)		
		);
		?>
		</div>
	<img id="saveok" src="images/save_ok.png" alt="" 
	  style="position: relative;float:rigth; display: none;width:20px; height:20px;" />		
	</div>
				

	<div id="serviceCategory" class="assigned-items"  style="display: none">
		
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
									"'.ServiceController::createUrl('AjaxAddServiceCategory').'",
									 {
									 	IdService:$("#Service_Id :selected").attr("value"),
										IdCategory:$(ui.item).attr("id")
									 }).success(
									 	function() 
									 		{
											}); 
							}', 				
					'remove'=>
							'js:function(event, ui) 
							{ 
								$.post(
									"'.ServiceController::createUrl('AjaxRemoveServiceCategory').'",
									 {
									 	IdService:$("#Service_Id :selected").attr("value"),
										IdCategory:$(ui.item).attr("id")
									}); 
							}', 				
		),
		));
		?>
		</div>
		<div id="category" class="selectable-items" style="display: none">
		<?php
			 $categories = CHtml::listData(Category::model()->findAll(), 'Id', 'description');
			
			$this->widget('ext.draglist.draglist', array(
			'id'=>'dlCategory',
			'items' => $categories,
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
