<div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title"><?php echo $model->isNewRecord ? 'Crear Importador' : 'Actualizar Importador'; ?></h4>
      </div>
      <div class="modal-body">

<form id="form-new-importer" role="form">
	<?php echo CHtml::activeHiddenField($model, 'Id');?>
	<?php echo CHtml::activeHiddenField($modelContact, 'Id');?>
	<?php echo CHtml::activeHiddenField($modelShippingParameter, 'Id');?>
	<?php echo CHtml::activeHiddenField($modelShippingParameterAir, 'Id');?>
	<?php echo CHtml::activeHiddenField($modelShippingParameterMaritime, 'Id');?>
	<div class="row">
  		<div class="form-group col-sm-4">    
			<?php
				echo CHtml::activeLabelEx($modelContact, 'description'); 
				echo CHtml::activeTextField($modelContact, 'description', array('class'=>'form-control')); 
			?>	  
  		</div>
  		<div class="form-group col-sm-4">
			<?php
				echo CHtml::activeLabelEx($modelContact, 'email'); 
				echo CHtml::activeTextField($modelContact, 'email', array('class'=>'form-control')); 
			?>
		</div>
  		<div class="form-group col-sm-4">
			<?php
				echo CHtml::activeLabelEx($modelContact, 'address'); 
				echo CHtml::activeTextField($modelContact, 'address', array('class'=>'form-control')); 
			?>
		</div>
	</div>
	<div class="row">
  		<div class="form-group col-sm-4">    
			<?php
				echo CHtml::activeLabelEx($modelContact, 'telephone_1'); 
				echo CHtml::activeTextField($modelContact, 'telephone_1', array('class'=>'form-control')); 
			?>	  
  		</div>
  		<div class="form-group col-sm-4">    
			<?php
				echo CHtml::activeLabelEx($modelContact, 'telephone_2'); 
				echo CHtml::activeTextField($modelContact, 'telephone_2', array('class'=>'form-control')); 
			?>	  
  		</div>
  		<div class="form-group col-sm-4">
			<?php
				echo CHtml::activeLabelEx($modelContact, 'telephone_3'); 
				echo CHtml::activeTextField($modelContact, 'telephone_3', array('class'=>'form-control')); 
			?>
		</div>
  	</div>
  	
  	 <div class="row">
  		<div class="form-group col-sm-12">
 			<h4>Configuraci&oacute;n de Env&iacute;o</h4>
 		</div>
  	</div>
  	
    <div class="row">
  		<div class="form-group col-sm-4">
			<?php
				echo CHtml::activeLabelEx($modelShippingParameter, 'description'); 
				echo CHtml::activeTextField($modelShippingParameter, 'description', array('class'=>'form-control')); 
			?>
  		</div>
  		<div class="form-group col-sm-4">    
			<?php
				echo CHtml::activeLabelEx($modelShippingParameter, 'Id_currency'); 
				echo CHtml::activeDropDownList($modelShippingParameter, 'Id_currency', CHtml::listData(
						Currency::model()->findAll(), 'Id', 'short_description'));
			?>	  
  		</div>
  	</div>
  	
  	<div class="row">
  		<div class="col-sm-8 grupoAereo"> 
   			<h4>A&eacute;reo</h4> 
  			<div class="row">
  				<div class="form-group col-sm-6">  
					<?php
						echo CHtml::activeLabelEx($modelShippingParameterAir, 'cost_measurement_unit'); 
						echo CHtml::activeTextField($modelShippingParameterAir, 'cost_measurement_unit', array('class'=>'form-control')); 
					?>
  				</div>
  				<div class="form-group col-sm-3">  
					<?php
						echo CHtml::activeLabelEx($modelShippingParameterAir, 'weight_max'); 
						echo CHtml::activeTextField($modelShippingParameterAir, 'weight_max', array('class'=>'form-control')); 
					?>
  				</div>
  				<div class="form-group col-sm-3">  
					<?php
						echo CHtml::activeLabelEx($modelShippingParameterAir, 'height_max'); 
						echo CHtml::activeTextField($modelShippingParameterAir, 'height_max', array('class'=>'form-control')); 
					?>
  				</div>
  			</div>
  			<div class="row">
  				<div class="form-group col-sm-6">  
					<?php				
						echo CHtml::activeLabelEx($modelShippingParameterAir, 'Id_measurement_unit_cost');
						$measureType = MeasurementType::model()->findByAttributes(array('description'=>'weight'));
						echo CHtml::activeDropDownList($modelShippingParameterAir, 'Id_measurement_unit_cost', CHtml::listData(
		    				MeasurementUnit::model()->findAllByAttributes(array('Id_measurement_type'=>$measureType->Id)), 'Id', 'short_description')); 
					?>
  				</div>
  				<div class="form-group col-sm-3">  
					<?php
						echo CHtml::activeLabelEx($modelShippingParameterAir, 'length_max'); 
						echo CHtml::activeTextField($modelShippingParameterAir, 'length_max', array('class'=>'form-control')); 
					?>
  				</div>
  				<div class="form-group col-sm-3">  
					<?php
						echo CHtml::activeLabelEx($modelShippingParameterAir, 'volume_max'); 
						echo CHtml::activeTextField($modelShippingParameterAir, 'volume_max', array('class'=>'form-control')); 
					?>
  				</div>
  			</div>
  			<div class="row">
  				<div class="form-group col-sm-6">  
					<?php
						echo CHtml::activeLabelEx($modelShippingParameterAir, 'days'); 
						echo CHtml::activeTextField($modelShippingParameterAir, 'days', array('class'=>'form-control')); 
					?>
  				</div>
  				<div class="form-group col-sm-3">  
					<label>Ancho Max</label>
					<input class="form-control" type="text">
					<?php
						echo CHtml::activeLabelEx($modelShippingParameterAir, 'width_max'); 
						echo CHtml::activeTextField($modelShippingParameterAir, 'width_max', array('class'=>'form-control')); 
					?>
  				</div>
  				<div class="form-group col-sm-3">  
					<label>Unidad Max</label>
					<input class="form-control" type="text">
					<?php				
						echo CHtml::activeLabelEx($modelShippingParameterAir, 'Id_measurement_unit_sizes_max');
						$measureType = MeasurementType::model()->findByAttributes(array('description'=>'linear'));
						echo CHtml::activeDropDownList($modelShippingParameterAir, 'Id_measurement_unit_sizes_max', CHtml::listData(
			    			MeasurementUnit::model()->findAllByAttributes(array('Id_measurement_type'=>$measureType->Id)), 'Id', 'short_description')); 
					?>
  				</div>
  			</div>
 		</div>
  		<div class="col-sm-4 grupoMaritimo">  
   			<h4>Maritimo</h4>
  			<div class="form-group">
				<?php
					echo CHtml::activeLabelEx($modelShippingParameterMaritime, 'cost_measurement_unit'); 
					echo CHtml::activeTextField($modelShippingParameterMaritime, 'cost_measurement_unit', array('class'=>'form-control')); 
				?>
  			</div>
  			<div class="form-group">
				<?php				
					echo CHtml::activeLabelEx($modelShippingParameterMaritime, 'Id_measurement_unit_cost');
					$measureType = MeasurementType::model()->findByAttributes(array('description'=>'volume'));
					echo CHtml::activeDropDownList($modelShippingParameterMaritime, 'Id_measurement_unit_cost', CHtml::listData(
		    			MeasurementUnit::model()->findAllByAttributes(array('Id_measurement_type'=>$measureType->Id)), 'Id', 'short_description')); 
				?>
  			</div>
  			<div class="form-group">
				<?php
					echo CHtml::activeLabelEx($modelShippingParameterMaritime, 'days'); 
					echo CHtml::activeTextField($modelShippingParameterMaritime, 'days', array('class'=>'form-control')); 
				?>
  			</div>
 		</div>
 	</div>

