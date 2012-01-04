<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'customer-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	
	<div class="row">
		<?php echo $form->labelEx($modelPerson,'name'); ?>
		<?php echo $form->textField($modelPerson,'name',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($modelPerson,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($modelPerson,'last_name'); ?>
		<?php echo $form->textField($modelPerson,'last_name',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($modelPerson,'last_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($modelPerson,'date_birth'); ?>
 		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
	     // additional javascript options for the date picker plugin
 		'language'=>'es',
 		'model'=>$modelPerson,
 		'attribute'=>'date_birth',
 		'options'=>array(
	         'showAnim'=>'fold',
	     ),
	     'htmlOptions'=>array(
	         'style'=>'height:20px;'
	    ),
		));?>
		<?php echo $form->error($model,'date_birth'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($modelPerson,'uid'); ?>
		<?php echo $form->textField($modelPerson,'uid',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($modelPerson,'uid'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->