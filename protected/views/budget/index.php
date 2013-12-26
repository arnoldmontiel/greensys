<script type="text/javascript">

function openNewBudget()
{
	$.post("<?php echo ProductController::createUrl('AjaxOpenNewBudget'); ?>"
	).success(
		function(data){
			$('#myModalNewBudget').html(data);
	   		$('#myModalNewBudget').modal('show');	  
		});
}
function editBudget(id)
{
	var params = "&id="+id;
	window.location = "<?php echo BudgetController::createUrl("editBudget")?>" + params; 
	return false;
}
</script>
<div class="container" id="screenPresupuestos">
  <h1 class="pageTitle">Presupuestos</h1>
  <div class="row">
    <div class="col-sm-12">
      <ul class="nav nav-tabs">
        <li class="active"><a href="#tabAbiertos" data-toggle="tab">Abiertos <span class="badge">10</span></a></li>
        <li><a href="#tabEsperando" data-toggle="tab">Esperando Respuesta <span class="badge">4</span></a></li>
        <li><a href="#tabAprobados" data-toggle="tab">Aprobados  <span class="badge">200</span></a></li>
        <li><a href="#tabCancelados" data-toggle="tab">Cancelados  <span class="badge">3</span></a></li>
      </ul>
      <div class="tab-content">
  <div class="tab-pane active" id="tabAbiertos">
  	<?php echo $this->renderPartial('_tabOpen'); ?>
  </div><!-- /.tab1 --> 
     <div class="tab-pane" id="tabEsperando">
      <?php echo $this->renderPartial('_tabWaiting'); ?>
      </div><!-- /.tab2 --> 
     <div class="tab-pane" id="tabAprobados">
      <?php echo $this->renderPartial('_tabApprobed'); ?>
      </div><!-- /.tab3 --> 
     <div class="tab-pane" id="tabCancelados">
      <?php echo $this->renderPartial('_tabCancelled'); ?>
      </div><!-- /.tab4 --> 
      </div><!-- /.tab-content -->
    </div>
    <!-- /.col-sm-12 --> 
  </div>
  <!-- /.row --> 
</div>
<!-- /container --> 
