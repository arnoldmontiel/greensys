<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'price-list-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'date_validity'); ?>
 		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
	     // additional javascript options for the date picker plugin
 		'language'=>'es',
 		'model'=>$model,
 		'attribute'=>'date_validity',
 		'options'=>array(
	         'showAnim'=>'fold',
	     ),
	     'htmlOptions'=>array(
	         'style'=>'height:20px;'
	    ),
		));?>
		<?php echo $form->error($model,'date_validity'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textField($model,'description',array('size'=>45,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>
	
	<div class="row">
			<?php echo $form->labelEx($model,'validity'); ?>			
			<?php echo $form->checkBox($model,'validity'); ?>
			<?php echo $form->error($model,'validity'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Id_supplier'); ?>
		<?php echo $form->dropDownList($model, 'Id_supplier', CHtml::listData(
    			Supplier::model()->findAll(), 'Id', 'business_name')); 
		?>
		<?php echo $form->error($model,'Id_supplier'); ?>
		
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->