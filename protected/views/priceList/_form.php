<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'price-list-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'date_creation'); ?>
		<?php echo $form->textField($model,'date_creation'); ?>
		<?php echo $form->error($model,'date_creation'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date_validity'); ?>
		<?php echo $form->textField($model,'date_validity'); ?>
		<?php echo $form->error($model,'date_validity'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'validity'); ?>
		<?php echo $form->textField($model,'validity'); ?>
		<?php echo $form->error($model,'validity'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Id_supplier'); ?>
		<?php echo $form->textField($model,'Id_supplier'); ?>
		<?php echo $form->error($model,'Id_supplier'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_price_list_type'); ?>
		<?php echo $form->textField($model,'id_price_list_type'); ?>
		<?php echo $form->error($model,'id_price_list_type'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->