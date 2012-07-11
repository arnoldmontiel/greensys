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
		<?php echo $form->label($model,'Id_supplier'); ?>
		<?php echo $form->textField($model,'Id_supplier'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Id_shipping_parameter'); ?>
		<?php echo $form->textField($model,'Id_shipping_parameter'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date_creation'); ?>
		<?php echo $form->textField($model,'date_creation'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Id_purchase_order_state'); ?>
		<?php echo $form->textField($model,'Id_purchase_order_state'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Id_importer'); ?>
		<?php echo $form->textField($model,'Id_importer'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Id_shipping_type'); ?>
		<?php echo $form->textField($model,'Id_shipping_type'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->