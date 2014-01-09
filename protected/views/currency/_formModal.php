<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'currency-form',
	'enableAjaxValidation'=>true,
	'action'=>Yii::app()->createUrl("currency/ajaxCreate")		
)); ?>

  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title"><?php echo ($model->isNewRecord)?'Agregar Moneda':'Editar Moneda'; ?></h4>
      </div>
      <div class="modal-body">

  <div class="form-group">
  <?php echo CHtml::hiddenField('field_caller',$field_caller,array('id'=>'field_caller'))?>
  <?php echo $form->hiddenField($model,'Id'); ?>
  		<?php echo $form->labelEx($model,'short_description'); ?>
		<?php echo $form->textField($model,'short_description',array("class"=>"form-control")); ?>	
  </div>
  <div class="form-group">
  		<?php echo $form->labelEx($model,'description'); ?>
    	<?php echo $form->textField($model,'description',array("class"=>"form-control")); ?>		
	</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Cancelar</button>        
        <button onclick="saveCurrency()" id="btn-save-currency" type="button" class="btn btn-primary btn-lg"><i class="fa fa-save"></i> Guardar</button>
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

function saveCurrency()
{
	$('#btn-save-currency').attr('disabled','disabled');
	jQuery.post('<?php 
		if($model->isNewRecord)	echo Yii::app()->createUrl("currency/ajaxCreate");
		else 	echo Yii::app()->createUrl("currency/ajaxUpdate");
		?>', $('#currency-form').serialize(),
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
}
</script>

