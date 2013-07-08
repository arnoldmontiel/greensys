<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
		'id'=>'project-form',
		'type'=>'vertical',
		'enableAjaxValidation'=>true,
		'action'=>Yii::app()->createUrl("project/ajaxCreate"),
));
?>

<fieldset>

	<?php echo $form->hiddenField($model, 'Id_customer'); ?>
	<?php echo $form->hiddenField($model, 'Id_customer'); ?>
	<?php if(!isset($model->Id_customer)) : ?>
			<?php echo $form->dropDownListRow($model, 'Id_customer', CHtml::listData(
	    			Customer::model()->findAll(), 'Id', 'FullName'
			),array(
					'prompt'=>'Select a Customer'
				)); 
			?>
	<?php endif; ?>
	<?php echo $form->textFieldRow($model,'description',array('size'=>45,'maxlength'=>45)); ?>
	<?php echo $form->textFieldRow($model,'address',array('size'=>60,'maxlength'=>100)); ?>
</fieldset>
	
<?php $this->endWidget(); ?>

