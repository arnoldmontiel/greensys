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

?>

<div class="form">
	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'categoryArea-form',
		'enableAjaxValidation'=>true,
	)); ?>

	<?php 	// Organize the dataProvider data into a Zii-friendly array
		$items = CHtml::listData($dataProvider->getData(), 'Id', 'description');
		?>
	<div class="row">
		
		<?php echo $form->labelEx($model,'Area'); ?>
		<?php echo $form->dropDownList($model, 'Id', CHtml::listData($model->findAll(), 'Id', 'description'),		
			array(
				'ajax' => array(
				'type'=>'POST', //request type
				'url'=>AreaController::createUrl('AjaxFillCategoryArea'), //url to call.
				//Style: CController::createUrl('currentController/methodToCall')
				'update'=>'#ddlAssigment', //selector to update
				//'data'=>'js:javascript statement'
				//leave out the data key to pass all form values through
				),'prompt'=>'select an area'
			)		
		);
		?>
		
	</div>
	<?php		
		
		$itemsCategory = CHtml::listData($dataProviderCategory->getData(), 'Id', 'description');
		
		$this->widget('ext.dragdroplist.dragdroplist', array(
				'id'=>'ddlAssigment',	// default is class="ui-sortable" id="yw0"
				'items' => array(),
				'options'=>array(
					'revert'=> true,
					'receive'=>
							'js:function(event, ui) 
							{ 
								var ddlArea = document.getElementById("Area_Id");
								var ddlAreaId = ddlArea.options[ddlArea.selectedIndex].value;
								$.post(
									"'.AreaController::createUrl('AjaxAddCategoryArea').'",
									 {
									 	areaId:ddlAreaId,
										new_IdCategory:$(ui.item).attr("id")
									 }); 
							}', 				
					'remove'=>
							'js:function(event, ui) 
							{ 
								var ddlArea = document.getElementById("Area_Id");
								var ddlAreaId = ddlArea.options[ddlArea.selectedIndex].value;
		
								$.post(
									"'.AreaController::createUrl('AjaxRemoveCategoryArea').'",
									 {
									 	areaId:ddlAreaId,
										old_IdCategory:$(ui.item).attr("id")
									}); 
							}', 				
		),
		));
		
		$this->widget('ext.draglist.draglist', array(
		'id'=>'dlCategory',
		'items' => $itemsCategory,
		'options'=>array(
				'helper'=> 'clone',
				'connectToSortable'=>'#ddlAssigment',
					),
			));
				
		?>
	<?php $this->endWidget(); ?>

	<div id="display"></div>
</div><!-- form -->
