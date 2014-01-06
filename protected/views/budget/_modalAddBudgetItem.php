<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'budget-item-form',
	'enableAjaxValidation'=>true,
	'action'=>Yii::app()->createUrl("budget/ajaxCreateItem")		
)); ?>

    <div class="modal-content">
      <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h4 class="modal-title">Agregar Recargo</h4>
      </div>
      <div class="modal-body">

<form role="form">
  <div class="form-group">
  	    <label for="desc">Descripci&oacute;n</label>    	
<input class="form-control" type="text" name="desc">
</div>
<div class="row">
  <div class="form-group col-sm-3">
  	    <label for="cant">Cantidad</label>    	
<input class="form-control align-right" type="text" value="0.00"  name="cant">
</div>
  <div class="form-group col-sm-3">
  	    <label for="precio">Precio</label>    	
<input class="form-control formHasLabel align-right" type="text" value="0.00"  name=""precio"">USD
</div>
<div class="form-group col-sm-3">
  	    <label for="desc">Descuento</label>    	
<div class="bloqueDescuento"> 
<input  class="form-control inputMed align-right" type="text" value="0.00" name="txtDiscount"><div class="radioTipo"><div class="radio">
				  <label>
				    <input type="radio" value="0" checked="">
				    <div class="usd">%</div>
				  </label>
				</div>
				<div class="radio">
				  <label>
				    <input type="radio"  value="1" >
				    <div class="usd">USD</div>
				  </label>
				</div></div></div>
</div>
  <div class="form-group col-sm-3 align-right">
  	    <label for="precio">Total</label>    	
<span class="label label-primary labelPrecio">0.00 <div class="usd">U$D</div></span>
</div>
</div>
</form>
</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Cancelar</button>
        <button id="saveItem" type="button" id="btn-save-field" onclick="updateField(1066);" class="btn btn-primary btn-lg"><i class="fa fa-plus"></i> Agregar</button>
      </div>
    </div><!-- /.modal-content -->

<?php $this->endWidget(); ?>
<script type="text/javascript">
$("form").bind("keypress", function (e) {
    if (e.keyCode == 13) {
        return false;
    }
});

$('#saveItem').unbind('click');
$('#saveItem').click(function()
		{
		$('#saveItem').attr('disabled','disabled');
		jQuery.post('<?php 	echo Yii::app()->createUrl("area/ajaxCreateItem"); ?>', $('#budget-item-form').serialize(),
						function(data) {
							if(data!=null)
							{	
								$.fn.yiiGridView.update($("#field_caller").val());
								$('#modalPlaceHolder').modal('hide');					
							}	
					},'json'
				);
		
		
		});

</script>

