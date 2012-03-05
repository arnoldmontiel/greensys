<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'measurement-unit-converter-form',
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
		<?php echo $form->labelEx($model,'Id_measurement_from'); ?>
		<?php echo $form->textField($model,'Id_measurement_from'); ?>
		<?php echo $form->error($model,'Id_measurement_from'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Id_measurement_to'); ?>
		<?php echo $form->textField($model,'Id_measurement_to'); ?>
		<?php echo $form->error($model,'Id_measurement_to'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'factor'); ?>
		<?php echo $form->textField($model,'factor',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'factor'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->