
<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
		'id'=>'user-group-form',
		'type'=>'horizontal',
		'enableAjaxValidation'=>true,
		'action'=>Yii::app()->createUrl("userGroup/ajaxCreate"),
));
?>

<fieldset>

	<?php echo $form->textFieldRow($model,'description',array('size'=>60,'maxlength'=>255)); ?>
	<?php echo $form->checkBoxRow($model,'is_internal'); ?>
	<?php echo $form->checkBoxRow($model,'is_administrator'); ?>
	<?php echo $form->checkBoxRow($model,'use_technical_docs'); ?>

</fieldset>
	
<?php $this->endWidget(); ?>

