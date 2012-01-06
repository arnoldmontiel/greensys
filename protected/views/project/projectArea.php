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


Yii::app()->clientScript->registerScript('priceListItem', "
$('input[type=checkbox]').click(function(){
	debugger;
	alert(1);
// 	if($(this).val()!= ''){
// 		$.fn.yiiGridView.update('price-list-item-grid', {
// 			data: $(this).serialize()
// 		});
// 		$.fn.yiiGridView.update('product-grid', {
// 			data: $(this).serialize()
// 		});
// 		$('#display').animate({opacity: 'show'},240);

// 					$(this).serialize()
// 				).success(
// 					function(data) 
// 					{
// 						$('#sidebar').html(data);
// 						$( '#sidebar' ).show();	
// 					}
// 				);
// 	}
// 	else{
// 		$('#display').animate({opacity: 'hide'},240);
// 		$( '#sidebar' ).hide();	

// 	}
	return false;
}
);

");

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
						$("input[type=checkbox]").click(function(){
							var target = $(this);
							$.post(
								"'.ProjectController::createUrl('AjaxSetCentralized').'",
								 {
								 	IdProject: $("#Project_Id :selected").attr("value"),
									IdArea:$(this).parent().attr("id"),
									centralized:($(this).is(":checked"))?1:0
								 }).success(
										 	function() 
										 		{ 
										 			$(target).parent().find("#centralizedok").animate({opacity: "show"},2000);
													$(target).parent().find("#centralizedok").animate({opacity: "hide"},4000);
												}); 
						});
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
	Assigned (check centralized area)
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
						'start'=>'var id=$(ui.item).attr("id");
								  var isDrag=0;',		
						'stop'=>'js:function(event, ui) 
								{
									try{
										if(isDrag == 1){
											isDrag=0;
											$(ui.item).children().animate({opacity: "show"},2000);
											$(ui.item).children().animate({opacity: "hide"},4000);
											var input = document.createElement("input");
											input.type = "checkbox";
											input.name = "centralized";
		  									$(ui.item).append(input);
		  									$("input[type=checkbox]").click(function(){
												var target = $(this);
												$.post(
													"'.ProjectController::createUrl('AjaxSetCentralized').'",
													 {
													 	IdProject: $("#Project_Id :selected").attr("value"),
														IdArea:id,
														centralized:($(this).is(":checked"))?1:0
													 }).success(
															 	function() 
															 		{
															 			$(target).parent().find("#saveok").animate({opacity: "show"},2000);
																		$(target).parent().find("#saveok").animate({opacity: "hide"},4000);
																	}); 
											});
										}
									}catch(e){
									
									}	
									
								}', 				
						'receive'=>
								'js:function(event, ui) 
								{
									isDrag = 1;
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
											IdArea:$(ui.item).attr("id"),
											centralized:($(ui.item).find("input").is(":checked"))?1:0
										}); 
								}', 				
	),
	));
	?>
			</div>
			<div id="Area" class="selectable-items">
			<?php 
			$this->widget('ext.draglist.draglist', array(
			'id'=>'dlArea',
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
