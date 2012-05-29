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

$('#Product_code').change(function(){
	$.post(
			'".ProductController::createUrl('AjaxCheckCode')."',
			{
			 	code: $(this).val(),
			 	id: " . $model->Id."
			 }).success(
					function(data) 
					{ 
						if(data != '')
						{
							$('#errorMsg').text(data);
							$('#errorMsg').animate({opacity: 'show'},2000);
							$('#errorMsg').animate({opacity: 'hide'},2000);
						}
					}
			);
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

	<?php if (!$model->isNewRecord):?>
		<div class="row">
			<?php echo $form->labelEx($model,'code'); ?>
			<?php echo $form->textField($model,'code',array('size'=>45,'maxlength'=>45)); ?>
			<?php echo $form->error($model,'code'); ?>
			<p id="errorMsg" class="messageError"></p>
		</div>
	<?php endif; ?>
	
	<div class="row">
		<?php echo $form->labelEx($model,'code_supplier'); ?>
		<?php echo $form->textField($model,'code_supplier',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'code_supplier'); ?>
	</div>

	<div class="row">
		<div style="display: inline-block;">
			<?php echo $form->labelEx($model,'Id_brand'); ?>
			<?php echo $form->dropDownList($model, 'Id_brand', CHtml::listData(
	    			Brand::model()->findAll(), 'Id', 'description')); 
			?>
			<?php echo $form->error($model,'Id_brand'); ?>
		</div>
		<div style="display: inline-block;">
			<?php echo CHtml::link( 'Add new Brand', ProductController::createUrl('CreateDependency', array('dependency'=>'brand')));?>
		</div>
	</div>
	
	<div class="row">
		<div style="display: inline-block;">
			<?php echo $form->labelEx($model,'Id_supplier'); ?>
			<?php echo $form->dropDownList($model, 'Id_supplier', CHtml::listData(
	    			Supplier::model()->findAll(), 'Id', 'business_name')); 
			?>
			<?php echo $form->error($model,'Id_supplier'); ?>
		</div>
		<div style="display: inline-block;">
			<?php echo CHtml::link( 'Add new Supplier', ProductController::createUrl('CreateDependency', array('dependency'=>'supplier')));?>
		</div>
	</div>

	<div class="row">
		<div style="display: inline-block;">
			<?php echo $form->labelEx($model,'Id_category'); ?>
			<?php echo $form->dropDownList($model, 'Id_category', CHtml::listData(
	    			Category::model()->findAll(), 'Id', 'description'),
				array(
					'ajax' => array(
					'type'=>'POST', 
					'url'=>CController::createUrl('AjaxFillSubCategory'), 
					'update'=>'#Product_Id_sub_category',
		))); 
			?>
			<?php echo $form->error($model,'Id_category'); ?>
		</div>
		<div style="display: inline-block;">
			<?php echo CHtml::link( 'Add new Category', ProductController::createUrl('CreateDependency', array('dependency'=>'category')));?>
		</div>
	</div>
	
	<div class="row">
		<div style="display: inline-block;">
			<?php echo $form->labelEx($model,'Id_sub_category'); ?>
			<?php $subCategory = CHtml::listData($ddlSubCategory, 'Id', 'description');?>
			<?php echo $form->dropDownList($model, 'Id_sub_category', $subCategory,array(
				'prompt'=>'Select a Sub Category'
			)	); ?>
			<?php echo $form->error($model,'Id_sub_category'); ?>
		</div>
	</div>
	
	
	
	<div class="row">
		<div style="display: inline-block;">
			<?php echo $form->labelEx($model,'Id_nomenclator'); ?>
			<?php echo $form->dropDownList($model, 'Id_nomenclator', CHtml::listData(
	    			Nomenclator::model()->findAll(), 'Id', 'description')); 
			?>
			<?php echo $form->error($model,'Id_nomenclator'); ?>
		</div>
		<div style="display: inline-block;">
			<?php echo CHtml::link( 'Add new Nomenclator', ProductController::createUrl('CreateDependency', array('dependency'=>'nomenclator')));?>
		</div>		
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
			<?php echo CHtml::label("Volume (m<SUP>3</SUP>)", "Product_volume"); ?>
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
				echo CHtml::dropDownList('Id_measurement_unit_weight', '',CHtml::listData(
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
$hyperLinks = CHtml::listData($modelHyperlink, 'Id','description');

$this->widget('ext.linkcontainer.linkcontainer', array(
	'id'=>'linkContainer',	// default is class="ui-sortable" id="yw0"
	'items'=>$hyperLinks,
			));
?>


<?php

 $this->widget('ext.richtext.jwysiwyg', array(
 	'id'=>'noteContainer',	// default is class="ui-sortable" id="yw0"	
 	'notes'=> $modelNote->note
 			));

?>


	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->