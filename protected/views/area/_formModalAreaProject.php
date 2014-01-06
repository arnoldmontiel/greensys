<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'area-project-form',
	'enableAjaxValidation'=>true,
	'action'=>Yii::app()->createUrl("area/ajaxCreateAreaProject")		
)); ?>

  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Editar <?php echo $model->area->description;?></h4>
      </div>
      <div class="modal-body">

  <div class="form-group">
  <?php echo CHtml::hiddenField('field_caller',$field_caller,array('id'=>'field_caller'))?>
  <?php echo $form->hiddenField($model,'Id'); ?>
  <?php echo $form->labelEx($model,'description'); ?>
    <?php echo $form->textField($model,'description',array("class"=>"form-control")); ?>
  </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Cancelar</button>
        <button id ="saveAreaProject" type="button" class="btn btn-primary btn-lg"><i class="fa fa-upload"></i> Cargar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
<?php $this->endWidget(); ?>
<script type="text/javascript">
$("form").bind("keypress", function (e) {
    if (e.keyCode == 13) {
        return false;
    }
});

$('#saveAreaProject').unbind('click');
$('#saveAreaProject').click(function()
		{
		$('#saveAreaProject').attr('disabled','disabled');
		jQuery.post('<?php 
			if($model->isNewRecord)	echo Yii::app()->createUrl("area/ajaxCreateAreaProject");
			else 	echo Yii::app()->createUrl("area/ajaxUpdateAreaProject");
			?>', $('#area-project-form').serialize(),
						function(data) {
							if(data!=null)
							{	
								$("#"+$("#field_caller").val()).html(data.description);
								$('#modalPlaceHolder').modal('hide');					
							}	
					},'json'
				);
		
		
		});

</script>

