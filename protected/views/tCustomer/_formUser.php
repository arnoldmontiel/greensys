
<?php 
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
		'id'=>'user-form',
		'type'=>'vdertical',
		'enableAjaxValidation'=>true,
		'focus'=>'input:visible:enabled:first',
		'action'=>Yii::app()->createUrl("user/create"),		
));
?>
<fieldset>
	<?php echo $form->textFieldRow($model,'username',array('size'=>20,'maxlength'=>128)); ?>
	<?php echo $form->passwordFieldRow($model,'password',array('size'=>20,'maxlength'=>128)); ?>
	<?php echo $form->textFieldRow($model,'email',array('size'=>45,'maxlength'=>128)); ?>
	<?php 
		$userGroups = CHtml::listData($ddlUserGroup, 'Id', 'description');
		echo $form->dropDownListRow($model,'Id_user_group',$userGroups); 
	?>
	<?php echo $form->textFieldRow($model,'name',array('size'=>45,'maxlength'=>100)); ?>
	<?php echo $form->textFieldRow($model,'last_name',array('size'=>45,'maxlength'=>100)); ?>
	<?php echo $form->textFieldRow($model,'address',array('size'=>45,'maxlength'=>100)); ?>
	<?php echo $form->textFieldRow($model,'phone_house',array('size'=>20,'maxlength'=>45)); ?>
	<?php echo $form->textFieldRow($model,'phone_mobile',array('size'=>20,'maxlength'=>45)); ?>
</fieldset>
	
<?php $this->endWidget(); ?>
	

