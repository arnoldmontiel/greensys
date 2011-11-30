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
		<?php echo "Area: " ?>
		<?php echo $form->dropDownList($model, 'description', $items); 
		?>
		<?php echo $form->error($model,'Id_nomenclator'); ?>
	</div>
	<?php		
		
		$itemsProduct = CHtml::listData($dataProviderProduct->getData(), 'Id', 'description_customer');
		
		$this->widget('ext.dragdroplist.dragdroplist', array(
				'id'=>'ddlist',	// default is class="ui-sortable" id="yw0"
				'items' => $itemsProduct,
				//'connectWith' =>'ddlist1',
				'options'=>array(
					'connectWith' =>'#ddlist1',
					'revert'=> true,
					'receive'=> 'js:function(event, ui) {alert("receive"); }'
		)
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



