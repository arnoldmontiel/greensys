<?php
/* @var $this AuditController */
/* @var $model Audit */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'audit-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'table_name'); ?>
		<?php echo $form->textField($model,'table_name',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'table_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'operation'); ?>
		<?php echo $form->textField($model,'operation',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'operation'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date'); ?>
		<?php echo $form->textField($model,'date'); ?>
		<?php echo $form->error($model,'date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Id_table'); ?>
		<?php echo $form->textField($model,'Id_table'); ?>
		<?php echo $form->error($model,'Id_table'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->