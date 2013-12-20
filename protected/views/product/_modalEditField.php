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
  		$input = "";
  		$unit = "";
		switch ($field) {
		    case "width":
		        $input = CHtml::activeTextField($modelProduct, $field, array("class"=>"form-control"));
		        $unit = $modelProduct->measurementUnitLinear->short_description;
		        break;
			case "height":
		    	$input = CHtml::activeTextField($modelProduct, $field, array("class"=>"form-control"));
		    	$unit = $modelProduct->measurementUnitLinear->short_description;
		        break;
			case "length":
				$input = CHtml::activeTextField($modelProduct, $field, array("class"=>"form-control"));
				$unit = $modelProduct->measurementUnitLinear->short_description;
		        break;
			case "weight":
				$input = CHtml::activeTextField($modelProduct, $field, array("class"=>"form-control"));
				$unit = $modelProduct->measurementUnitLinear->short_description;
		        break;
	        case "msrp":
	        	$input = CHtml::activeTextField($modelProduct, $field, array("class"=>"form-control"));
	        	$settings = Setting::getInstance();
	        	$currency = '$';
	        	if(isset($settings))
	        		$currency = $settings->currency->short_description;
	        	$unit = $currency;
	        	break;
			case "dealer_cost":
		    	$input = CHtml::activeTextField($modelProduct, $field, array("class"=>"form-control"));
        		$settings = Setting::getInstance();
	        	$currency = '$';
	        	if(isset($settings))
	        		$currency = $settings->currency->short_description;
	        	$unit = $currency;
        		break;
		} 
    ?>
    <label for="campoDealerCost"><?php echo $modelProduct->getAttributeLabel($field) ." (".$unit.")";?></label>
    	<?php echo $input; ?>
  </div>
</form>
</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Cancelar</button>
        <button type="button" id="btn-save-field" onclick="updateField();" class="btn btn-primary btn-lg"><i class="fa fa-save"></i> Guardar</button>
      </div>
    </div><!-- /.modal-content -->
<script type="text/javascript">
    function updateField()
    {
        
    }
    $("#Product_width").keyup(function(){
		return $.isNumeric($(this).val());
	});
</script>
</div><!-- /.modal-dialog -->

<!--END MODAL PEQUE-->

