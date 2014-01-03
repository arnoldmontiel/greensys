<!--MODAL PEQUE-->
<?php 
$title = "Cancelar Presupuesto";
$placeholder =  "Razón de cancelado...";
$function = "cancelBudget(". $modelBudget->Id.", ".$modelBudget->version_number.");";

if($newState == 1 )
{
	$title = "Re-abrir Presupuesto";
	$placeholder =  "Razón de re-apertura...";
	$function = "reopenBudget(". $modelBudget->Id.", ".$modelBudget->version_number.");";
}

?>
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title"><?php echo $title; ?></h4>
      </div>
      <div class="modal-body">

<form role="form">
  <div class="form-group">
    	<label for="note">Razón</label>
    	<textarea id="budget-note" rows="3" class="form-control" placeholder="<?php echo $placeholder; ?>"></textarea>
  </div>
</form>

<div id="status-error" style="display:none;"  class="estadoModal">
	<label for="campoLineal">Estado</label>
      	<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i>
 	Para grabar, se debe escribir alguna razón.</div>
 	</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Cancelar</button>
        <button type="button" id="btn-save-field" onclick="<?php echo $function; ?>" class="btn btn-primary btn-lg"><i class="fa fa-save"></i> Guardar</button>
      </div>
    </div><!-- /.modal-content -->
<script type="text/javascript">
    function cancelBudget(idBudget, version)
    {
        var note = $("#budget-note").val().trim();
        if(note != '')
        {
        	$('#status-error').hide();
    		$.post("<?php echo BudgetController::createUrl('AjaxCancelBudget'); ?>",
    			{
    				idBudget:idBudget,
    				version:version,
    				note:$("#budget-note").val()
    			}
    		).success(
    			function(data){    				    				
    				var obj = jQuery.parseJSON(data);				
    				if(obj != null)
    				{
    					$('#tab-cancelled').children().text(obj.cancelledQty);
    					$('#tab-waiting').children().text(obj.waitingQty);
    				}
    				$.fn.yiiGridView.update("budget-grid-waiting");
    				$('#myModalChangeStateBudget').trigger('click');
    			});
        }
        else
        {
        	$('#status-error').show();
        }
    		return false;
    }    

    function reopenBudget(idBudget, version)
    {
        var note = $("#budget-note").val().trim();
        if(note != '')
        {
        	$('#status-error').hide();
    		$.post("<?php echo BudgetController::createUrl('AjaxReOpen'); ?>",
    			{
    				id:idBudget,
					version:version,
    				note:$("#budget-note").val()
    			}
    		).success(
    			function(data){    				    				
    				var obj = jQuery.parseJSON(data);				
    				if(obj != null)
    				{
    					$('#tab-open').children().text(obj.openQty);
    					$('#tab-waiting').children().text(obj.waitingQty);
    					$('#tab-cancelled').children().text(obj.cancelledQty);
    				}
    				$.fn.yiiGridView.update("budget-grid-waiting");
    				$.fn.yiiGridView.update("budget-grid-cancelled");
    				$('#myModalChangeStateBudget').trigger('click');
    			});
        }
        else
        {
        	$('#status-error').show();
        }
    		return false;
    }
</script>
</div><!-- /.modal-dialog -->

<!--END MODAL PEQUE-->

