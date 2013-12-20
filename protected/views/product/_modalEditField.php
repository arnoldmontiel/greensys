<!--MODAL PEQUE-->
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title"><?php echo $modelProduct->model . " - ". $modelProduct->brand->description . ": " . $modelProduct->getAttributeLabel($field);?></h4>
      </div>
      <div class="modal-body">

<form role="form">
  <div class="form-group">
  	<?php
  		$placeholder = "";
		switch ($field) {
		    case "width":
		        $placeholder = $modelProduct->measurementUnitLinear->short_description;
		        break;
			case "height":
		    	$placeholder = $modelProduct->measurementUnitLinear->short_description;
		        break;
			case "length":
				$placeholder = $modelProduct->measurementUnitLinear->short_description;
		        break;
			case "weight":
				$placeholder = $modelProduct->measurementUnitLinear->short_description;
		        break;
	        case "msrp":
	        	$settings = Setting::getInstance();
	        	$currency = '$';
	        	if(isset($settings))
	        		$currency = $settings->currency->short_description;
	        	$placeholder = $currency;
	        	break;
			case "dealer_cost":
        		$settings = Setting::getInstance();
	        	$currency = '$';
	        	if(isset($settings))
	        		$currency = $settings->currency->short_description;
	        	$placeholder = $currency;
        		break;
		} 
    ?>
    <label for="campoDealerCost"><?php echo $modelProduct->getAttributeLabel($field) ." (".$placeholder.")";?></label>    	
    	<input type="text" class="form-control" onkeyup="validateNumber(this);" id="edit-field" field="<?php echo $field; ?>" placeholder="<?php echo $placeholder; ?>">
  </div>
</form>
</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Cancelar</button>
        <button type="button" id="btn-save-field" onclick="updateField(<?php echo $modelProduct->Id; ?>);" class="btn btn-primary btn-lg"><i class="fa fa-save"></i> Guardar</button>
      </div>
    </div><!-- /.modal-content -->
<script type="text/javascript">
    function updateField(idProduct)
    {
    	$.post("<?php echo ProductController::createUrl('AjaxUpdateProductField'); ?>",
    			{
    				idProduct:idProduct,
    				field:$("#edit-field").attr("field"),
    				value:$("#edit-field").val()
    			}
    		).success(
    			function(data){    				
    				$.fn.yiiGridView.update("product-grid_pending");
    				$('#tab-pending').children().text(data);
    				$('#myModalEditField').trigger('click');
    			});
    		return false;
    }    
</script>
</div><!-- /.modal-dialog -->

<!--END MODAL PEQUE-->

