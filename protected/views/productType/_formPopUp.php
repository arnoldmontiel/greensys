<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'product-type-form',
	'enableAjaxValidation'=>true,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textField($model,'description',array('size'=>35,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->