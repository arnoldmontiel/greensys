<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 dramaal//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="ROBOTS" content="NOINDEX, NOFOLLOW">
<title>TAPIA - Clientes</title>
<!-- Bootstrap -->
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
<link rel="stylesheet" href="css/font-awesome.min.css">
<meta name="viewport"
	content="user-scalable=no, width=device-width, initial-scale=1.0" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<?php include('estilos.php');?>
<script src="js/jquery.js"></script>
<!-- Modernizr -->
<script src="js/modernizr.js"></script>
<!-- FastClick -->
<script src="js/fastclick.js"></script>

</head>
<body class="bodyTapia">
<?php
$active = 'tdocumentos';
include ('menuTapia.php');
?>


<div class="container" id="screenTDocumentos">
		<div class="row">
			<div class="col-sm-6">
				<h1 class="pageTitle">Documentos</h1>
			</div>
			<div class="col-sm-6 align-right">
<a  class="btn btn-primary superBoton" data-toggle="modal" href="#myModalCrearDocumento"><i class="fa fa-plus"></i> Crear Documento</a>	
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<table class="table table-striped table-bordered tablaIndividual">
					<thead>
						<tr>
							<th>Nombre</th>
							<th>Descripci&oacute;n</th>
							<th class="align-right">Acciones</th>
						</tr>
					</thead>
					<tbody>
						<tr class="odd">
							<td style="width: 180px">Cine</td>
							<td>Canalizaci&oacute;n, cableado, acœsticos y todo lo que requiera la
								Sala de Cine</td>
							<td class="align-right">
							<button type="button" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar</button>
             				<button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button>
             				</td>
						</tr>
						<tr class="even">
							<td style="width: 180px">C&oacute;mputo y M&eacute;tricas</td>
							<td>Planilla de c&oacute;mputo de equipamiento y m&eacute;tricas de tendidos</td>
							<td class="align-right">
							<button type="button" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar</button>
             				<button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button>
             				</td>
						</tr>
						<tr class="odd">
							<td style="width: 180px">Contrapisos</td>
							<td>Constructivo de Contrapisos</td>
							<td class="align-right">
							<button type="button" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar</button>
             				<button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button>
             				</td>
						</tr>
						<tr class="even">
							<td style="width: 180px">Efectos</td>
							<td>Diagrama de efectos de iluminaci&oacute;n</td>
							<td class="align-right">
							<button type="button" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar</button>
             				<button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button>
             				</td>
						</tr>
						<tr class="odd">
							<td style="width: 180px">Nomenclatura</td>
							<td>Determina la nomenclatura standard utilizada en la
								documentaci&oacute;n de obra.</td>
							<td class="align-right">
							<button type="button" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar</button>
             				<button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button>
             				</td>
						</tr>
						<tr class="even">
							<td style="width: 180px">Plano Planta</td>
							<td>Plano Planta</td>
							<td class="align-right">
							<button type="button" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar</button>
             				<button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button>
             				</td>
						</tr>
						<tr class="odd">
							<td style="width: 180px">Rack</td>
							<td>Esquema de distribuci&oacute;n de equipamiento en rack</td>
							<td class="align-right">
							<button type="button" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar</button>
             				<button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button>
             				</td>
						</tr>
						<tr class="even">
							<td style="width: 180px">Secciones</td>
							<td>Documentaci&oacute;n que determina las secciones utilizadas en
								canalizaciones y/o conductores</td>
							<td class="align-right">
							<button type="button" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar</button>
             				<button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button>
             				</td>
						</tr>
						<tr class="odd">
							<td style="width: 180px">T’pico de Conexi&oacute;n</td>
							<td>Diagramas t’picos de conexi&oacute;n de dispositivos</td>
							<td class="align-right">
							<button type="button" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar</button>
             				<button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button>
             				</td>
						</tr>
						<tr class="even">
							<td style="width: 180px">T’pico de Montaje</td>
							<td>Diagramas t’picos de montaje de dispositivos</td>
							<td class="align-right">
							<button type="button" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar</button>
             				<button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button>
             				</td>
						</tr>
					</tbody>
				</table>
			</div>
			<!-- /.col-sm-12 -->
		</div>
		<!-- /.row -->
	</div>



	<div id="myModalCrearDocumento" class="modal fade"  aria-hidden="false">
<form id="brand-form" method="post">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h4 class="modal-title">Crear Perfil</h4>
      </div>
      <div class="modal-body">
  <div class="form-group">
  <label for="campoNombre">Nombre</label>
  <input class="form-control" name="campoNombre" type="text">
  </div>
  <div class="form-group">
  <label for="campoNombre">Descripci&oacute;n</label>
  <textarea class="form-control" rows="3"></textarea>
  </div>
    </div><!-- /.modal-body -->
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Cancelar</button>
        <button id="saveBrand" type="button" class="btn btn-primary btn-lg"><i class="fa fa-save"></i> Guardar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</form>

</div>

	<!-- Le javascript
    ================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script src="js/bootstrap.min.js"></script>
</body>
</html>