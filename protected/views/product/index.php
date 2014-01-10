<?php
Yii::app()->clientScript->registerScript(__CLASS__.'index-product', "
	   				
$('#tab-brand').click(function(){
	$.ajax({
	   		type: 'POST',
	   		url: '". ProductController::createUrl('AjaxOpenTabByBrand') . "',
	 	}).success(function(data)
	 	{	
	   		$('#tabPorMarca').html(data);
		});
});

$('#tab-all').click(function(){
	$.ajax({
	   		type: 'POST',
	   		url: '". ProductController::createUrl('AjaxOpenTabByAll') . "',
	 	}).success(function(data)
	 	{	
	   		$('#tabTodos').html(data);
		});
});
	   				
$('#tab-pending').click(function(){
	$.ajax({
	   		type: 'POST',
	   		url: '". ProductController::createUrl('AjaxOpenTabByPending') . "',
	 	}).success(function(data)
	 	{	
	   		$('#tabPendientes').html(data);
		});
});

");
?>
<script type="text/javascript">

function openExcelLoader()
{
	$.post("<?php echo ProductController::createUrl('AjaxOpenExcelLoader'); ?>"
	).success(
		function(data){
			$('#myModalUploadExcel').html(data);
	   		$('#myModalUploadExcel').modal('show');	  
		});
}

function openEditField(idProduct, field)
{
	$.post("<?php echo ProductController::createUrl('AjaxOpenEditField'); ?>",
		{
			idProduct:idProduct,
			field:field
		}
	).success(
		function(data){
			$('#myModalEditField').html(data);
	   		$('#myModalEditField').modal('show');	  
		});
	return false;
}
function downloadExcel(idProductImport)
{
	var param = "&id="+idProductImport;
	window.location = "<?php echo ProductController::createUrl('ExportToExcel'); ?>" + param;
	return false;
}

function updateExcel(idBrand)
{
	$.post("<?php echo ProductController::createUrl('AjaxOpenExcelUpdate'); ?>",
		{
			idBrand:idBrand
		}
	).success(
		function(data){
			$('#myModalUploadExcel').html(data);
	   		$('#myModalUploadExcel').modal('show');	  
		});
}

function removeProduct(idProduct, grid)
{
	if (confirm("¿Está seguro de eliminar este producto?")) 
	{
		$.post("<?php echo ProductController::createUrl('AjaxDelete'); ?>",
			{
				idProduct:idProduct
			}
		).success(
			function(data){
				$.fn.yiiGridView.update(grid);
				$('#tab-pending').children().text(data);
			});
		return false;
	}
	return false;
}
</script>
<div class="container" id="screenProductos">
  <h1 class="pageTitle">Productos</h1>
  <div class="row">
    <div class="col-sm-12">
      <ul class="nav nav-tabs">
        <li class="active"><a id="tab-all" href="#tabTodos" data-toggle="tab">Todos</a></li>
        <li><a id="tab-pending" href="#tabPendientes" data-toggle="tab">Datos Incompletos <span class="badge"><?php echo $pendingQty; ?></span></a></li>
        <li><a id="tab-brand" href="#tabPorMarca" data-toggle="tab">Archivos Excel </a></li>
      </ul>
      <div class="tab-content">
	  	  <div class="tab-pane active" id="tabTodos">
	  	  	<?php echo $this->renderPartial('_tabByAll',array('modelProducts'=>$modelProducts)); ?>
	      </div><!-- /.tab1 --> 
	      <div class="tab-pane" id="tabPendientes">
	      <?php echo $this->renderPartial('_tabByPending',array('modelProducts'=>$modelProducts)); ?>
	      </div><!-- /.tab2 --> 
	      <div class="tab-pane" id="tabPorMarca">
	      <?php echo $this->renderPartial('_tabByBrand',array('modelProductImportLogs'=>$modelProductImportLogs)); ?>
	      </div><!-- /.tab3 -->      		
      </div><!-- /.tab-content -->
    </div>
    <!-- /.col-sm-12 --> 
  </div>
  <!-- /.row --> 
</div>
<!-- /container --> 
