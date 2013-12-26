<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'nomenclator-form',
	'enableAjaxValidation'=>true,
	'action'=>Yii::app()->createUrl("nomenclator/ajaxCreate")		
)); ?>

  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Agregar Nomenclador</h4>
      </div>
      <div class="modal-body">

  <div class="form-group">
  <?php echo CHtml::hiddenField('field_caller',$field_caller,array('id'=>'field_caller'))?>
    <?php echo $form->labelEx($model,'description'); ?>
    <?php echo $form->textField($model,'description',array("class"=>"form-control")); ?>
  </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Cancelar</button>
        <button id ="saveNomenclator" type="button" class="btn btn-primary btn-lg"><i class="fa fa-upload"></i> Cargar</button>
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

$('#saveNomenclator').unbind('click');
$('#saveNomenclator').click(function()
		{
		$('#saveNomenclator').attr('disabled','disabled');
		jQuery.post('<?php echo Yii::app()->createUrl("nomenclator/ajaxCreate")?>', $('#nomenclator-form').serialize(),
						function(data) {
							if(data!=null)
							{	
								$("#"+$("#field_caller").val()).prepend(
		  		  					$("<option></option>").val(data.Id).html(data.description)
								);	
								$('#modalPlaceHolder').modal('hide');					
							}	
					},'json'
				);
		
		
		});

</script>

