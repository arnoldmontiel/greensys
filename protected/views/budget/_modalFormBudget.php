<div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title"><?php echo $model->isNewRecord ? 'Crear Presupuesto' : 'Actualizar Presupuesto'; ?></h4>
      </div>
      <div class="modal-body">

<form id="form-new-budget" role="form">
	<?php echo CHtml::hiddenField("save-and-continue",false,array('id'=>'save-and-continue'));?>
	<?php echo CHtml::hiddenField("create-project",false,array('id'=>'create-project'));?>
	<?php echo CHtml::activeHiddenField($model, 'Id');?>
	<?php echo CHtml::activeHiddenField($model, 'version_number');?>
	<?php echo CHtml::activeHiddenField($model, 'Id_currency');?>
  <div class="form-group">
    <?php echo CHtml::activeLabel($model, 'Id_project');?>
    	<div class="combined">
    	<?php 
    		if($model->isNewRecord) 
    		{
    			echo CHtml::activeDropDownList($model, 'Id_project',
    					CHtml::listData($ddlProjects, 'Id', 'LongDescription'),array('class'=>'form-control'));
				echo "<button onclick='openNewProject();' id='btn-new-project' type='button' class='btn btn-default pull-right'><i class='fa fa-plus'></i> Nuevo</button>";
    		}
    		else 
    		{
    			echo "<input type='text' disabled='disabled' class='form-control' value='". $model->project->fullDescription."'";
    		}	
    	?>
  		</div>
  </div>

  <?php if($model->isNewRecord):?>
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
<?php endif;?>
  
  <div class="form-group">
  	<?php 
    	echo CHtml::activeLabel($model, 'description');
    	echo CHtml::activeTextArea($model, 'description', array('class'=>'form-control', 'rows'=>3));
    ?>    
  </div>
  
  <?php if($model->isNewRecord):?>
  <div class="row">
  <div class="form-group col-sm-6">   
  	<?php 
    	echo CHtml::activeLabel($model, 'Id_currency_view');
    	echo CHtml::activeDropDownList($model, 'Id_currency_view',
    					CHtml::listData($ddlCurrency, 'Id', 'description'),array('class'=>'form-control'));
    ?>    
  </div>
  <div class="form-group col-sm-6">   
  </div>
  </div>
  <?php else:?>
  	<?php echo CHtml::activeHiddenField($model, 'Id_currency_view');?>
  <?php endif;?>
  
   <div class="form-group">
  	<?php 
    	echo CHtml::activeLabel($model, 'percent_commission');
    	echo CHtml::activeTextField($model, 'percent_commission', array('class'=>'form-control'));
    ?>    
  </div>
  <div class="row">
  <div class="form-group col-sm-6">   
  	<?php 
    	echo CHtml::activeLabel($model, 'name_commission');
    	echo CHtml::activeTextField($model, 'name_commission', array('class'=>'form-control'));
    ?>    
  </div>
  <div class="form-group col-sm-6">   
  	<?php 
    	echo CHtml::activeLabel($model, 'last_name_commission');
    	echo CHtml::activeTextField($model, 'last_name_commission', array('class'=>'form-control'));
    ?>    
  </div>
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
			 'buttonImageOnly'=>true,
			 'onClose' => 'js:function (selectedDate) { $("#Budget_date_estimated_finalization").datepicker("option", "minDate", selectedDate); }',
	     ),
	     'htmlOptions'=>array(
			'class'=>'form-control formHasClear',
	    ),
		));
	?>
	  <button onclick="$('#Budget_date_estimated_inicialization').val('');return false;" class="clearBT"><i class="fa fa-times-circle"></i></button>   
	
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
			 'buttonImageOnly'=>true,
	     ),
	     'htmlOptions'=>array(
			'class'=>'form-control formHasClear',
	    ),
		));
	?>
	  <button onclick="$('#Budget_date_estimated_finalization').val('');return false;" class="clearBT"><i class="fa fa-times-circle"></i></button>  
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
			 'buttonImageOnly'=>true,
			 'onClose' => 'js:function (selectedDate) { $("#Budget_date_finalization").datepicker("option", "minDate", selectedDate); }',
	     ),
	     'htmlOptions'=>array(
			'class'=>'form-control formHasClear',
	    ),
		));
	?>
	  <button onclick="$('#Budget_date_inicialization').val('');return false;" class="clearBT"><i class="fa fa-times-circle"></i></button>  
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
			 'buttonImageOnly'=>true,
	     ),
	     'htmlOptions'=>array(
			'class'=>'form-control formHasClear',
	    ),
		));
	?>
	  <button onclick="$('#Budget_date_finalization').val('');return false;" class="clearBT"><i class="fa fa-times-circle"></i></button>  
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
        <?php if($model->isNewRecord):?>
        <a onclick="saveAndContinue();" class="btn btn-primary btn-lg"><i class="fa fa-save"></i> Guardar y Agregar Prods.</a>
        <?php endif;?>
      </div>
    </div><!-- /.modal-content -->
<script type="text/javascript">

		$("#form-new-budget").submit(function(e)
		{
			$(".modal-footer button").addClass("disabled");
			$(".modal-footer a").addClass("disabled");
			
			<?php if($model->isNewRecord):?>
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
			<?php else:?>
				var formURL = "<?php echo BudgetController::createUrl("AjaxSaveUpdatedBudget"); ?>";
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
		    	<?php if($model->isNewRecord):?>
			    	var obj = jQuery.parseJSON(data);				
					if(obj != null)
					{
						$('#tab-open').children().text(obj.openQty);
	
						if($('#save-and-continue').val() == "true")
						{
							var params = "&id="+obj.idBudget+"&version="+obj.version;
				    		window.location = "<?php echo BudgetController::createUrl("addItem")?>" + params;
				    		return false;
						}	
					}
					    									    	
			    	
			    	$.fn.yiiGridView.update("budget-grid-open");
			    	$('#myModalFormBudget').trigger('click');
			    <?php else:?>
				    var obj = jQuery.parseJSON(data);				
					if(obj != null)
					{
						$('#header-budget-description').text(obj.description);
						$('#header-budget-version-number').text(obj.version_number);
						$('#header-budget-date-est-init').text(obj.date_estimated_inicialization);
						$('#header-budget-date-est-fin').text(obj.date_estimated_finalization);
					}
			    	$('#myModalFormBudget').trigger('click');
			    <?php endif;?>
		    	
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
	function saveAndContinue()
	{
		$('#save-and-continue').val(true);
		$('#form-new-budget').submit();
	}
</script>
  </div><!-- /.modal-dialog -->