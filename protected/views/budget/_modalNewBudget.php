<div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Crear Presupuesto</h4>
      </div>
      <div class="modal-body">

<form id="form-new-budget" role="form">
	<?php echo CHtml::hiddenField("create-project",false,array('id'=>'create-project'));?>
  <div class="form-group">
    <?php echo CHtml::activeLabel($model, 'Id_project');?>
    	<div class="combined">
    	<?php
    		echo CHtml::activeDropDownList($model, 'Id_project',
    			CHtml::listData($ddlProjects, 'Id', 'LongDescription'),array('class'=>'form-control'));
		?>
    		<button onclick="openNewProject();" id="btn-new-project" type="button" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Nuevo</button>
  		</div>
  </div>

<div id="new-project" class="inlineForm" style="display:none">
<label>Nuevo Proyecto</label>
	<table class="table">
		<tr>
			<td style="width:33%"><div>Cliente</div>			
			<?php
    		echo CHtml::activeDropDownList($modelProject, 'Id_customer',
    				CHtml::listData($ddlCustomer, 'Id', 'Description'),array('class'=>'form-control'));?>
			</td>
			<td style="width:33%"><div>Descripcion</div>
				<?php echo CHtml::activeTextField($modelProject, 'description', array('class'=>'form-control')); ?>
			</td>
			<td style="width:33%"><div>Direcci&oacute;n</div>
				<?php echo CHtml::activeTextField($modelProject, 'address', array('class'=>'form-control')); ?>
			</td>
		</tr>
	</table>
</div>

  <div class="form-group">    
    <?php 
    	echo CHtml::activeLabel($model, 'percent_discount');
    	echo CHtml::activeTextField($model, 'percent_discount', array('class'=>'form-control', 'onkeyup'=>'validateNumber(this);'));    	
    ?>
  </div>
  <div class="form-group">
  	<?php 
    	echo CHtml::activeLabel($model, 'description');
    	echo CHtml::activeTextArea($model, 'description', array('class'=>'form-control', 'rows'=>3));
    ?>    
  </div>
  <div class="row">
  <div class="form-group col-sm-6">    
	<?php 
 		echo CHtml::activeLabel($model, 'date_estimated_inicialization');
 		$this->widget('zii.widgets.jui.CJuiDatePicker', array(
	     // additional javascript options for the date picker plugin
 		'language'=>'es',
 		'model'=>$model,
 		'attribute'=>'date_estimated_inicialization',
 		'options'=>array(
	         'showAnim'=>'fold',
	     ),
	     'htmlOptions'=>array(
			'class'=>'form-control',
	    ),
		));
	?>
  </div>
  <div class="form-group col-sm-6">
	<?php 
 		echo CHtml::activeLabel($model, 'date_estimated_finalization');
 		$this->widget('zii.widgets.jui.CJuiDatePicker', array(
	     // additional javascript options for the date picker plugin
 		'language'=>'es',
 		'model'=>$model,
 		'attribute'=>'date_estimated_finalization',
 		'options'=>array(
	         'showAnim'=>'fold',
	     ),
	     'htmlOptions'=>array(
			'class'=>'form-control',
	    ),
		));
	?>
  </div>
  <div class="form-group col-sm-6 noMargin">
	<?php 
 		echo CHtml::activeLabel($model, 'date_inicialization');
 		$this->widget('zii.widgets.jui.CJuiDatePicker', array(
	     // additional javascript options for the date picker plugin
 		'language'=>'es',
 		'model'=>$model,
 		'attribute'=>'date_inicialization',
 		'options'=>array(
	         'showAnim'=>'fold',
	     ),
	     'htmlOptions'=>array(
			'class'=>'form-control',
	    ),
		));
	?>
  </div>
  <div class="form-group col-sm-6 noMargin">    
	<?php 
 		echo CHtml::activeLabel($model, 'date_finalization');
 		$this->widget('zii.widgets.jui.CJuiDatePicker', array(
	     // additional javascript options for the date picker plugin
 		'language'=>'es',
 		'model'=>$model,
 		'attribute'=>'date_finalization',
 		'options'=>array(
	         'showAnim'=>'fold',
	     ),
	     'htmlOptions'=>array(
			'class'=>'form-control',
	    ),
		));
	?>
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
        <a href="crearPresupuesto.php" class="btn btn-primary btn-lg"><i class="fa fa-save"></i> Guardar y Agregar Prods.</a>
      </div>
    </div><!-- /.modal-content -->
<script type="text/javascript">

		$("#form-new-budget").submit(function(e)
		{
		    var formURL = "<?php echo BudgetController::createUrl("AjaxSaveNewBudget"); ?>";
		    var formData = new FormData(this);

			if($('#create-project').val() == "true")				
			{
				if($('#Project_description').val().trim() == "")
				{
					$('#status-error').show();
					return false;
				}
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
		    	$.fn.yiiGridView.update("budget-grid-open");
		    	$('#myModalNewBudget').trigger('click');
		    	$('#tab-open').children().text(data);
		    },
		     error: function(jqXHR, textStatus, errorThrown)
		     {
		     }         
		    });
		    e.preventDefault(); //Prevent Default action.
		});
	
	function save()
	{				
		$('#form-new-budget').submit();
	}
</script>
  </div><!-- /.modal-dialog -->