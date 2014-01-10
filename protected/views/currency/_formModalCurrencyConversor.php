<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'currency-conversor-form',
	'enableAjaxValidation'=>true,
	'action'=>Yii::app()->createUrl("currency/ajaxCreateCurrencyConversor")		
)); ?>

  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title"><?php echo ($model->isNewRecord)?'Agregar Cotizaci&oacute;n':'Editar Cotizaci&oacute;n: '.$model->currencyFrom->description ?></h4>
      </div>
      <div class="modal-body">

  <div class="form-group">
  <?php echo $form->hiddenField($model,'Id_currency_from'); ?>
  <?php echo $form->textField($modelCurrencyFrom, 'description',array('class'=>'form-control','disabled'=>'disabled'));
      ?>
  </div>
      <div class="form-group">
      <?php echo CHtml::activeDropDownList($model, 'Id_currency_to',
    					CHtml::listData($ddlCurrency, 'Id', 'description'),array('class'=>'form-control'));
      ?>
  </div>
  <div class="form-group">
  <?php echo CHtml::hiddenField('field_caller',$field_caller,array('id'=>'field_caller'))?>
  <?php echo $form->hiddenField($model,'Id'); ?>
  <?php echo $form->labelEx($model,'factor'); ?>
  <?php echo $form->textField($model,'factor',array("class"=>"form-control")); ?>	
  </div>
  <div class="form-group">
    <div class="form-group col-sm-6">
  
  <?php echo $form->labelEx($model,'date_validity'); ?>
  <?php 
 		echo CHtml::activeLabel($model, 'validity_date');
 		$this->widget('zii.widgets.jui.CJuiDatePicker', array(
	     // additional javascript options for the date picker plugin
 		'language'=>'es',
 		'model'=>$model,
 		'attribute'=>'validity_date',
 		'options'=>array(
	         'showAnim'=>'fold',
			 'buttonImageOnly'=>true,
	     ),
	     'htmlOptions'=>array(
			'class'=>'form-control formHasClear',
	    ),
		));
	?>
	  <button onclick="$('#CurrencyConversor_validity_date').val('');return false;" class="clearBT"><i class="fa fa-times-circle"></i></button>
	    </div>	    	
  </div>
  </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Cancelar</button>        
        <button onclick="saveCurrencyConversor()" id="btn-save-currency-conversor" type="button" class="btn btn-primary btn-lg"><i class="fa fa-save"></i> Guardar</button>
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

function saveCurrencyConversor()
{
	$('#btn-save-currency-conversor').attr('disabled','disabled');
	jQuery.post('<?php 
		if($model->isNewRecord)	echo Yii::app()->createUrl("currency/ajaxCreateCurrencyConversor");
		else 	echo Yii::app()->createUrl("currency/ajaxUpdateCurrencyConversor");
		?>', $('#currency-conversor-form').serialize(),
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

