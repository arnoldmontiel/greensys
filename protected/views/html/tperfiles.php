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
$active = 'tperfiles';
include ('menuTapia.php');
?>


<div class="container" id="screenTPerfiles">
		<div class="row">
			<div class="col-sm-6">
				<h1 class="pageTitle">Perfiles</h1>
			</div>
			<div class="col-sm-6 align-right">
<a  class="btn btn-primary superBoton" data-toggle="modal" href="#myModalCrearPerfil"><i class="fa fa-plus"></i> Agregar Perfil</a>	
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<table class="table table-striped table-bordered tablaIndividual">
					<thead>
						<tr>
							<th>Descripci&oacute;n</th>
							<th>Es administrador</th>
							<th>Es Interno</th>
							<th class="align-right">Acciones</th>
						</tr>
					</thead>
					<tbody>
						<tr class="odd">
							<td>Administraci&oacute;n</td>
							<td><input disabled="disabled" type="checkbox" value="1"
								name="is_administrator" id="is_administrator"></td>
							<td><input disabled="disabled" checked="checked" type="checkbox"
								value="1" name="is_internal" id="is_internal"></td>
							<td class="align-right">
							<button type="button" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar</button>
             				<button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button>
             				</td>
						</tr>
						<tr class="even">
							<td>G. Comercial</td>
							<td><input disabled="disabled" checked="checked" type="checkbox"
								value="1" name="is_administrator" id="is_administrator"></td>
							<td><input disabled="disabled" checked="checked" type="checkbox"
								value="1" name="is_internal" id="is_internal"></td>
							<td class="align-right">
							<button type="button" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar</button>
             				<button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button>
             				</td>
						</tr>
						<tr class="odd">
							<td>G. Operativa</td>
							<td><input disabled="disabled" checked="checked" type="checkbox"
								value="1" name="is_administrator" id="is_administrator"></td>
							<td><input disabled="disabled" checked="checked" type="checkbox"
								value="1" name="is_internal" id="is_internal"></td>
							<td class="align-right">
							<button type="button" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar</button>
             				<button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button>
             				</td>
						</tr>
						<tr class="even">
							<td>I+D</td>
							<td><input disabled="disabled" checked="checked" type="checkbox"
								value="1" name="is_administrator" id="is_administrator"></td>
							<td><input disabled="disabled" checked="checked" type="checkbox"
								value="1" name="is_internal" id="is_internal"></td>
							<td class="align-right">
							<button type="button" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar</button>
             				<button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button>
             				</td>
						</tr>
						<tr class="odd">
							<td>Implementaci&oacute;n</td>
							<td><input disabled="disabled" type="checkbox" value="1"
								name="is_administrator" id="is_administrator"></td>
							<td><input disabled="disabled" checked="checked" type="checkbox"
								value="1" name="is_internal" id="is_internal"></td>
							<td class="align-right">
							<button type="button" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar</button>
             				<button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button>
             				</td>
						</tr>
						<tr class="even">
							<td>Ingenier’a</td>
							<td><input disabled="disabled" type="checkbox" value="1"
								name="is_administrator" id="is_administrator"></td>
							<td><input disabled="disabled" checked="checked" type="checkbox"
								value="1" name="is_internal" id="is_internal"></td>
							<td class="align-right">
							<button type="button" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar</button>
             				<button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button>
             				</td>
						</tr>
						<tr class="odd">
							<td>Programaci&oacute;n</td>
							<td><input disabled="disabled" type="checkbox" value="1"
								name="is_administrator" id="is_administrator"></td>
							<td><input disabled="disabled" checked="checked" type="checkbox"
								value="1" name="is_internal" id="is_internal"></td>
							<td class="align-right">
							<button type="button" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar</button>
             				<button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button>
             				</td>
						</tr>
						<tr class="even">
							<td>Socio</td>
							<td><input disabled="disabled" checked="checked" type="checkbox"
								value="1" name="is_administrator" id="is_administrator"></td>
							<td><input disabled="disabled" checked="checked" type="checkbox"
								value="1" name="is_internal" id="is_internal"></td>
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



	<div id="myModalCrearPerfil" class="modal fade"  aria-hidden="false">
<form id="brand-form" method="post">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h4 class="modal-title">Crear Perfil</h4>
      </div>
      <div class="modal-body">
  <div class="form-group">
  <label for="campoNombre">Descripci&oacute;n</label>
  <input class="form-control" name="campoNombre" type="text">
    <p class="help-block">Descripci&oacute;n no puede estar vac&iacute;o.</p>
  </div>
  <div class="checkbox">
    <label>      <input type="checkbox"> Es interno    </label>
  </div>
  <div class="checkbox">
    <label>      <input type="checkbox"> Es administrador</label>
  </div>
  <div class="checkbox">
    <label>      <input type="checkbox"> Puede ver documentos t&eacute;cnicos</label>
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