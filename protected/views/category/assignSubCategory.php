<?php
$this->breadcrumbs=array(
	'Category'=>array('index'),
	'Assing',
);
$this->menu=array(
	array('label'=>'List Category', 'url'=>array('index')),
	array('label'=>'Create Category', 'url'=>array('create')),
	array('label'=>'Manage Category', 'url'=>array('admin')),
);
$this->trashDraggableId = 'ddlAssigment';

Yii::app()->clientScript->registerScript(__CLASS__.'#Product', "
	loadAssigned();
	function loadAssigned()
	{
		if($('#Category_Id :selected').attr('value')=='')
		{
			$('#ddlAssigment').html('');
			$('#Display').animate({opacity: 'hide'},'slow');
		}
		else
		{
			$.post('".CategoryController::createUrl('AjaxFillCategorySubCat')."',$('#Category_Id').serialize(),
				function(data){
					$('#ddlAssigment').html(data);
					$('#Display' ).animate({opacity: 'show'},'slow');
				}
			)
		}
	}
	$('#Category_Id').change(function(){
		loadAssigned();
	})
		
");

?>

<div class="form">
	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'assignSubCategory-form',
		'enableAjaxValidation'=>true,
	)); ?>

	<?php 	// Organize the dataProvider data into a Zii-friendly array
		$items = CHtml::listData($dataProvider->getData(), 'Id', 'description');
		?>
	<div style="row;width:300px;margin:2px;">
		
		<?php echo $form->labelEx($model,'Category'); ?>
		<?php echo $form->dropDownList($model, 'Id', CHtml::listData($model->findAll(), 'Id', 'description'),		
			array(
				'prompt'=>'Select a Category'
			)		
		);
		?>
		
	</div>				
	<div id="Display" style="display: none">	
	<div class="gridTitle-decoration1" style="float: left; width: 50%;">
		<div class="gridTitle1">
			Assigned
		</div>
	</div>		
	<div class="gridTitle-decoration1" >
		<div class="gridTitle1" >
			Sub Categories
		</div>
	</div>
	
	<div id="categorySubCategory"class="assigned-items">
	<?php 
		
		$itemsSubCategory = CHtml::listData($dataProviderSubCategory->getData(), 'Id', 'description');
		
		$this->widget('ext.dragdroplist.dragdroplist', array(
				'id'=>'ddlAssigment',	// default is class="ui-sortable" id="yw0"
				'items' => array(),
				'options'=>array(
					'revert'=> true,
					'start'=>'var id=$(ui.item).attr("id");',		
					'stop'=>'js:function(event, ui) 
							{
								if ( typeof id !== "undefined" && id) 
									$(ui.item).attr("id",id);
								
								$(ui.item).children().animate({opacity: "show"},2000);
								$(ui.item).children().animate({opacity: "hide"},4000);
		
							}', 				
					'receive'=>
							'js:function(event, ui) 
							{
								id = $(ui.item).attr("id");
								$.post(
									"'.CategoryController::createUrl('AjaxAddSubCategory').'",
									 {
									 	IdCategory:ddlCategoryId = $("#Category_Id :selected").attr("value"),
										IdSubCategory:$(ui.item).attr("id")
									 }).success(
									 	function(data) 
									 		{ 
											}); 
							}', 				
					'remove'=>
							'js:function(event, ui) 
							{ 
								var IdCategory = $(ui.item).attr("id");
								$.post(
									"'.CategoryController::createUrl('AjaxRemoveSubCategory').'",
									 {
									 	IdCategory:ddlCategoryId = $("#Category_Id :selected").attr("value"),
										IdSubCategory:$(ui.item).attr("id")
									}); 
							}', 				
		),
		));
		?>
		</div>
		<div id="subCategory" class="selectable-items">
		<?php 
		$this->widget('ext.draglist.draglist', array(
		'id'=>'dlSubCategory',
		'items' => $itemsSubCategory,
		'options'=>array(
				'helper'=> 'clone',
				'connectToSortable'=>'#ddlAssigment',
					),
			));
				
		?>
		</div>
		<?php $this->endWidget(); ?>

	</div>
</div><!-- form -->
