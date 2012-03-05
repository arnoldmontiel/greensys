<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'supplier-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'business_name'); ?>
		<?php echo $form->textField($model,'business_name',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'business_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($modelContact,'description'); ?>
		<?php echo $form->textField($modelContact,'description',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($modelContact,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($modelContact,'telephone_1'); ?>
		<?php echo $form->textField($modelContact,'telephone_1',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($modelContact,'telephone_1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($modelContact,'telephone_2'); ?>
		<?php echo $form->textField($modelContact,'telephone_2',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($modelContact,'telephone_2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($modelContact,'telephone_3'); ?>
		<?php echo $form->textField($modelContact,'telephone_3',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($modelContact,'telephone_3'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($modelContact,'email'); ?>
		<?php echo $form->textField($modelContact,'email',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($modelContact,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($modelContact,'address'); ?>
		<?php echo $form->textField($modelContact,'address',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($modelContact,'address'); ?>
	</div>
	<?php
	$hyperLinks = CHtml::listData($modelHyperlink, 'Id','description');
	
	$this->widget('ext.linkcontainer.linkcontainer', array(
		'id'=>'linkContainer',	// default is class="ui-sortable" id="yw0"
		'items'=>$hyperLinks,
				));
	?>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->