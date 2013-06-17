<div class="login">
<div class="login-left">

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>
<div style="display: none">
	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username'); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password'); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>

	<div class="row rememberMe">
		<?php echo $form->checkBox($model,'rememberMe'); ?>
		<?php echo $form->label($model,'rememberMe'); ?>
		<?php echo $form->error($model,'rememberMe'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton(Yii::app()->lc->t('Login')); ?>
	</div>
</div>
</div><!-- form -->
</div><!-- left -->
<div class="login-text-logo">
	Green
	</div>	
<div class="login-right">
<?php $this->endWidget(); ?>
<?php 
	$this->widget('ext.eauth.EAuthWidget', array('action' => 'site/login'));
	if(isset($error_text))
	{
		echo CHtml::openTag('div',array('class'=>"errorMessage",'style'=>'width:200%'));
		echo $error_text;
		echo CHtml::closeTag('div');
		echo "<iframe id='logoutframe' src='https://accounts.google.com/logout' style='display: none'></iframe>";
	}
?>
</div><!-- right -->
</div>
