<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'nomenclator-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textField($model,'description',array('size'=>40,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->