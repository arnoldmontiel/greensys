<?php
Yii::app()->clientScript->registerScript(__CLASS__.'index-budget', "
	   				
$('#tab-open').click(function(){
	$.ajax({
	   		type: 'POST',
	   		url: '". BudgetController::createUrl('AjaxOpenTabOpen') . "',
	 	}).success(function(data)
	 	{	
	   		$('#tabAbiertos').html(data);
		});
});

$('#tab-waiting').click(function(){
	$.ajax({
	   		type: 'POST',
	   		url: '". BudgetController::createUrl('AjaxOpenTabWaiting') . "',
	 	}).success(function(data)
	 	{	
	   		$('#tabEsperando').html(data);
		});
});
	   				
$('#tab-approved').click(function(){
	$.ajax({
	   		type: 'POST',
	   		url: '". BudgetController::createUrl('AjaxOpenTabApproved') . "',
	 	}).success(function(data)
	 	{	
	   		$('#tabAprobados').html(data);
		});
});

$('#tab-cancelled').click(function(){
	$.ajax({
	   		type: 'POST',
	   		url: '". BudgetController::createUrl('AjaxOpenTabCancelled') . "',
	 	}).success(function(data)
	 	{	
	   		$('#tabCancelados').html(data);
		});
});
");
?>
<script type="text/javascript">

function viewBudget(id, version)
{
	var params = "&id="+id+"&version="+version;
	window.location = "<?php echo BudgetController::createUrl("view")?>" + params; 
	return false;
}

function openNewProject()
{
	//debugger;
	$('#new-project').toggle();
	
	if($('#new-project').is(':visible'))
	{
		$('#Budget_Id_project').attr('disabled','disabled');
		$('#btn-new-project').html(' Cancelar');
		$('#create-project').val(true);
	}
	else
	{
		$('#Budget_Id_project').removeAttr('disabled');
		$('#btn-new-project').html('<i class="fa fa-plus"></i> Nuevo');
		$('#create-project').val(false);
		$('#status-error').hide();
	}
	return false;
}

function openNewBudget()
{
	$.post("<?php echo BudgetController::createUrl('AjaxOpenNewBudget'); ?>"
	).success(
		function(data){
			$('#myModalFormBudget').html(data);
	   		$('#myModalFormBudget').modal('show');	  
		});
}

function editBudget(id,version)
{
	var params = "&id="+id+"&version="+version;
	window.location = "<?php echo BudgetController::createUrl("addItem")?>" + params; 
	return false;
}

function openChangeStateBudget(idBudget, version, newState)
{
	$.post("<?php echo BudgetController::createUrl('AjaxOpenChangeStateBudget'); ?>",
		{
			idBudget:idBudget,
			version:version,
			newState:newState
		}
	).success(
		function(data){
			$('#myModalChangeStateBudget').html(data);
	   		$('#myModalChangeStateBudget').modal('show');	  
		});
	return false;
}

function removeBudget(id, version, grid)
{
	if (confirm('¿Desea borrar este presupuesto?')) 
	{
		$.post("<?php echo BudgetController::createUrl('AjaxDelete'); ?>",
			{
				id:id,
				version:version
			}
		).success(
			function(data){
				$.fn.yiiGridView.update(grid);
				var obj = jQuery.parseJSON(data);				
				if(obj != null)
				{
					$('#tab-open').children().text(obj.openQty);
				}
				
			});
		return false;
	}
	return false;
}

function closeVersion(id, version, grid)
{
	if (confirm('¿Desea cerrar esta versión y enviarla a "Esperando Respuesta"?')) 
	{
		$.post("<?php echo BudgetController::createUrl('AjaxCloseVersion'); ?>",
			{
				id:id,
				version:version
			}
		).success(
			function(data){
				$.fn.yiiGridView.update(grid);
				var obj = jQuery.parseJSON(data);				
				if(obj != null)
				{
					$('#tab-open').children().text(obj.openQty);
					$('#tab-waiting').children().text(obj.waitingQty);
				}
				
			});
		return false;
	}
	return false;	
}

function exportBudget(id, version)
{
	var params = "&id="+id+"&version="+version;
	window.location = "<?php echo BudgetController::createUrl("exportToExcel")?>" + params; 
	return false;
}

function approveBudget(id, version, grid)
{
	if (confirm('¿Desea aprobar el presupuesto?')) 
	{
		$.post("<?php echo BudgetController::createUrl('AjaxApprove'); ?>",
			{
				id:id,
				version:version
			}
		).success(
			function(data){
				$.fn.yiiGridView.update(grid);
				var obj = jQuery.parseJSON(data);				
				if(obj != null)
				{					
					$('#tab-waiting').children().text(obj.waitingQty);
					$('#tab-approved').children().text(obj.approvedQty);
				}
				
			});
		return false;
	}
	return false;
}

</script>
<div class="container" id="screenPresupuestos">
  <h1 class="pageTitle">Presupuestos</h1>
  <div class="row">
    <div class="col-sm-12">
      <ul class="nav nav-tabs">
        <li class="active"><a id="tab-open" href="#tabAbiertos" data-toggle="tab">Abiertos <span class="badge"><?php echo $openQty; ?></span></a></li>
        <li><a id="tab-waiting" href="#tabEsperando" data-toggle="tab">Esperando Respuesta <span class="badge"><?php echo $waitingQty; ?></span></a></li>
        <li><a id="tab-approved" href="#tabAprobados" data-toggle="tab">Aprobados  <span class="badge"><?php echo $approvedQty; ?></span></a></li>
        <li><a id="tab-cancelled" href="#tabCancelados" data-toggle="tab">Cancelados  <span class="badge"><?php echo $cancelledQty; ?></span></a></li>
      </ul>
      <div class="tab-content">
  <div class="tab-pane active" id="tabAbiertos">
  	<?php echo $this->renderPartial('_tabOpen',array('modelBudgets'=>$modelBudgets)); ?>
  </div><!-- /.tab1 --> 
     <div class="tab-pane" id="tabEsperando">
      <?php echo $this->renderPartial('_tabWaiting',array('modelBudgets'=>$modelBudgets)); ?>
      </div><!-- /.tab2 --> 
     <div class="tab-pane" id="tabAprobados">
      <?php echo $this->renderPartial('_tabApproved',array('modelBudgets'=>$modelBudgets)); ?>
      </div><!-- /.tab3 --> 
     <div class="tab-pane" id="tabCancelados">
      <?php echo $this->renderPartial('_tabCancelled',array('modelBudgets'=>$modelBudgets)); ?>
      </div><!-- /.tab4 --> 
      </div><!-- /.tab-content -->
    </div>
    <!-- /.col-sm-12 --> 
  </div>
  <!-- /.row --> 
</div>
<!-- /container --> 




