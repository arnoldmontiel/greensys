<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'measurement-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'Id'); ?>
		<?php echo $form->textField($model,'Id'); ?>
		<?php echo $form->error($model,'Id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textField($model,'description',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>
	<?php
		$modelMeasurementType = MeasurementType::model()->findAll(); 
		foreach ($modelMeasurementType as $item)
		{
			echo CHtml::openTag('div',array('class'=>'row'));
			echo CHtml::label($item->description, '');
			$modelMeasurementMeasurementUnit = new MeasurementMeasurementUnit();
			$modelMeasurementMeasurementUnit->Id_measurement = null;
			echo $form->dropDownList($modelMeasurementMeasurementUnit, 'Id_measurement_unit', CHtml::listData(
					MeasurementUnit::model()->findAllByAttributes(array('Id_measurement_type'=>$item->Id)), 'Id', 'description'));
			echo CHtml::closeTag('div');
		} 
	?>	
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->