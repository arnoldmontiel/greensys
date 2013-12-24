<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'supplier-form',
	'enableAjaxValidation'=>true,
	'action'=>Yii::app()->createUrl("supplier/ajaxCreate")		
)); ?>

  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Agregar Marca</h4>
      </div>
      <div class="modal-body">
 
  <?php echo CHtml::hiddenField('field_caller',$field_caller,array('id'=>'field_caller'))?>
      
  <div class="form-group">
    <?php echo $form->labelEx($model,'business_name'); ?>
    <?php echo $form->textField($model,'business_name',array("class"=>"form-control")); ?>
  </div>
  <div class="form-group">
    <?php echo $form->labelEx($modelContact,'description'); ?>
    <?php echo $form->textField($modelContact,'description',array("class"=>"form-control")); ?>
  </div>
  <div class="form-group">
    <?php echo $form->labelEx($modelContact,'telephone_1'); ?>
    <?php echo $form->textField($modelContact,'telephone_1',array("class"=>"form-control")); ?>
  </div>
  <div class="form-group">
    <?php echo $form->labelEx($modelContact,'telephone_2'); ?>
    <?php echo $form->textField($modelContact,'telephone_2',array("class"=>"form-control")); ?>
  </div>
  <div class="form-group">
    <?php echo $form->labelEx($modelContact,'telephone_3'); ?>
    <?php echo $form->textField($modelContact,'telephone_3',array("class"=>"form-control")); ?>
  </div>
  <div class="form-group">
    <?php echo $form->labelEx($modelContact,'email'); ?>
    <?php echo $form->textField($modelContact,'email',array("class"=>"form-control")); ?>
  </div>
  <div class="form-group">
    <?php echo $form->labelEx($modelContact,'address'); ?>
    <?php echo $form->textField($modelContact,'address',array("class"=>"form-control")); ?>
  </div>
  </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Cancelar</button>
        <button id ="saveSupplier" type="button" class="btn btn-primary btn-lg"><i class="fa fa-upload"></i> Cargar</button>
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
$('#saveSupplier').unbind('click');
$('#saveSupplier').click(function()
		{
		$('#saveSupplier').attr('disabled','disabled');
		jQuery.post('<?php echo Yii::app()->createUrl("supplier/ajaxCreate")?>', $('#supplier-form').serialize(),
						function(data) {
							if(data!=null)
							{	
								$("#"+$("#field_caller").val()).prepend(
										$("<option></option>").val(data.Id).html(data.business_name)
								);	
								$('#modalPlaceHolder').modal('hide');					
							}	
					},'json'
				);
		
		
		});

</script>

