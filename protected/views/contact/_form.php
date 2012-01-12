<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'contact-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textField($model,'description',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'telephone_1'); ?>
		<?php echo $form->textField($model,'telephone_1',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'telephone_1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'telephone_2'); ?>
		<?php echo $form->textField($model,'telephone_2',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'telephone_2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'telephone_3'); ?>
		<?php echo $form->textField($model,'telephone_3',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'telephone_3'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'address'); ?>
		<?php echo $form->textField($model,'address',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'address'); ?>
	</div>
	<div class="left">
		<div class="row buttons">
			<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
		</div>
	</div>
	<div class="right" style="margin-left:1px; width: 48%; ">
		<div class="row buttons">
			<?php echo CHtml::submitButton('Cancel', array('value'=>'Cancel', 'name'=>'Cancel')); ?>
		</div>
	</div>		
<?php $this->endWidget(); ?>

</div><!-- form -->