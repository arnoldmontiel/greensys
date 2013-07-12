<?php 
Yii::app()->clientScript->registerScript(__CLASS__.'#review-form-create', "
	function  AutoSave()
	{
		$('.errors').hide();
		$('.saved').hide();		
		$('.saving').show();		
		$.post(
			'".ReviewController::createUrl('AjaxAutoSave')."',$('#review-form').serialize()
		).success(
		function(data)
		{
			$('.errors').hide();
			$('.saving').hide();
			$('.saved').show();
		}).error(function(){
			$('.saving').hide();
			$('.saved').hide();
			$('.errors').show();
		});		
	}
	$('input').keyup(function(){AutoSave()});
	$('textarea').keyup(function(){AutoSave()});
					
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
				AutoSave();
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
					
		$.post(
			'".ReviewController::createUrl('AjaxDelete')."',{id:$('#Review_Id').val()}
		).success(
		function(data)
		{
			window.location = '".ReviewController::createUrl('index',array('Id_customer'=>$model->Id_customer,'Id_project'=>$model->Id_project))."';					
		});		
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
echo CHtml::openTag('div',array('class'=>'view-text-note-actions'));
echo CHtml::image('images/saving_note.gif','saving',array('style'=>'display:none;','title'=>'Grabando','class'=>'action-show-saving-note saving'));
echo CHtml::image('images/saving_note_error.png','error',array('style'=>'display:none;width:14px;','title'=>'Problemas al grabar','class'=>'action-show-saving-note errors'));
echo CHtml::image('images/saving_note_ok.png','error',array('style'=>'display:none;width:14px;','title'=>'Grabado','class'=>'action-show-saving-note saved'));
echo CHtml::closeTag('div');
?>

<fieldset>
		<?php echo $form->hiddenField($model,'Id'); ?>
		<?php echo $form->hiddenField($modelNote,'Id'); ?>
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
