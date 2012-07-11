<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'budget-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'Id_project'); ?>	<?php 
		$project = CHtml::listData($modelProject, 'Id', 'description');
		echo $form->dropDownList($model, 'Id_project', $project,array('disabled'=>$model->isNewRecord ? '' : 'disabled'));
		?>
		<?php echo $form->error($model,'Id_project'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Id_budget_state'); ?>	<?php 
		$budgetState = CHtml::listData($modelBudgetState, 'Id', 'description');
		echo $form->dropDownList($model, 'Id_budget_state', $budgetState,array('disabled'=>$model->isNewRecord ? '' : 'disabled'));
		?>
		<?php echo $form->error($model,'Id_budget_state'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'version_number'); ?>
		<?php echo $form->textField($model,'version_number',array('disabled'=>'disabled')); ?>
		<?php echo $form->error($model,'version_number'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'percent_discount'); ?>
		<?php echo $form->textField($model,'percent_discount',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'percent_discount'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50,'style'=>'resize:none;')); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'date_estimated_inicialization'); ?>
 		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
	     // additional javascript options for the date picker plugin
 		'language'=>'en',
 		'model'=>$model,
 		'attribute'=>'date_estimated_inicialization',
 		'options'=>array(
	         'showAnim'=>'fold',
	     ),
	     'htmlOptions'=>array(
	         'style'=>'height:20px;'
	    ),
		));?>
		<?php echo $form->error($model,'date_estimated_inicialization'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'date_estimated_finalization'); ?>
 		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
	     // additional javascript options for the date picker plugin
 		'language'=>'en',
 		'model'=>$model,
 		'attribute'=>'date_estimated_finalization',
 		'options'=>array(
	         'showAnim'=>'fold',
	     ),
	     'htmlOptions'=>array(
	         'style'=>'height:20px;'
	    ),
		));?>
		<?php echo $form->error($model,'date_estimated_finalization'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date_inicialization'); ?>
 		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
	     // additional javascript options for the date picker plugin
 		'language'=>'en',
 		'model'=>$model,
 		'attribute'=>'date_inicialization',
 		'options'=>array(
	         'showAnim'=>'fold',
	     ),
	     'htmlOptions'=>array(
	         'style'=>'height:20px;'
	    ),
		));?>
		<?php echo $form->error($model,'date_inicialization'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'date_finalization'); ?>
 		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
	     // additional javascript options for the date picker plugin
 		'language'=>'en',
 		'model'=>$model,
 		'attribute'=>'date_finalization',
 		'options'=>array(
	         'showAnim'=>'fold',
	     ),
	     'htmlOptions'=>array(
	         'style'=>'height:20px;'
	    ),
		));?>
		<?php echo $form->error($model,'date_finalization'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->