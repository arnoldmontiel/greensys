<?php
$this->breadcrumbs=array(
	'Project'=>array('index'),
	'Assing Area',
);
$this->menu=array(
	array('label'=>'Create Project', 'url'=>array('create')),
	array('label'=>'Manage Project', 'url'=>array('admin')),
);
$this->trashDraggableId = 'ddlAssigment';

?>

<div class="form">
	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'ProjectArea-form',
		'enableAjaxValidation'=>true,
	)); ?>

	<?php 	// Organize the dataProvider data into a Zii-friendly array
		$items = CHtml::listData($dataProvider->getData(), 'Id', 'description');
		?>
	<div style="row;width:300px;margin:2px;">
		
		<?php echo $form->labelEx($model,'Project'); ?>
		<?php echo $form->dropDownList($model, 'Id', CHtml::listData($model->findAll(), 'Id', 'description'),		
			array(
				'ajax' => array(
				'type'=>'POST',
				'url'=>ProjectController::createUrl('AjaxFillProjectArea'),
				'update'=>'#ddlAssigment', 
				'success'=>'js:function(data)
				{
					if($("#Project_Id :selected").attr("value")=="")
					{
						$("#ddlAssigment").html(data);
						$( "#Display" ).animate({opacity: "hide"},"slow");
					}
					else
					{
						$("#ddlAssigment").html(data);
						$( "#Display" ).animate({opacity: "show"},"slow");
					}
				}',
				//leave out the data key to pass all form values through
				),'prompt'=>'Select a Project'
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
	Areas
	</div>
	</div>
	<div id="ProjectArea"class="assigned-items">
	<?php
	
	$itemsArea = CHtml::listData($dataProviderArea->getData(), 'Id', 'description');
	
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
										"'.ProjectController::createUrl('AjaxAddProjectArea').'",
										 {
										 	IdProject: $("#Project_Id :selected").attr("value"),
											IdArea:$(ui.item).attr("id")
										 }).success(
										 	function() 
										 		{ 
												}); 
								}', 				
						'remove'=>
								'js:function(event, ui) 
								{ 
									var IdService = $(ui.item).attr("id");
									$.post(
										"'.ProjectController::createUrl('AjaxRemoveProjectArea').'",
										 {
										 	IdProject: $("#Project_Id :selected").attr("value"),
											IdArea:$(ui.item).attr("id")
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
			'items' => $itemsArea,
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
