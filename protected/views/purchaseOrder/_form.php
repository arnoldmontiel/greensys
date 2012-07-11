<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'purchase-order-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'Id_supplier'); ?>
		<?php echo $form->textField($model,'Id_supplier'); ?>
		<?php echo $form->error($model,'Id_supplier'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Id_shipping_parameter'); ?>
		<?php echo $form->textField($model,'Id_shipping_parameter'); ?>
		<?php echo $form->error($model,'Id_shipping_parameter'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date_creation'); ?>
		<?php echo $form->textField($model,'date_creation'); ?>
		<?php echo $form->error($model,'date_creation'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Id_purchase_order_state'); ?>
		<?php echo $form->textField($model,'Id_purchase_order_state'); ?>
		<?php echo $form->error($model,'Id_purchase_order_state'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Id_importer'); ?>
		<?php echo $form->textField($model,'Id_importer'); ?>
		<?php echo $form->error($model,'Id_importer'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Id_shipping_type'); ?>
		<?php echo $form->textField($model,'Id_shipping_type'); ?>
		<?php echo $form->error($model,'Id_shipping_type'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->