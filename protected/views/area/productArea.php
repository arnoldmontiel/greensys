<script>
$(function() {
	$("#AAAAAdlTest_0").draggable({
'helper':'clone','connectToSortable':'#ddlAssigment'});
}

$(function() {
	$( "#AAAAdraggable" ).draggable();
});
</script>

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
//					'connectWith' =>'#ddlProduct',
					'revert'=> true,
					'receive'=>
							'js:function(event, ui) 
							{ 
								var ddlArea = document.getElementById("Area_Id");
								var ddlAreaId = ddlArea.options[ddlArea.selectedIndex].value;
								$.post(
									"'.AreaController::createUrl('AjaxAddProductArea').'",
									 {
									 	areaId:ddlAreaId,
										new_IdProduct:$(ui.item).attr("id")
									 }); 
							}', 				
					'remove'=>
							'js:function(event, ui) 
							{ 
								var ddlArea = document.getElementById("Area_Id");
								var ddlAreaId = ddlArea.options[ddlArea.selectedIndex].value;
		
								$.post(
									"'.AreaController::createUrl('AjaxRemoveProductArea').'",
									 {
									 	areaId:ddlAreaId,
										old_IdProduct:$(ui.item).attr("id")
									}); 
							}', 				
		),
		));
				

		$this->widget('ext.draglist.draglist', array(
						'id'=>'dlProduct',
						'items' => $itemsProduct,
						'options'=>array(
							'helper'=> 'clone',
							'connectToSortable'=>'#ddlAssigment',
							'start'=>'js:function(event,ui)
								{
									$.ajax({
										url:"'.AreaController::createUrl('AjaxTest').'",
										success:function(html){
											html.getEle
											jQuery("#dlTest").html(html);
											for(var i=0;i<10;i++)
												jQuery("#dlTest_"+i).draggable({"helper":"clone","connectToSortable":"#ddlAssigment"});
										},
										type:"POST"
										})
							}'
					),
			
		
		));
		
		?>
		<br/>
		<div id="dlTest">
		<?php 
		$this->widget('ext.draglist.draglist', array(
										'id'=>'dlTest',
										'qItems'=>10,
										'items'=>array('1'=>'hola','2'=>'test jq'),
										'options'=>array(
											'helper'=> 'clone',
											'connectToSortable'=>'#ddlAssigment',
		),
		
		));
		?>
		</div>
<!--		
<div class="demo">

<div id="draggable" class="ui-widget-content">
	<p>Drag me around</p>
</div>

</div>
		<div id="dlTest_0" class="ui-draggable">
		<li id="items_2">Cust1</li>
		</div>
		
		<div id="draggable1" class="ui-widget-content">
		<p>Drag me around</p>
		</div>
-->
	<?php $this->endWidget(); ?>

	<div id="display"></div>
</div><!-- form -->
