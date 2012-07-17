<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'purchase-order-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'Id_supplier'); ?>
		<?php echo $form->dropDownList($model, 'Id_supplier', CHtml::listData(
    			Supplier::model()->findAll(), 'Id', 'business_name')); 
		?>
		<?php echo $form->error($model,'Id_supplier'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'Id_importer'); ?>
		<?php echo $form->dropDownList($model, 'Id_importer', CHtml::listData(
    			Importer::model()->findAll(), 'Id', 'contact.description')); 
		?>
		<?php echo $form->error($model,'Id_importer'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Id_shipping_type'); ?>
		<?php echo $form->dropDownList($model, 'Id_shipping_type', CHtml::listData(
    			ShippingType::model()->findAll(), 'Id', 'description')); 
		?>
		<?php echo $form->error($model,'Id_shipping_type'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->