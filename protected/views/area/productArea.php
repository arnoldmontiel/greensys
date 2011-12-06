<?php
$this->breadcrumbs=array(
	'Areas'=>array('index'),
	'Assing',
);
$this->menu=array(
	array('label'=>'List Area', 'url'=>array('index')),
	array('label'=>'Create Area', 'url'=>array('create')),
	array('label'=>'Manage Area', 'url'=>array('admin')),
	array('label'=>'Assign Categories', 'url'=>array('categoryArea')),
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
		
	</div>
				
	</div>
	<div id="productArea" style="display: none">
		
	<?php		
		
		$itemsProduct = CHtml::listData($dataProviderProduct->getData(), 'Id', 'description_customer');
		
		$this->widget('ext.dragdroplist.dragdroplist', array(
				'id'=>'ddlAssigment',	// default is class="ui-sortable" id="yw0"
				'items' => array(),
				'options'=>array(
					'revert'=> true,
					'receive'=>
							'js:function(event, ui) 
							{ 
								$.post(
									"'.AreaController::createUrl('AjaxAddProductArea').'",
									 {
									 	areaId:ddlAreaId = $("#Area_Id :selected").attr("value"),
										new_IdProduct:$(ui.item).attr("id")
									 }); 
							}', 				
					'remove'=>
							'js:function(event, ui) 
							{ 
								$.post(
									"'.AreaController::createUrl('AjaxRemoveProductArea').'",
									 {
									 	areaId:ddlAreaId = $("#Area_Id :selected").attr("value"),
										old_IdProduct:$(ui.item).attr("id")
									}); 
							}', 				
		),
		));
		?>
		</div>
		<div id="product" style="display: none">
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
	<?php $this->endWidget(); ?>

	<div id="display"></div>
</div><!-- form -->
