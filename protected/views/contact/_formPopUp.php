<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'contact-form',
	'enableAjaxValidation'=>true,
	'action'=>Yii::app()->createUrl("contact/ajaxCreate")
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textField($model,'description',array('size'=>40,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'telephone_1'); ?>
		<?php echo $form->textField($model,'telephone_1',array('size'=>20,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'telephone_1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'telephone_2'); ?>
		<?php echo $form->textField($model,'telephone_2',array('size'=>20,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'telephone_2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'telephone_3'); ?>
		<?php echo $form->textField($model,'telephone_3',array('size'=>20,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'telephone_3'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>30,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'address'); ?>
		<?php echo $form->textField($model,'address',array('size'=>40,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'address'); ?>
	</div>
<?php $this->endWidget(); ?>

</div><!-- form -->