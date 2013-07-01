<?php 
Yii::app()->clientScript->registerScript(__CLASS__.'#review-form-create', "
	$('#Review_Id_review_type').change(function(){
		$.post(
			'".ReviewController::createUrl('AjaxGetNextReviewIndex')."',
		{
		idCustomer: ".$model->Id_customer.",
		idProject: ".$model->Id_project.",
		idReviewType:$(this).val()
	}).success(
		function(data)
		{
			$('#Review_review').val(data);
		});

	$.post(
			'".ReviewController::createUrl('AjaxReviewTypeLongDescription')."',
		{
		idReviewType:$(this).val()
	}).success(
		function(data)
		{
			$('#Review_type_long_description').html(data);
		});
	});
					
	$('#btnCancel').click(function(){
		window.location = '".ReviewController::createUrl('index',array('Id_customer'=>$model->Id_customer,'Id_project'=>$model->Id_project))."';
		return false;
	});
");
		
$this->widget('ext.processingDialog.processingDialog', array(
		'buttons'=>array('save'),
		'idDialog'=>'wating',
));

?>


<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'review-form',
	'enableAjaxValidation'=>true,
	'focus'=>array($model,'description')
		
)); ?>

	<?php echo $form->errorSummary(array($model,$modelNote)); ?>
	
	<div class="row">
		<?php echo CHtml::label('N&uacute;mero de Revisi&oacute;n', 'Review[review]'); ?>
		<?php echo $form->textField($model,'review',array('style'=>'width:25px;text-align:center;')); ?>
		<?php echo $form->error($model,'review'); ?>
	</div>

	<div class="row">
		<?php echo CHtml::label('Tipo', 'Review_Id_review_type'); ?>
		<?php 
		$reviewTypes = CHtml::listData($modelReviewType, 'Id', 'description');
		echo $form->dropDownList($model, 'Id_review_type', $reviewTypes);
		?>
		<?php echo $form->error($model,'Id_review_type'); ?>
	</div>
	<div class="row">
		<?php echo CHtml::openTag('p',array('id'=>'Review_type_long_description'))?>
		<?php
			foreach ($modelReviewType as $item)
			{
				if(isset($item))
				{
					echo $item['long_description'];
					break;						
				}
			} 
		?>
		<?php echo CHtml::closeTag('p'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php // echo CHtml::label('Asunto', 'Review[description]'); ?>
		<?php echo $form->textField($model,'description',array('rows'=>1, 'cols'=>140,'maxlength'=>100,'style'=>'resize:none;width:60%;')); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>
	<div class="row-fluid">
		<?php echo $form->labelEx($modelNote,'note'); ?>
		<?php //echo $form->label('Nota', 'Note[note]'); ?>
		<?php echo $form->textArea($modelNote,'note',array('rows'=>10, 'cols'=>100,'style'=>'resize:none;width:97%;')); ?>
		<?php echo $form->error($modelNote,'note'); ?>
	</div>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar',array('id'=>'save')); ?>
		<?php echo CHtml::submitButton('Cancelar',array('id'=>'btnCancel')); ?>		
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<?php 
?>