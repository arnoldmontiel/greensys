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
		});

	$.post(
			'".ReviewController::createUrl('AjaxReviewTypeLongDescription')."',
		{
		idReviewType:$(this).val()
	}).success(
		function(data)
		{
			$('#Review_Id_review_type').parent().find('p').html(data);
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


<?php 
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
		'id'=>'review-form',
		'type'=>'horizontal',
		'enableAjaxValidation'=>true,
		'focus'=>array($model,'Id_review_type') 
));

?>
<fieldset>
		<?php echo $form->textFieldRow($model,'review',array('style'=>'width:25px;text-align:center;')); ?>

		<?php
			foreach ($modelReviewType as $item)
			{
				if(isset($item))
				{
					$longDescription= $item['long_description'];
					break;						
				}
			} 
		?>

		<?php 
			$reviewTypes = CHtml::listData($modelReviewType, 'Id', 'description');
			echo $form->dropDownListRow($model, 'Id_review_type', $reviewTypes,array('hint'=>$longDescription));
		?>
	
		<?php echo $form->textFieldRow($model,'description',array('rows'=>1, 'cols'=>140,'maxlength'=>100,'style'=>'resize:none;width:60%;')); ?>
		<?php echo $form->textAreaRow($modelNote,'note',array('rows'=>10, 'cols'=>100,'style'=>'resize:none;width:97%;')); ?>
</fieldset>
		
	<div class="form-actions">
        <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>$model->isNewRecord ? 'Crear' : 'Guardar')); ?>
        <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'reset', 'label'=>'Reset')); ?>
        <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'Cancel','id'=>'btnCancel', 'label'=>'Cancelar')); ?>
	</div>

<?php $this->endWidget(); ?>
