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
$active = 'tusuarios';
include ('menuTapia.php');
?>


<div class="container" id="screenTUsuarios">
		<div class="row">
			<div class="col-sm-6">
				<h1 class="pageTitle">Usuarios</h1>
			</div>
			<div class="col-sm-6 align-right">
<a  class="btn btn-primary superBoton" data-toggle="modal" href="#myModalCrearUsuario"><i class="fa fa-plus"></i> Agregar Usuario</a>	
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<table class="table table-striped table-bordered tablaIndividual">
					<thead>
						<tr>
							<th>Usuario</th>
							<th>Contrase–a</th>
							<th>Correo</th>
							<th>Nombre</th>
							<th>Apellido</th>
							<th>Perfil</th>
							<th class="align-right">Acciones</th>
						</tr>
					</thead>
					<tbody>
						<tr class="odd">
							<td>akalepdjian</td>
							<td>akalepdjian</td>
							<td>akalepdjian@gruposmartliving.com</td>
							<td>Alejandro</td>
							<td>Kalepdjian</td>
							<td>G. Operativa</td>
							<td class="align-right">
							<button type="button" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar</button>
             				<button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button>
             				</td>
						</tr>
						<tr class="even">
							<td>amagatelli</td>
							<td>amagatelli</td>
							<td>amagatelli@gruposmartliving.com</td>
							<td>Axel</td>
							<td>Magatelli</td>
							<td>Ingenier’a</td>
							<td class="align-right">
							<button type="button" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar</button>
             				<button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button>
             				</td>
						</tr>
						<tr class="odd">
							<td>amontiel</td>
							<td>amontiel</td>
							<td>amontiel@gruposmartliving.com</td>
							<td>Arnaldo</td>
							<td>Montiel</td>
							<td>I+D</td>
							<td class="align-right">
							<button type="button" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar</button>
             				<button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button>
             				</td>
						</tr>
						<tr class="even">
							<td>dluna</td>
							<td>dluna</td>
							<td>dluna@gruposmartliving.com</td>
							<td>Daniel</td>
							<td>Luna</td>
							<td>Implementaci—n</td>
							<td class="align-right">
							<button type="button" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar</button>
             				<button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button>
             				</td>
						</tr>
						<tr class="odd">
							<td>drossi</td>
							<td>drossi</td>
							<td>drossi@gruposmartliving.com</td>
							<td>Delfina</td>
							<td>Rossi</td>
							<td>I+D</td>
							<td class="align-right">
							<button type="button" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar</button>
             				<button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button>
             				</td>
						</tr>
						<tr class="even">
							<td>ecohens</td>
							<td>ecohens</td>
							<td>ecohen@gruposmartliving.com</td>
							<td>Eduardo</td>
							<td>Cohen</td>
							<td>Socio</td>
							<td class="align-right">
							<button type="button" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar</button>
             				<button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button>
             				</td>
						</tr>
						<tr class="odd">
							<td>fcastagnino</td>
							<td>fcastagnino</td>
							<td>fcastagnino@castagnino-urcola.com.ar</td>
							<td>F</td>
							<td>Castagnino</td>
							<td>Socio</td>
							<td class="align-right">
							<button type="button" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar</button>
             				<button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button>
             				</td>
						</tr>
						<tr class="even">
							<td>fmelo</td>
							<td>fmelo</td>
							<td>fmelo@gruposmartliving.com</td>
							<td>F</td>
							<td>Melo</td>
							<td>G. Comercial</td>
							<td class="align-right">
							<button type="button" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar</button>
             				<button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button>
             				</td>
						</tr>
						<tr class="odd">
							<td>jmorales</td>
							<td>jmorales</td>
							<td>jmorales@gruposmartliving.com</td>
							<td>Jonathan</td>
							<td>Morales</td>
							<td>Implementaci—n</td>
							<td class="align-right">
							<button type="button" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar</button>
             				<button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button>
             				</td>
						</tr>
						<tr class="even">
							<td>lvazquez</td>
							<td>lvazquez</td>
							<td>lvazquez@gruposmartliving.com</td>
							<td>Leonel</td>
							<td>Vazquez</td>
							<td>Implementaci—n</td>
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


	<div id="myModalCrearUsuario" class="modal fade"  aria-hidden="false">
<form id="brand-form" method="post">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h4 class="modal-title">Agregar Usuario</h4>
      </div>
      <div class="modal-body">
      
      <div class="row">
  <div class="form-group col-sm-6">   
  	<label for="campoNombre">Usuario</label>
  <input class="form-control" name="campoNombre" type="text">
  </div>
  <div class="form-group col-sm-6">   
  	<label for="campoApellido">Constrase&ntilde;a</label>
  <input class="form-control" name="campoApellido" type="text">
  </div>
  </div>
      <div class="row">
  <div class="form-group col-sm-12">   
  	<label for="campoNombre">Correo</label>
  <input class="form-control" name="campoNombre" type="text">
  </div>
  </div>
      <div class="row">
  <div class="form-group col-sm-6">   
  <label for="campoNombre">Perfil</label>
  <select class="form-control">
<option value="4">Programaci&oacute;n</option>
<option value="6">Implementaci&oacute;n</option>
<option value="7">Ingenier&iacute;a</option>
<option value="8">G. Operativa</option>
<option value="9">G. Comercial</option>
<option value="12">Administraci&oacute;n</option>
<option value="13">I+D</option>
<option value="14">Socio</option>
</select>
  </div>
  <div class="form-group col-sm-6">   
  <div>&nbsp;</div>
<button class="btn btn-default"><i class="fa fa-plus"></i> Agregar Nuevo Perfil</button>
  </div>
  </div>
      <div class="row">
  <div class="form-group col-sm-12">   
  	<label for="campoNombre">Direcci&oacute;n</label>
  <input class="form-control" name="campoNombre" type="text">
  </div>
  </div>
      <div class="row">
  <div class="form-group col-sm-6">   
  	<label for="campoNombre">Tel&eacute;fono Casa</label>
  <input class="form-control" name="campoNombre" type="text">
  </div>
  <div class="form-group col-sm-6">   
  	<label for="campoApellido">Tel&eacute;fono M&oacute;vil</label>
  <input class="form-control" name="campoApellido" type="text">
  </div>
  </div>
      <div class="row">
  <div class="form-group col-sm-6">   
  	<label for="campoNombre">DNI</label>
  <input class="form-control" name="campoNombre" type="text">
  </div>
  <div class="form-group col-sm-6">   
  	<label for="campoApellido">CUIL</label>
  <input class="form-control" name="campoApellido" type="text">
  </div>
  </div>
      <div class="row">
  <div class="form-group col-sm-12">   
  	<label for="campoNombre">Observaciones</label>
  <textarea class="form-control" rows="3"></textarea>
  </div>
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