</form>
	<div id="status-error" style="display:none;"  class="estadoModal">
	<label for="campoLineal">Estado</label>
      	<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i>
 	No se puede crear un proyecto sin descripción.</div>
 	</div>
      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Cancelar</button>
        <button onclick="save();" type="button" class="btn btn-primary btn-lg"><i class="fa fa-save"></i> Guardar</button>
      </div>
    </div><!-- /.modal-content -->
<script type="text/javascript">

		$("#form-new-importer").submit(function(e)
		{
			<?php if($model->isNewRecord):?>
			    var formURL = "<?php echo ImporterController::createUrl("AjaxSaveNewImporter"); ?>";
			    var formData = new FormData(this);
			<?php else:?>
				var formURL = "<?php echo ImporterController::createUrl("AjaxSaveUpdatedImporter"); ?>";
			    var formData = new FormData(this);
			<?php endif;?>
			
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
		    	$.fn.yiiGridView.update("importer-grid");
		    	$('#myModalFormImporter').trigger('click');
		    	
		    },
		     error: function(jqXHR, textStatus, errorThrown)
		     {
		     }         
		    });
		    e.preventDefault(); //Prevent Default action.
		});
	
	function save()
	{				
		$('#form-new-importer').submit();
	}
</script>
  </div><!-- /.modal-dialog -->