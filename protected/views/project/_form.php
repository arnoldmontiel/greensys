<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'project-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>


	<div class="row">
		<?php echo $form->labelEx($model,'Id_customer'); ?>
		<?php
		$criteria=new CDbCriteria;
		
		$criteria->with[]='contact';
		$criteria->order="contact.description";
		
		echo $form->dropDownList($model, 'Id_customer', CHtml::listData(
    			Customer::model()->findAll($criteria), 'Id', 'Description'
		),array(
				'prompt'=>'Select a Customer'
			)); 
		?>
		<?php echo $form->error($model,'Id_customer'); ?>
	</div>

	<div class="row buttons">
		<?php
			echo CHtml::link( 'Add new Customer', ProjectController::createUrl('CreateCustomer'));
			?>
	</div>

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

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->