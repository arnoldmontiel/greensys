<?php 
Yii::app()->clientScript->registerScript(__CLASS__.'#project-service-form', "
		$('#ddl_services').change(function(){
			if($(this).val()!=0)
			{
			$('#saveService').removeAttr('disabled');
			jQuery.post('".Yii::app()->createUrl("project/ajaxGetLongDescription")."', {Id_project:$('#ProjectService_Id_project').val(),Id_service:$(this).val()},
					function(data) {
						if(data!=null)
						{
							$('#ProjectService_long_description').val(data.long_description);
						}
					},'json'
			);
		
			}
			else
			{
						$('#ProjectService_long_description').val('');
					$('#saveService').attr('disabled','disabled');
			}
		});
		$('#saveService').click(function()
		{
			jQuery('#waiting').dialog('open');
			jQuery.post('".Yii::app()->createUrl("project/ajaxSaveServiceLongDescription")."', {Id_project:$('#ProjectService_Id_project').val(),Id_service:$('#ddl_services').val(),long_description:$('#ProjectService_long_description').val()},
					function(data) {
						if(data!=null)
						{
							$('#ProjectService_long_description').val(data.long_description);
						}
						jQuery('#waiting').dialog('close');
					},'json'
			);
					return false;
					
		}
		);
");
?>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'project-service-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>
	
	<?php echo $form->hiddenField($model, 'Id_project'); ?>
	<?php echo $form->hiddenField($model, 'Id_service'); ?>
	
	<?php echo $form->errorSummary($model); ?>
	<div class="row">			
			<?php echo $form->labelEx($model,'Id_service'); ?>
			<?php 
			$list = CHtml::listData(Service::model()->findAll(), 'Id', 'description');
			echo $form->dropDownList($model, 'Id_service', $list,
			array('prompt'=>'Select a Service','id'=>'ddl_services'));
			?>
			<?php echo $form->error($model,'Id_service'); ?>
	</div>	
	<div class="row">			
			<?php echo $form->labelEx($model,'long_description'); ?>
			<?php echo $form->textArea($model,'long_description',array("style"=>"height: 260px; width: 500px;")); ?>
			<?php echo $form->error($model,'long_description'); ?>
	</div>	
	<div class="row">			
			<?php echo CHtml::ajaxButton('Grabar', '', array ( ), array ('id'=>'saveService','disabled'=>'disabled' )); ?>
	</div>	
	
<?php $this->endWidget(); ?>

</div><!-- form -->