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
<div style="margin-top:25%;margin-left:20%">	
<?php $this->endWidget(); ?>
<?php 
$this->widget('ext.eauth.EAuthWidget', array('action' => 'site/login'));
 ?>
 </div>
</div><!-- form -->
</div><!-- left -->
<div class="login-right">
	<div class="login-text-logo">
	Welcome to Green
	</div>	
</div><!-- right -->
</div>
