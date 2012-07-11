<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'Id'); ?>
		<?php echo $form->textField($model,'Id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Id_project'); ?>
		<?php echo $form->textField($model,'Id_project'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'percent_discount'); ?>
		<?php echo $form->textField($model,'percent_discount',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date_creation'); ?>
		<?php echo $form->textField($model,'date_creation'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Id_budget_state'); ?>
		<?php echo $form->textField($model,'Id_budget_state'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date_inicialization'); ?>
		<?php echo $form->textField($model,'date_inicialization'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date_finalization'); ?>
		<?php echo $form->textField($model,'date_finalization'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date_estimated_inicialization'); ?>
		<?php echo $form->textField($model,'date_estimated_inicialization'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date_estimated_finalization'); ?>
		<?php echo $form->textField($model,'date_estimated_finalization'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'version_number'); ?>
		<?php echo $form->textField($model,'version_number'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->