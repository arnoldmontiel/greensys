<?php 
Yii::app()->clientScript->registerScript(__CLASS__.'#_form'.$model->Id, "


beginBind();

function beginBind()
{
	$('#rows').children().each(
		function(index, item){
			bindEvents(item);
		}
	);
}


function bindEvents(item)
{
	var idUnit = $(item).attr('id').split('_')[1];
	
	var mmu = $(item).find('#mmu');
	$(mmu).val($(item).find('#MeasurementMeasurementUnit_Id_measurement_unit').val()); 
		
	$(item).find('#MeasurementMeasurementUnit_Id_measurement_unit').change(
		function(){
			var mmu = $(item).find('#mmu');
			$(mmu).val($(this).val()); 
		}
	);
}		
");
?>
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
		echo CHtml::openTag('div',array('id'=>'rows'));
		foreach ($modelMeasurementType as $item)
		{
			$criteria = new CDbCriteria();
			$criteria->with[]='measurementUnit';
			$criteria->addCondition('measurementUnit.Id_measurement_type = '.$item->Id);
			$modelMeasurementMeasurementUnit = MeasurementMeasurementUnit::model()->find($criteria);
			
			echo CHtml::openTag('div',array('class'=>'row','id'=>'row_'.$item->Id));
			echo CHtml::label($item->description, '');
			if(isset($modelMeasurementMeasurementUnit))
			{
				echo $form->dropDownList($modelMeasurementMeasurementUnit, 'Id_measurement_unit', CHtml::listData(
						MeasurementUnit::model()->findAllByAttributes(array('Id_measurement_type'=>$item->Id)), 'Id', 'description'));				
			}
			else
			{
				echo $form->dropDownList(MeasurementMeasurementUnit::model(), 'Id_measurement_unit', CHtml::listData(
						MeasurementUnit::model()->findAllByAttributes(array('Id_measurement_type'=>$item->Id)), 'Id', 'description'));				
			}
			echo CHtml::hiddenField('mmu['.$item->Id.']','',array('id'=>'mmu'));
				
			echo CHtml::closeTag('div');
		} 
		echo CHtml::closeTag('div');
	?>	
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->