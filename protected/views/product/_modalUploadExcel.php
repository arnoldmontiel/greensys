<!--MODAL EXCEL-->
<div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <?php 
	        if($isUpdate)
	        	echo "<h4 class='modal-title'>Actualizar Excel: ".$modelProductImportLog->brand->description."</h4>";
	        else 
				echo "<h4 class='modal-title'>Cargar Nuevo Excel</h4>";
		?>        
      </div>
      <div class="modal-body">
    
<form id="form-upload-excel" role="form" action="<?php echo ProductController::createUrl("AjaxUploadProductExcel"); ?>">
  <div class="form-group">
    <label for="campoArchivo">Archivo</label>
    <?php				
		echo CHtml::activeFileField($modelExcel, 'file'); 
	?>
  </div>
  <div class="form-group">
    <label for="Id_brand">Marca</label>
    <?php				
		echo CHtml::activeDropDownList($modelProductImportLog, 'Id_brand', 
		CHtml::listData($ddlBrand, 'Id', 'description')); 
	?>
  </div>
  <div class="form-group">
    <label for="Id_measurement_unit_weight">Unidad de Peso</label>
    <?php
    	echo CHtml::activeDropDownList($modelProductImportLog, 'Id_measurement_unit_weight', 
		CHtml::listData($ddlMeasurementUnitWeight, 'Id', 'short_description'));
	?>
  </div>
  <div class="form-group">
    <label for="Id_measurement_unit_linear">Unidad Lineal</label>
    <?php				
		echo CHtml::activeDropDownList($modelProductImportLog, 'Id_measurement_unit_linear', 
		CHtml::listData($ddlMeasurementUnitLinear, 'Id', 'short_description')); 
	?>
  </div>
</form>

<!--Esto aparece una vez que le das Cargar-->
<div id="status-wait" style="display:none;" class="estadoModal">
    <label for="campoLineal">Estado</label>
<div class="alert alert-info"><i class="fa fa-spinner fa-spin"></i>
 <span><strong>Analizando archivo</strong>, espere por favor.</span>
 </div>
 </div>
 
 <div id="status-error" style="display:none;" class="estadoModal">
 <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i>
 <span><strong>Se ha producido un error</strong>, revise el archivo e int�ntelo nuevamente.</span>
 </div>
 </div>
 
 <div id="status-success" style="display:none;" class="estadoModal">
 <div class="alert alert-success"><i class="fa fa-check"></i>
 <span><strong>La carga fue correcta.</strong></span>
 </div>
 </div>
 
<!--Fin notificacion-->


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Cerrar</button>
        <button type="button" id="btn-upload" onclick="uploadFile();" class="btn btn-primary btn-lg"><i class="fa fa-upload"></i> Cargar</button>
      </div>
    </div><!-- /.modal-content -->
<script type="text/javascript">

		$("#form-upload-excel").submit(function(e)
		{
		    var formObj = $(this);
		    var formURL = formObj.attr("action");
		    var formData = new FormData(this);
			var selectedBrand = $('#ProductImportLog_Id_brand').val();

			var file = $('#UploadExcel_file').val();

			if(file == "")
			{
				$('#status-error .alert span').text("No se selecciono ningun archivo.");
				$('#status-wait').hide();
				$('#status-error').show();
				$('#btn-upload').removeAttr('disabled');
				return false;
			}

			var extension = file.substr( (file.lastIndexOf('.') +1) ).toLowerCase();

			if(extension != "xls" && extension != "xlsx")
			{
				$('#status-error .alert span').text("La extensiones permitidas son 'xls' o 'xlsx'.");
				$('#status-wait').hide();
				$('#status-error').show();
				$('#btn-upload').removeAttr('disabled');
				return false;
			}
			
		    $.ajax({
		        url: formURL,
		    type: 'POST',
		        data:  formData,
		    mimeType:"multipart/form-data",
		    contentType: false,
		        cache: false,
		        processData:false,
		    success: function(data, textStatus, jqXHR)
		    {
		    	$('#status-wait').hide();
		    	$('#status-success').show();
		    	$.fn.yiiGridView.update("product-grid_brand");
		    	$('#tab-pending').children().text(data);
		    	$('#btn-upload').removeAttr('disabled');
				
		    	<?php if($isUpdate): ?> 		    		
		    	 	setTimeout(function () {
		    	 		$('#myModalUploadExcel').trigger('click');
		    	    }, 3000);		    				    		
		    	<?php else: ?> 
		    		$("#ProductImportLog_Id_brand option[value='"+selectedBrand+"']").remove();
		    		$('#btn-upload').removeAttr('disabled');
		    	<?php endif; ?>
		    },
		     error: function(jqXHR, textStatus, errorThrown)
		     {
		    	$('#status-wait').hide();
			    $('#status-error').show();			    
			    $('#btn-upload').removeAttr('disabled');
		     }         
		    });
		    e.preventDefault(); //Prevent Default action.
		});
	
	function uploadFile()
	{		
		$('#btn-upload').attr('disabled','disabled');
		$('#status-success').hide();
		$('#status-error').hide();
		$('#status-wait').show();		
		$('#form-upload-excel').submit();
	}
</script>
</div><!-- /.modal-dialog -->
<!--END MODAL EXCEL-->
