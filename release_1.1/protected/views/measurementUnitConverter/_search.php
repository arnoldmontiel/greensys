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
		<?php echo $form->label($model,'Id_measurement_from'); ?>
		<?php echo $form->textField($model,'Id_measurement_from'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Id_measurement_to'); ?>
		<?php echo $form->textField($model,'Id_measurement_to'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'factor'); ?>
		<?php echo $form->textField($model,'factor',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->