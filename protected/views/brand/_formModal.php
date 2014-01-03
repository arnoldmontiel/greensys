<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'brand-form',
	'enableAjaxValidation'=>true,
	'action'=>Yii::app()->createUrl("brand/ajaxCreate")		
)); ?>

  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Agregar Marca</h4>
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
        <button id ="saveBrand" type="button" class="btn btn-primary btn-lg"><i class="fa fa-upload"></i> Cargar</button>
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

$('#saveBrand').unbind('click');
$('#saveBrand').click(function()
		{
		$('#saveBrand').attr('disabled','disabled');
		jQuery.post('<?php 
			if($model->isNewRecord)	echo Yii::app()->createUrl("brand/ajaxCreate");
			else 	echo Yii::app()->createUrl("brand/ajaxUpdate");
			?>', $('#brand-form').serialize(),
						function(data) {
							if(data!=null)
							{	
								if($("#field_caller").val().indexOf("grid")>=0)
								{
									$.fn.yiiGridView.update($("#field_caller").val());
								}
								else
								{
									$("#"+$("#field_caller").val()).prepend(
				  		  					$("<option></option>").val(data.Id).html(data.description)
										);	
								}
								$('#modalPlaceHolder').modal('hide');					
							}	
					},'json'
				);
		
		
		});

</script>

