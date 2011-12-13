<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'product-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'id_brand'); ?>
		<?php echo $form->dropDownList($model, 'id_brand', CHtml::listData(
    			Brand::model()->findAll(), 'Id', 'description')); 
		?>
		<?php echo $form->error($model,'id_brand'); ?>
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
		<?php echo $form->labelEx($model,'code'); ?>
		<?php echo $form->textField($model,'code',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'code'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'code_supplier'); ?>
		<?php echo $form->textField($model,'code_supplier',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'code_supplier'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'discontinued'); ?>
		
		<?php echo $form->checkBox($model,'discontinued'); ?>
		<?php echo $form->error($model,'discontinued'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'length'); ?>
		<?php echo $form->textField($model,'length',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'length'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'width'); ?>
		<?php echo $form->textField($model,'width',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'width'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'height'); ?>
		<?php echo $form->textField($model,'height',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'height'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'profit_rate'); ?>
		<?php echo $form->textField($model,'profit_rate',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'profit_rate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'msrp'); ?>
		<?php echo $form->textField($model,'msrp',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'msrp'); ?>
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

	<div class="row">
		<?php echo $form->labelEx($model,'weight'); ?>
		<?php echo $form->textField($model,'weight',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'weight'); ?>
	</div>
<?php

$hyperLinks = CHtml::listData(Hyperlink::model()->findAllByAttributes(array('Id_product'=>$model->Id)), 'Id','description');

$this->widget('ext.linkcontainer.linkcontainer', array(
	'id'=>'linkcont',	// default is class="ui-sortable" id="yw0"
	'items'=>$hyperLinks,
			));
?>

<?php


//  $this->widget('ext.jwysiwyg.jwysiwyg', array(
//  	'id'=>'saracatunga',	// default is class="ui-sortable" id="yw0"	
//  'notes'=> '<p> <b>hola como te va </b></p>'
//  			));

?>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->