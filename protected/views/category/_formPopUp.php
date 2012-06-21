<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'category-form',
	'enableAjaxValidation'=>true,
	'action'=>Yii::app()->createUrl("category/ajaxCreate")		
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textField($model,'description',array('size'=>50,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->