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

<script>
	$(function() {
		$( "#ddlAssigment" ).sortable({
			revert: true
		});
		$( "#ddlProduct li" ).draggable({
			connectToSortable: "#ddlAssigment",
			helper: "clone",
			revert: "invalid"
		});
		$( "ul, li" ).disableSelection();
	});
	</script>

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
		//$itemsProduct = array('product_1'=>'primero','product_2'=>'segundo','product_3'=>'tercero');
		
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
									 	areaId:ddlAreaId
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
		$this->widget('ext.dragdroplist.dragdroplist', array(
				'id'=>'ddlProduct',	// default is class="ui-sortable" id="yw0"
				'items' => $itemsProduct,
				'options'=>array(
					'connectWith' =>'#ddlAssigment',
					'revert'=> true
					),
					
				
		));
		
		
		?>
		
	<?php $this->endWidget(); ?>
	<div id="display"></div>
</div><!-- form -->



