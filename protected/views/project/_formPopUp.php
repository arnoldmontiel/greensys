<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'project-form',
	'enableAjaxValidation'=>false,
)); ?>


	<?php echo $form->errorSummary($model); ?>


	<?php echo $form->hiddenField($model, 'Id_customer'); ?>
	<?php if(!isset($model->Id_customer)) : ?>
		<div class="row" >
			<?php echo $form->labelEx($model,'Id_customer'); ?>
			<?php echo $form->dropDownList($model, 'Id_customer', CHtml::listData(
	    			Customer::model()->findAll(), 'Id', 'FullName'
			),array(
					'prompt'=>'Select a Customer'
				)); 
			?>
			<?php echo $form->error($model,'Id_customer'); ?>
		</div>
	<?php endif; ?>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textField($model,'description',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'address'); ?>
		<?php echo $form->textField($model,'address',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'address'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->