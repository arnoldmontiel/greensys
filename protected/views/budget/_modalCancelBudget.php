<!--MODAL PEQUE-->
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Cancelar Presupuesto</h4>
      </div>
      <div class="modal-body">

<form role="form">
  <div class="form-group">
    	<label for="note">Razón</label>
    	<textarea id="budget-note" rows="3" class="form-control" placeholder="Razón de cancelado..."></textarea>
  </div>
</form>
<div id="status-error" style="display:none" class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i>
 Para cancelar, se debe escribir alguna razón.</div>
</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Cancelar</button>
        <button type="button" id="btn-save-field" onclick="cancelBudget(<?php echo $modelBudget->Id; ?>, <?php echo $modelBudget->version_number; ?>);" class="btn btn-primary btn-lg"><i class="fa fa-save"></i> Guardar</button>
      </div>
    </div><!-- /.modal-content -->
<script type="text/javascript">
    function cancelBudget(idBudget, version)
    {
        var note = $("#budget-note").val().trim();
        if(note != '')
        {
        	$('#status-error').hide();
    		$.post("<?php echo ProductController::createUrl('AjaxCancelBudget'); ?>",
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
    				$('#myModalCancelBudget').trigger('click');
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

