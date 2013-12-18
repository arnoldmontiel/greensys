<?php
Yii::app()->clientScript->registerScript(__CLASS__.'index-product', "
	   				
$('#open-tab-brand').click(function(){
	$.ajax({
	   		type: 'POST',
	   		url: '". ProductController::createUrl('AjaxOpenTabByBrand') . "',
	 	}).success(function(data)
	 	{	
	   		$('#tabPorMarca').html(data);
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

</script>
<div class="container" id="screenProductos">
  <h1 class="pageTitle">Productos</h1>
  <div class="row">
    <div class="col-sm-12">
      <ul class="nav nav-tabs">
        <li class="active"><a href="#tabTodos" data-toggle="tab">Todos</a></li>
        <li><a href="#tabPendientes" data-toggle="tab">Datos Incompletos <span class="badge">4</span></a></li>
        <li><a id="open-tab-brand" href="#tabPorMarca" data-toggle="tab">por Marca </a></li>
      </ul>
      <div class="tab-content">
  <div class="tab-pane active" id="tabTodos">
     <a href="agregarProducto.php" class="btn btn-primary superBoton"><i class="fa fa-plus"></i>  Agregar Producto</a>
      <table class="table table-striped table-bordered tablaIndividual" width="100%">
        <thead>
          <tr>
            <th style="text-align:left;">Model</th>
            <th style="text-align:left;">Part Number</th>
            <th style="text-align:left;">Marca</th>
            <th style="text-align:left;">Alto</th>
            <th style="text-align:left;">Ancho</th>
            <th style="text-align:left;">Largo</th>
            <th style="text-align:left;">Peso</th>
            <th style="text-align:left;">Tasa</th>
            <th style="text-align:left;">Dealer Cost</th>
            <th style="text-align:left;">MSRP</th>
            <th style="text-align:left;">Resumen</th>
            <th style="text-align:right;">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>AD4</td>
            <td>10-210341-12</td>
            <td>RTI</td>
            <td>0.20 mt</td>
            <td>0.35 mt</td>
            <td>0.40 mt</td>
            <td>0.300 gr</td>
            <td>1.5</td>
            <td>300 USD</td>
            <td>500 USD</td>
            <td>Distributed Audio System</td>
            <td style="text-align:right;"><button type="button" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar</button> <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button></td>
          </tr>
          <tr>
            <td>AD4</td>
            <td>10-210341-12</td>
            <td>RTI</td>
            <td>0.20 mt</td>
            <td>0.35 mt</td>
            <td>0.40 mt</td>
            <td>0.300 gr</td>
            <td>1.5</td>
            <td>300 USD</td>
            <td>500 USD</td>
            <td>Distributed Audio System</td>
            <td style="text-align:right;"><button type="button" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar</button> <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button></td>
          </tr>
          <tr>
            <td>AD4</td>
            <td>10-210341-12</td>
            <td>RTI</td>
            <td>0.20 mt</td>
            <td>0.35 mt</td>
            <td>0.40 mt</td>
            <td>0.300 gr</td>
            <td>1.5</td>
            <td>300 USD</td>
            <td>500 USD</td>
            <td>Distributed Audio System</td>
            <td style="text-align:right;"><button type="button" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar</button> <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button></td>
          </tr>
          <tr>
            <td>AD4</td>
            <td>10-210341-12</td>
            <td>RTI</td>
            <td>0.20 mt</td>
            <td>0.35 mt</td>
            <td>0.40 mt</td>
            <td>0.300 gr</td>
            <td>1.5</td>
            <td>300 USD</td>
            <td>500 USD</td>
            <td>Distributed Audio System</td>
            <td style="text-align:right;"><button type="button" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar</button> <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button></td>
          </tr>
          <tr>
            <td>AD4</td>
            <td>10-210341-12</td>
            <td>RTI</td>
            <td>0.20 mt</td>
            <td>0.35 mt</td>
            <td>0.40 mt</td>
            <td>0.300 gr</td>
            <td>1.5</td>
            <td>300 USD</td>
            <td>500 USD</td>
            <td>Distributed Audio System</td>
            <td style="text-align:right;"><button type="button" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar</button> <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button></td>
          </tr>
          <tr>
            <td>AD4</td>
            <td>10-210341-12</td>
            <td>RTI</td>
            <td>0.20 mt</td>
            <td>0.35 mt</td>
            <td>0.40 mt</td>
            <td>0.300 gr</td>
            <td>1.5</td>
            <td>300 USD</td>
            <td>500 USD</td>
            <td>Distributed Audio System</td>
            <td style="text-align:right;"><button type="button" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar</button> <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button></td>
          </tr>
          <tr>
            <td>AD4</td>
            <td>10-210341-12</td>
            <td>RTI</td>
            <td>0.20 mt</td>
            <td>0.35 mt</td>
            <td>0.40 mt</td>
            <td>0.300 gr</td>
            <td>1.5</td>
            <td>300 USD</td>
            <td>500 USD</td>
            <td>Distributed Audio System</td>
            <td style="text-align:right;"><button type="button" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar</button> <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button></td>
          </tr>
          <tr>
            <td>AD4</td>
            <td>10-210341-12</td>
            <td>RTI</td>
            <td>0.20 mt</td>
            <td>0.35 mt</td>
            <td>0.40 mt</td>
            <td>0.300 gr</td>
            <td>1.5</td>
            <td>300 USD</td>
            <td>500 USD</td>
            <td>Distributed Audio System</td>
            <td style="text-align:right;"><button type="button" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar</button> <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button></td>
          </tr>
        </tbody>
      </table>
      </div><!-- /.tab1 --> 
     <div class="tab-pane" id="tabPendientes">
     <table class="table table-striped table-bordered tablaIndividual" width="100%">
        <thead>
          <tr>
            <th style="text-align:left;">Model</th>
            <th style="text-align:left;">Part Number</th>
            <th style="text-align:left;">Marca</th>
            <th style="text-align:left;">Alto</th>
            <th style="text-align:left;">Ancho</th>
            <th style="text-align:left;">Largo</th>
            <th style="text-align:left;">Peso</th>
            <th style="text-align:left;">Tasa</th>
            <th style="text-align:left;">Dealer Cost</th>
            <th style="text-align:left;">MSRP</th>
            <th style="text-align:left;">Resumen</th>
            <th style="text-align:right;">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>AD4</td>
            <td>10-210341-12</td>
            <td>RTI</td>
            <td>0.20 mt</td>
            <td>0.35 mt</td>
            <td><span class="label label-danger">Incompleto</span></td>
            <td>0.300 gr</td>
            <td>1.5</td>
            <td>300 USD</td>
            <td>500 USD</td>
            <td>Distributed Audio System</td>
            <td style="text-align:right;"><button type="button" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar</button> <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button></td>
          </tr>
          <tr>
            <td>AD4</td>
            <td>10-210341-12</td>
            <td>RTI</td>
            <td>0.20 mt</td>
            <td><span class="label label-danger">Incompleto</span></td>
            <td>0.40 mt</td>
            <td><span class="label label-danger">Incompleto</span></td>
            <td>1.5</td>
            <td>300 USD</td>
            <td>500 USD</td>
            <td>Distributed Audio System</td>
            <td style="text-align:right;"><button type="button" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar</button> <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button></td>
          </tr>
          <tr>
            <td>AD4</td>
            <td>10-210341-12</td>
            <td>RTI</td>
            <td>0.20 mt</td>
            <td>0.35 mt</td>
            <td>0.40 mt</td>
            <td>0.300 gr</td>
            <td>1.5</td>
            <td><span class="label label-danger">Incompleto</span></td>
            <td>500 USD</td>
            <td>Distributed Audio System</td>
            <td style="text-align:right;"><button type="button" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar</button> <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button></td>
          </tr>
          <tr>
            <td>AD4</td>
            <td>10-210341-12</td>
            <td>RTI</td>
            <td>0.20 mt</td>
            <td>0.35 mt</td>
            <td>0.40 mt</td>
            <td>0.300 gr</td>
            <td>1.5</td>
            <td><span class="label label-danger">Incompleto</span></td>
            <td>500 USD</td>
            <td>Distributed Audio System</td>
            <td style="text-align:right;"><button type="button" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar</button> <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button></td>
          </tr>
        </tbody>
      </table>
      </div><!-- /.tab2 --> 
     	<div class="tab-pane" id="tabPorMarca">
     	</div><!-- /.tab3 -->      		
      </div><!-- /.tab-content -->
    </div>
    <!-- /.col-sm-12 --> 
  </div>
  <!-- /.row --> 
</div>
<!-- /container --> 
