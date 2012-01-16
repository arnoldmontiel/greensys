<div class="form">

<?php
$weightToShipping = MeasurementUnit::model()->findByAttributes(array('short_description'=>'kg'));
Yii::app()->clientScript->registerScript(__CLASS__.'#Product_msrp', "
fillVolumeTextBox('".ProductController::createUrl("AjaxFillVolume")."','txtVolume','product-form');

$('#display-weight').hide();

$('#weight').change(function(){
	$(this).val(Number($(this).val()).toFixed(2));
	if($('#Id_measurement_unit_weight').val()!='"
		.$weightToShipping->Id.
		"')
	{
		fillWieghtTextBox('".ProductController::createUrl("AjaxFillWeight")."','Product_weight','product-form');
	}else{
		$('#Product_weight').val($('#weight').val());
	}
}).keyup(function(){
	validateNumber($(this));
});

$('#Id_measurement_unit_weight').change(function(){
	if($('#Id_measurement_unit_weight').val()!='"
		.$weightToShipping->Id.
		"')
	{
 		$('#display-weight').show();
		fillWieghtTextBox('".ProductController::createUrl("AjaxFillWeight")."','Product_weight','product-form');
	}else{
		$('#Product_weight').val($('#weight').val());
 		$('#display-weight').hide();
	}
});

$('#Product_msrp').change(function(){
	$(this).val(Number($(this).val()).toFixed(2));
	if($('#Product_dealer_cost').val()!=0)
	{
		$('#Product_profit_rate').val(($('#Product_msrp').val()/$('#Product_dealer_cost').val()).toFixed(2));
	}
}).keyup(function(){
	validateNumber($(this));
});

$('#Product_dealer_cost').change(function(){
	$(this).val(Number($(this).val()).toFixed(2));
	if($('#Product_dealer_cost').val()!=0)
	{
		$('#Product_profit_rate').val(($('#Product_msrp').val()/$('#Product_dealer_cost').val()).toFixed(2));
	}
}).keyup(function(){
	validateNumber($(this));
});

$('#Product_profit_rate').change(function(){
	$(this).val(Number($(this).val()).toFixed(2));
}).keyup(function(){
	validateNumber($(this));
});

$('#Product_length').change(function(){
	$(this).val(Number($(this).val()).toFixed(2));
	fillVolumeTextBox('".ProductController::createUrl("AjaxFillVolume")."','txtVolume','product-form');
}).keyup(function(){
	validateNumber($(this));
});

$('#Product_width').change(function(){
	$(this).val(Number($(this).val()).toFixed(2));
	fillVolumeTextBox('".ProductController::createUrl("AjaxFillVolume")."','txtVolume','product-form');
}).keyup(function(){
	validateNumber($(this));
});

$('#Product_height').change(function(){
	$(this).val(Number($(this).val()).toFixed(2));
	fillVolumeTextBox('".ProductController::createUrl("AjaxFillVolume")."','txtVolume','product-form');
}).keyup(function(){
	validateNumber($(this));
});
$('#Product_Id_measurement_unit_linear').change(function(){
	fillVolumeTextBox('".ProductController::createUrl("AjaxFillVolume")."','txtVolume','product-form');
})

$('#Product_weight').change(function(){
	$(this).val(Number($(this).val()).toFixed(2));
}).keyup(function(){
	validateNumber($(this));
});


");
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'product-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); 
?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'code_supplier'); ?>
		<?php echo $form->textField($model,'code_supplier',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'code_supplier'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Id_brand'); ?>
		<?php echo $form->dropDownList($model, 'Id_brand', CHtml::listData(
    			Brand::model()->findAll(), 'Id', 'description')); 
		?>
		<?php echo $form->error($model,'Id_brand'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Id_supplier'); ?>
		<?php echo $form->dropDownList($model, 'Id_supplier', CHtml::listData(
    			Supplier::model()->findAll(), 'Id', 'business_name')); 
		?>
		<?php echo $form->error($model,'Id_supplier'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Id_category'); ?>
		<?php echo $form->dropDownList($model, 'Id_category', CHtml::listData(
    			Category::model()->findAll(), 'Id', 'description')); 
		?>
		<?php echo $form->error($model,'Id_category'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Id_nomenclator'); ?>
		<?php echo $form->dropDownList($model, 'Id_nomenclator', CHtml::listData(
    			Nomenclator::model()->findAll(), 'Id', 'description')); 
		?>
		<?php echo $form->error($model,'Id_nomenclator'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description_customer'); ?>
		<?php echo $form->textField($model,'description_customer',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'description_customer'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description_supplier'); ?>
		<?php echo $form->textField($model,'description_supplier',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'description_supplier'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'discontinued'); ?>
		
		<?php echo $form->checkBox($model,'discontinued'); ?>
		<?php echo $form->error($model,'discontinued'); ?>
	</div>

	<div class="row">
		<div style="width: 120px; display: inline-block;">
			<?php echo $form->labelEx($model,'length'); ?>
			<?php echo $form->textField($model,'length',array('size'=>10,'maxlength'=>10)); ?>
			<?php echo $form->error($model,'length'); ?>
		</div>

		<div style="width: 120px; display: inline-block;">
			<?php echo $form->labelEx($model,'width'); ?>
			<?php echo $form->textField($model,'width',array('size'=>10,'maxlength'=>10)); ?>
			<?php echo $form->error($model,'width'); ?>
		</div>

		<div style="width: 120px; display: inline-block;">
			<?php echo $form->labelEx($model,'height'); ?>
			<?php echo $form->textField($model,'height',array('size'=>10,'maxlength'=>10)); ?>
			<?php echo $form->error($model,'height'); ?>
		</div>
		<div style="width: 120px; display: inline-block;">
			<?php echo $form->labelEx($model,'Id_measurement_unit_linear'); ?>
			<?php				
				$measureType = MeasurementType::model()->findByAttributes(array('description'=>'linear'));
				 
				echo $form->dropDownList($model, 'Id_measurement_unit_linear', CHtml::listData(
	    			MeasurementUnit::model()->findAllByAttributes(array('Id_measurement_type'=>$measureType->Id)), 'Id', 'short_description')); 
			?>
			<?php echo $form->error($model,'Id_measurement_unit_linear'); ?>
		</div>
		<div style="width: 120px; display: inline-block;">
			<?php echo CHtml::label("Volume", "Product_volume"); ?>
			<?php echo CHtml::textField("txtVolume","",array('style'=>'width:90px;')); ?>
		</div>

	</div>
	<div class="row">

		<div style="width: 120px; display: inline-block;">
			<?php echo $form->labelEx($model,'weight'); ?>
			<?php echo CHtml::textField("weight",$model->weight,array('size'=>10,'maxlength'=>10)); ?>
			<?php echo $form->error($model,'weight'); ?>
		</div>
		<div style="width: 120px; display: inline-block;">
			<?php echo $form->labelEx($model,'Id_measurement_unit_weight'); ?>
			<?php				
				$measureType = MeasurementType::model()->findByAttributes(array('description'=>'weight'));
				$measuremetUnit = MeasurementUnit::model()->findAllByAttributes(array('Id_measurement_type'=>$measureType->Id));
				echo CHtml::dropDownList('Id_measurement_unit_weight', $measuremetUnit->short_description,CHtml::listData(
	    			$measuremetUnit, 'Id', 'short_description')); 
			?>
			<?php echo $form->error($model,'Id_measurement_unit_weight'); ?>
		</div>
		<div id="display-weight" style="display: inline-block;">
			<div style="width: 120px; display: inline-block;">
				<?php echo $form->labelEx($model,'weight'); ?>
				<?php echo $form->textField($model,'weight',array('size'=>10,'maxlength'=>10)); ?>
				<?php echo $form->error($model,'weight'); ?>
			</div>
			<div style="width: 120px; display: inline-block;">
				<?php echo $form->labelEx($model,'Id_measurement_unit_weight'); ?>
				<?php echo $form->dropDownList($model,'Id_measurement_unit_weight', CHtml::listData(
	    			$measuremetUnit, 'Id', 'short_description'));?> 
				<?php //echo $form->textField($model,'Id_measurement_unit_weight',array('size'=>10,'maxlength'=>10,"disabled"=>"disabled")); ?>
				<?php echo $form->error($model,'Id_measurement_unit_weight'); ?>
			</div>
		</div>
	</div>

	<div class="row">
		<div style="width: 120px; display: inline-block;">
			<?php echo $form->labelEx($model,'msrp'); ?>
			<?php echo $form->textField($model,'msrp',array('size'=>10,'maxlength'=>10)); ?>
			<?php echo $form->error($model,'msrp'); ?>
		</div>
		<div style="width: 120px; display: inline-block;">
			<?php echo $form->labelEx($model,'dealer_cost'); ?>
			<?php echo $form->textField($model,'dealer_cost',array('size'=>10,'maxlength'=>10)); ?>
			<?php echo $form->error($model,'dealer_cost'); ?>
		</div>
		<div style="width: 120px; display: inline-block;">
			<?php echo $form->labelEx($model,'profit_rate'); ?>
			<?php echo $form->textField($model,'profit_rate',array('size'=>10,'maxlength'=>10)); ?>
			<?php echo $form->error($model,'profit_rate'); ?>
		</div>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'time_instalation'); ?>
		<?php echo $form->textField($model,'time_instalation'); ?>
		<?php echo $form->error($model,'time_instalation'); ?>
	</div>

	<div class="row">
	
		<?php echo $form->labelEx($model,'hide'); ?>
		<?php echo $form->checkBox($model,'hide'); ?>
		<?php echo $form->error($model,'hide'); ?>
	</div>
<?php
$entity = EntityType::model()->findByAttributes(array('name'=>get_class($model)));
$hyperLinks = CHtml::listData(Hyperlink::model()->findAllByAttributes(array('Id_product'=>$model->Id,'Id_entity_type'=>$entity->Id)), 'Id','description');

$this->widget('ext.linkcontainer.linkcontainer', array(
	'id'=>'linkContainer',	// default is class="ui-sortable" id="yw0"
	'items'=>$hyperLinks,
			));
?>

<div style="height:270px;" >
<div class="left">
<?php 
		
		$multimediaData = Multimedia::model()->findByAttributes(array('Id_product'=>$model->Id,'Id_entity_type'=>$entity->Id));
		$multimedia = Multimedia::model();
		?>
		<div class="row">
			<?php echo $form->labelEx($multimedia,'uploadedFile'); ?>
			<?php echo $form->fileField($multimedia,'uploadedFile'); ?>
			<?php echo $form->error($multimedia,'uploadedFile'); ?>
		</div>
	
		<div class="row">
			<?php echo $form->labelEx($multimedia,'name'); ?>
			<?php echo $form->textField($multimedia,'name',array('size'=>45,'maxlength'=>45)); ?>
			<?php echo $form->error($multimedia,'name'); ?>
		</div>
	
		<div class="row">
			<?php echo $form->labelEx($multimedia,'description'); ?>
			<?php echo $form->textArea($multimedia,'description',array('rows'=>6, 'cols'=>35)); ?>
			<?php echo $form->error($multimedia,'description'); ?>
		</div>
	</div>
	<div class="right">
		<?php 
		$this->widget('ext.highslide.highslide', array(
						'id'=>$multimediaData->Id,
	)); ?>
	</div>
</div>

<?php

$note = Note::model()->findByAttributes(array('Id_product'=>$model->Id,'Id_entity_type'=>$entity->Id));

 $this->widget('ext.richtext.jwysiwyg', array(
 	'id'=>'noteContainer',	// default is class="ui-sortable" id="yw0"	
 	'notes'=> $note->note
 			));

?>


	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->