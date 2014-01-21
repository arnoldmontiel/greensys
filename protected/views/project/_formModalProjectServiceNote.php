<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'project-service-form',
	'enableAjaxValidation'=>true,
	'action'=>Yii::app()->createUrl("project/ajaxCreateProjectService")		
)); ?>

  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Editar Descripci&oacute;n de Servicio</h4>
      </div>
      <div class="modal-body">

  <div class="form-group">
  <?php echo CHtml::hiddenField('field_caller',$field_caller,array('id'=>'field_caller'))?>
  <?php echo $form->hiddenField($model,'Id_project'); ?>
  <?php echo $form->hiddenField($model,'Id_service'); ?>
  <?php echo $form->labelEx($model,'note'); ?>
    <?php echo $form->textarea($model,'note',array("class"=>"form-control","rows"=>12)); ?>
  </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Cancelar</button>
        <button id ="saveProjectService" type="button" class="btn btn-primary btn-lg"><i class="fa fa-save"></i> Guardar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
<?php $this->endWidget(); ?>
<script type="text/javascript">

$('#saveProjectService').unbind('click');
$('#saveProjectService').click(function()
		{
		$('#saveProjectService').attr('disabled','disabled');
		jQuery.post('<?php 
			if($model->isNewRecord)	echo Yii::app()->createUrl("project/ajaxCreateProjectService");
			else 	echo Yii::app()->createUrl("project/ajaxUpdateProjectService");
			?>', $('#project-service-form').serialize(),
						function(data) {
							if(data!=null)
							{	
								if($("#field_caller").val().indexOf("grid")>=0)
								{
									$.fn.yiiGridView.update($("#field_caller").val());
								}
								else
								{
									$("#"+$("#field_caller").val()).html(data.description);
								}
								$('#modalPlaceHolder').modal('hide');					
							}	
					},'json'
				);
		
		
		});

</script>

