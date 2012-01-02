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
		<?php echo $form->label($model,'date_creation'); ?>
		<?php echo $form->textField($model,'date_creation'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date_validity'); ?>
		<?php echo $form->textField($model,'date_validity'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'validity'); ?>
		<?php echo $form->textField($model,'validity'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Id_supplier'); ?>
		<?php echo $form->textField($model,'Id_supplier'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Id_price_list_type'); ?>
		<?php echo $form->textField($model,'Id_price_list_type'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->