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
<div id="showmsg"></div>
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
				'update'=>'#ddlist', //selector to update
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
				'id'=>'ddlist',	// default is class="ui-sortable" id="yw0"
				'items' => array(),
				//'connectWith' =>'ddlist1',
				'options'=>array(
					'connectWith' =>'#ddlist1',
					'revert'=> true,
					'receive'=> 'js:function(event, ui) { var order = $("#ddlist").sortable("serialize"); $.post("'.AreaController::createUrl('AjaxFillProductArea1').'", $(this).sortable("serialize")); }' 
					
		),
		
				//'itemTemplate'=>'<li id="{id}" class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>{content}'.$delete.'</li>',
		));
		$this->widget('ext.dragdroplist.dragdroplist', array(
				'id'=>'ddlist1',	// default is class="ui-sortable" id="yw0"
				'items' => $itemsProduct,
				'options'=>array(
					'connectWith' =>'#ddlist',
					'revert'=> true,
					'receive'=> 'js:function(event, ui) {alert("receive"); }'
				)
		));
		
		
		?>
		
	<?php $this->endWidget(); ?>
	<div id="display"></div>
</div><!-- form -->



