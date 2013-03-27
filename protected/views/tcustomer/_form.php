<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'customer-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($modelPerson); ?>
	<?php echo $form->errorSummary($modelContact); ?>
	<?php echo $form->errorSummary($modelUser); ?>
	<div class="row">
		<?php echo $form->labelEx($modelPerson,'name'); ?>
		<?php echo $form->textField($modelPerson,'name',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($modelPerson,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($modelPerson,'last_name'); ?>
		<?php echo $form->textField($modelPerson,'last_name',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($modelPerson,'last_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($modelPerson,'date_birth'); ?>
 		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
	     // additional javascript options for the date picker plugin
 		'language'=>'es',
 		'model'=>$modelPerson, 		
 		'attribute'=>'date_birth',
 		'options'=>array(
	         'showAnim'=>'fold',
 			 'yearRange'=>'1930',
	         'changeYear'=>'true'
	     ),
	     'htmlOptions'=>array(
	         'style'=>'height:20px;'
	    ),
		));?>
		<?php echo $form->error($modelPerson,'date_birth'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($modelPerson,'uid'); ?>
		<?php echo $form->textField($modelPerson,'uid',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($modelPerson,'uid'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($modelContact,'description'); ?>
		<?php echo $form->textField($modelContact,'description',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($modelContact,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($modelContact,'telephone_1'); ?>
		<?php echo $form->textField($modelContact,'telephone_1',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($modelContact,'telephone_1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($modelContact,'telephone_2'); ?>
		<?php echo $form->textField($modelContact,'telephone_2',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($modelContact,'telephone_2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($modelContact,'telephone_3'); ?>
		<?php echo $form->textField($modelContact,'telephone_3',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($modelContact,'telephone_3'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($modelContact,'email'); ?>
		<?php echo $form->textField($modelContact,'email',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($modelContact,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($modelContact,'address'); ?>
		<?php echo $form->textField($modelContact,'address',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($modelContact,'address'); ?>
	</div>
	<?php
	$hyperLinks = CHtml::listData($modelHyperlink, 'Id','description');
	
	$this->widget('ext.linkcontainer.linkcontainer', array(
		'id'=>'linkContainer',	// default is class="ui-sortable" id="yw0"
		'items'=>$hyperLinks,
				));
	?>

	<div class="row">
		<?php echo $form->labelEx($modelUser,'username'); ?>
		<?php echo $form->textField($modelUser,'username',array('size'=>60,'maxlength'=>128,'disabled'=>$modelCustomer->isNewRecord ? false : true)); ?>
		<?php echo $form->error($modelUser,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($modelUser,'password'); ?>
		<?php echo $form->passwordField($modelUser,'password',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($modelUser,'password'); ?>
	</div>
		
	<div class="row">	
		<?php echo $form->labelEx($modelUser,'send_mail'); ?>
		<?php echo $form->checkBox($modelUser,'send_mail', array('checked','checked')); ?>
		<?php echo $form->error($modelUser,'send_mail'); ?>
	</div>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton($modelCustomer->isNewRecord ? 'Crear' : 'Guardar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->