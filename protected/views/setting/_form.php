<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'setting-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'Id'); ?>
		<?php echo $form->textField($model,'Id'); ?>
		<?php echo $form->error($model,'Id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Id_volts'); ?>
		<?php echo $form->dropDownList($model, 'Id_volts', CHtml::listData(
    			Volts::model()->findAll(), 'Id', 'volts')); 
		?>
		<?php echo $form->error($model,'Id_volts'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Id_currency'); ?>
		<?php echo $form->dropDownList($model, 'Id_currency', CHtml::listData(
    			Currency::model()->findAll(), 'Id', 'short_description')); 
		?>
		<?php echo $form->error($model,'Id_currency'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Id_measurement'); ?>
		<?php echo $form->dropDownList($model, 'Id_measurement', CHtml::listData(
    			Measurement::model()->findAll(), 'Id', 'description')); 
		?>
		<?php echo $form->error($model,'Id_measurement'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->