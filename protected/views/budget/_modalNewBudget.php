<div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Crear Presupuesto</h4>
      </div>
      <div class="modal-body">

<form id="form-new-budget" role="form">
  <div class="form-group">
    <label for="Id_project">Proyecto</label>
    <?php
    	echo CHtml::activeLabel($model, 'Id_project');
    	echo CHtml::activeDropDownList($model, 'Id_project',
    		CHtml::listData($ddlProjects, 'Id', 'LongDescription'),array('class'=>'form-control'));?>
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
  <div class="form-group col-sm-6 limpiarPadding paddingRight">    
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
  <div class="form-group col-sm-6 limpiarPadding paddingLeft">
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
  <div class="form-group col-sm-6 limpiarPadding paddingRight">
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
  <div class="form-group col-sm-6 limpiarPadding paddingLeft">    
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
</form>

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