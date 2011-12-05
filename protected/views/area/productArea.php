<?php
$this->breadcrumbs=array(
	'Areas'=>array('index'),
	'Assing',
);
$this->menu=array(
	array('label'=>'List Job', 'url'=>array('index')),
	array('label'=>'Create Job', 'url'=>array('create')),
	array('label'=>'Manage Job', 'url'=>array('admin')),
);

?>

<div class="form">
	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'productArea-form',
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
				'url'=>AreaController::createUrl('AjaxFillProductArea'), //url to call.
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
		
		$itemsProduct = CHtml::listData($dataProviderProduct->getData(), 'Id', 'description_customer');
		
		$this->widget('ext.dragdroplist.dragdroplist', array(
				'id'=>'ddlAssigment',	// default is class="ui-sortable" id="yw0"
				'items' => array(),
				'options'=>array(
					'connectWith' =>'#ddlProduct',
					'revert'=> true,
					//'receive'=> 'js:function(event, ui) { $.post("'.AreaController::createUrl('AjaxSaveProductArea').'", $("#ddlist").sortable("serialize", {attribute: "id"})); }' 
					'receive'=>
							'js:function(event, ui) 
							{ 
								var ddlArea = document.getElementById("Area_Id");
								var ddlAreaId = ddlArea.options[ddlArea.selectedIndex].value;
								$.post(
									"'.AreaController::createUrl('AjaxSaveProductArea').'",
									 {
									 	productId:$("#ddlAssigment").sortable( "serialize", {attribute: "id"}),
										areaId:ddlAreaId,
										newProduct:$(ui.item).attr("id"),
									 }); 
							}', 				
					'remove'=>
							'js:function(event, ui) 
							{ 
								var ddlArea = document.getElementById("Area_Id");
								var ddlAreaId = ddlArea.options[ddlArea.selectedIndex].value;
		
								$.post(
									"'.AreaController::createUrl('AjaxSaveProductArea').'",
									 {
									 	productId:$("#ddlAssigment").sortable( "serialize"),
									 	areaId:ddlAreaId
									 }); 
							}', 				
		),
		));
// 		$this->widget('ext.dragdroplist.dragdroplist', array(
// 				'id'=>'ddlProduct',	// default is class="ui-sortable" id="yw0"
// 				'items' => $itemsProduct,
// 				'options'=>array(
// 				'helper'=> 'clone',
// 				'connectWith' =>'#ddlAssigment',
// 				//'remove'=>'js:function(event, ui){alert($(ui.item).attr("id"))}',
// 				//'receive'=>'js:function(event, ui){alert($(ui.item).attr("id"))}',
// 				//'stop'=>'js:function(event, ui){before.after(clone);}',
//  				'start'=>'js:function(event, ui)
//  					{$(ui.item).show();
//  					indexOfItem = ui.item.index();
// // 					clone = $(ui.item).clone();
// // 					before = $(ui.item).prev();
//  				}',
// 				'remove'=>'js:function(event, ui)
// 					{
// 						//alert(indexOfItem);
// 						ui.item.clone().appendTo(this);
// 						//ui.item.clone().insertAfter(indexOfItem);
// 					}',
// 						),
					
				
// 		));
				

		$this->widget('ext.draglist.draglist', array(
						'id'=>'ddlProduct',	// default is class="ui-sortable" id="yw0"
						'items' => $itemsProduct,
						'options'=>array(
						'helper'=> 'clone',
						'connectToSortable'=>'#ddlAssigment',
		),
			
		
		));
		
		
		?>
		
	<?php $this->endWidget(); ?>
	<div id="display"></div>
</div><!-- form -->


