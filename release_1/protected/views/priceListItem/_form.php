<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'price-list-item-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'Id_product'); ?>
		<?php echo $form->textField($model,'Id_product'); ?>
		<?php echo $form->error($model,'Id_product'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Id_price_list'); ?>
		<?php echo $form->textField($model,'Id_price_list'); ?>
		<?php echo $form->error($model,'Id_price_list'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cost'); ?>
		<?php echo $form->textField($model,'cost',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'cost'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->