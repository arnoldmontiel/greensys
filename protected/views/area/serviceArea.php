<?php
$this->breadcrumbs=array(
	'Areas'=>array('index'),
	'Assing Service',
);
$this->menu=array(
	array('label'=>'List Area', 'url'=>array('index')),
	array('label'=>'Create Area', 'url'=>array('create')),
	array('label'=>'Manage Area', 'url'=>array('admin')),
	array('label'=>'Assign Products', 'url'=>array('productArea')),
	array('label'=>'Assign Categories', 'url'=>array('CategoryArea')),
);
$this->trashDraggableId = 'ddlAssigment';
Yii::app()->clientScript->registerScript(__CLASS__.'#category-area', "
		function loadAssigned()
		{
			if($('#Area_Id :selected').attr('value')=='')
			{
				$('#ddlAssigment').html('');
				$('#Display').animate({opacity: 'hide'},'slow');
			}
			else
			{
				$.post('".AreaController::createUrl('AjaxFillServiceArea')."',$('#Area_Id').serialize(),
				function(data){
					$('#ddlAssigment').html(data);
					$('#Display' ).animate({opacity: 'show'},'slow');
				}
				)
			}
		}
		loadAssigned();
		$('#Area_Id').change(function(){
			loadAssigned();
		}
	);
");

?>

<div class="form">
	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'ServiceArea-form',
		'enableAjaxValidation'=>true,
	)); ?>

	<div style="row;width:300px;margin:2px;">
		
		<?php echo $form->labelEx($model,'Area');?>
		<?php echo $form->dropDownList($model, 'Id', CHtml::listData($model->findAll(), 'Id', 'description'),		
			array(
				'prompt'=>'Select an Area'
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
			Services
		</div>
	</div>
	<div id="ServiceArea"class="assigned-items">
	<?php 
		
		$itemsService = CHtml::listData($dataProviderService->getData(), 'Id', 'description');
		
		$this->widget('ext.dragdroplist.dragdroplist', array(
				'id'=>'ddlAssigment',	// default is class="ui-sortable" id="yw0"
				'items' => array(),
				'options'=>array(
					'revert'=> true,
					'start'=>'var id=$(ui.item).attr("id");',		
					'stop'=>'js:function(event, ui) 
							{
								$(ui.item).children().animate({opacity: "show"},2000);
								$(ui.item).children().animate({opacity: "hide"},4000);
							}', 				
					'receive'=>
							'js:function(event, ui) 
							{
								id = $(ui.item).attr("id");
								$.post(
									"'.AreaController::createUrl('AjaxAddServiceArea').'",
									 {
									 	IdArea: $("#Area_Id :selected").attr("value"),
										IdService:$(ui.item).attr("id")
									 }).success(
									 	function() 
									 		{ 
											}); 
							}', 				
					'remove'=>
							'js:function(event, ui) 
							{ 
								var IdService = $(ui.item).attr("id");
									
								if(IdService== undefined)
									IdService = id;
								$.post(
									"'.AreaController::createUrl('AjaxRemoveServiceArea').'",
									 {
									 	IdArea: $("#Area_Id :selected").attr("value"),
										IdService:IdService
									}); 
							}', 				
		),
		));
		?>
		</div>
		<div id="Service" class="selectable-items">
		<?php 
		$this->widget('ext.draglist.draglist', array(
		'id'=>'dlService',
		'items' => $itemsService,
		'options'=>array(
				'helper'=> 'clone',
				'connectToSortable'=>'#ddlAssigment',
					),
			));
				
		?>
		</div>
		</div>		
		<?php $this->endWidget(); ?>

	<div id="display"></div>
</div><!-- form -->
