<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'stock-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'Id_movement_type'); ?>
		<?php 
		$movementTypeData = CHtml::listData($movementTypes, 'Id', 'description');
		echo $form->dropDownList($model, 'Id_movement_type', $movementTypeData);
		?>
		<?php echo $form->error($model,'Id_movement_type'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'Id_project'); ?>
		<?php 
		$projectData = CHtml::listData($projects, 'Id', 'description');
		echo $form->dropDownList($model, 'Id_project', $projectData,array('prompt'=>'Projects'));
		?>
		<?php echo $form->error($model,'Id_project'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php 
		$userData = CHtml::listData($users, 'username', 'username');
		echo $form->dropDownList($model, 'username', $userData,array('prompt'=>'Users'));
		?>
		<?php echo $form->error($model,'username'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textField($model,'description',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->