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
		<?php echo $form->label($model,'Id_volts'); ?>
		<?php echo $form->textField($model,'Id_volts'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Id_currency'); ?>
		<?php echo $form->textField($model,'Id_currency'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Id_measurement'); ?>
		<?php echo $form->textField($model,'Id_measurement'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->