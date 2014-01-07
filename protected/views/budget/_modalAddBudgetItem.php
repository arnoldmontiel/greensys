<?php 
$settings = new Settings();
?>
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h4 class="modal-title">Agregar Recargo</h4>
      </div>
      <div class="modal-body">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'budget-item-form',
	'enableAjaxValidation'=>true,
	'action'=>Yii::app()->createUrl("budget/ajaxCreateItem")		
)); ?>		
  	    <?php echo CHtml::hiddenField("field_caller",$field_caller); ?>
		<?php echo $form->hiddenField($model,'Id_budget'); ?>
  	    <?php echo $form->hiddenField($model,'version_number'); ?>
  	    <div class="form-group">
  	    <label for="desc">Descripci&oacute;n</label>    	
  	    <?php echo $form->textField($model,'description',array("class"=>"form-control")); ?>
</div>
<div class="row">
  <div class="form-group col-sm-3">
  	    <label for="cant">Cantidad</label>    	
  	    <?php echo $form->textField($model,'quantity',array("class"=>"form-control formHasLabel align-right","onchange"=>"changingQuantity(this);")); ?>
</div>
  <div class="form-group col-sm-3">
  	    <label for="precio">Precio</label>  
  	    <?php echo $form->textField($model,'price',array("class"=>"form-control formHasLabel align-right","onchange"=>"changingPrice(this);")); ?><?php echo $settings->getCurrencyShortDescription()?>
</div>
<div class="form-group col-sm-3">
  	    <label for="desc">Descuento</label>    	
<div class="bloqueDescuento"> 
  	    <?php echo $form->textField($model,'discount',array("class"=>"form-control inputMed align-right","onchange"=>"changingDiscount(this);")); ?>
<div class="radioTipo"><div class="radio">
				  <label>
				    <input name="BudgetItem[discount_type]" type="radio" value="0" checked onclick="changingDiscountType(this);">
				    <div class="usd">%</div>
				  </label>
				</div>
				<div class="radio">
				  <label>
				    <input name="BudgetItem[discount_type]" type="radio"  value="1" onclick="changingDiscountType(this);">
				    <div class="usd"><?php echo $settings->getCurrencyShortDescription()?></div>
				  </label>
				</div></div></div>
</div>
  <div class="form-group col-sm-3 align-right">
  	    <label for="precio">Total</label>    	
<span class="label label-primary labelPrecio"><span id="total_price_w_discount">0.00</span> <div class="usd"><?php echo " ".$settings->getCurrencyShortDescription()?></div></span>
</div>
</div>
<?php $this->endWidget(); ?>

</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Cancelar</button>
        <button id="saveItem" type="button" id="btn-save-field" class="btn btn-primary btn-lg"><i class="fa fa-plus"></i> Agregar</button>
      </div>
    </div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
    
<script type="text/javascript">
$("form").bind("keypress", function (e) {
    if (e.keyCode == 13) {
        return false;
    }
});
function changingDiscountType(object)
{
	validateNumber(object);
	jQuery.post('<?php 	echo Yii::app()->createUrl("budget/ajaxGetTotalPrice"); ?>', $('#budget-item-form').serialize(),
			function(data) {
				if(data!=null)
				{	
					$("#total_price_w_discount").html(data.total_price);
				}	
		},'json'
	);
}
function changingQuantity(object)
{
	validateNumber(object);
	jQuery.post('<?php 	echo Yii::app()->createUrl("budget/ajaxGetTotalPrice"); ?>', $('#budget-item-form').serialize(),
			function(data) {
				if(data!=null)
				{	
					$("#total_price_w_discount").html(data.total_price);
				}	
		},'json'
	);
}
function changingPrice(object)
{
	validateNumber(object);
	jQuery.post('<?php 	echo Yii::app()->createUrl("budget/ajaxGetTotalPrice"); ?>', $('#budget-item-form').serialize(),
			function(data) {
				if(data!=null)
				{	
					$("#total_price_w_discount").html(data.total_price);
				}	
		},'json'
	);
}
function changingDiscount(object)
{
	validateNumber(object);
	jQuery.post('<?php 	echo Yii::app()->createUrl("budget/ajaxGetTotalPrice"); ?>', $('#budget-item-form').serialize(),
			function(data) {
				if(data!=null)
				{	
					$("#total_price_w_discount").html(data.total_price);
				}	
		},'json'
	);
}

$('#saveItem').unbind('click');
$('#saveItem').click(function()
		{
		$('#saveItem').attr('disabled','disabled');
		jQuery.post('<?php 	echo Yii::app()->createUrl("budget/ajaxCreateItem"); ?>', $('#budget-item-form').serialize(),
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

