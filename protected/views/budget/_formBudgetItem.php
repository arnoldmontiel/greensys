<?php 
Yii::app()->clientScript->registerScript(__CLASS__.'#budgetItem-form', "
$('#BudgetItem_price').keyup(function(){
	validateNumber($(this));
});
$('#BudgetItem_quantity').keyup(function(){
	validateNumber($(this));
});
");
?>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'budget-item-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	
	<?php echo $form->hiddenField($model, 'Id_budget'); ?>
	<?php echo $form->hiddenField($model, 'version_number'); ?>
	
	<?php echo $form->errorSummary($model); ?>
	<div class="row">
		<div style="width: 50%; display: inline-block;">
			<?php echo $form->labelEx($model,'description'); ?>
			<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50,'style'=>'resize:none;')); ?>
			<?php echo $form->error($model,'description'); ?>
		</div>
		
		<div style="width: 120px; display: inline-block;">
			<div class="row">
				<?php echo $form->labelEx($model,'quantity'); ?>
				<?php echo $form->textField($model,'quantity',array('size'=>10,'maxlength'=>10)); ?>
				<?php echo $form->error($model,'quantity'); ?>
			</div>
			
			<div class="row">
				<?php echo $form->labelEx($model,'price'); ?>
				<?php echo $form->textField($model,'price',array('size'=>10,'maxlength'=>10)); ?>
				<?php echo $form->error($model,'price'); ?>
			</div>
		</div>
	</div>	

<?php $this->endWidget(); ?>

</div><!-- form -->