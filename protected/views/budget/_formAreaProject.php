<?php 
Yii::app()->clientScript->registerScript(__CLASS__.'#project-area-form', "
");
?>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'project-area-form-'.$model->Id,
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>
	
	<?php echo $form->hiddenField($model, 'Id'); ?>
	<?php echo $form->hiddenField($model, 'Id_project'); ?>
	<?php echo $form->hiddenField($model, 'Id_area'); ?>
	
	<?php echo $form->errorSummary($model); ?>
	<div class="row">			
			<?php echo $form->labelEx($model,'description'); ?>
			<?php echo $form->textField($model,'description',array('size'=>50,'maxlength'=>50)); ?>
			<?php echo $form->error($model,'description'); ?>
	</div>	

<?php $this->endWidget(); ?>

</div><!-- form -->