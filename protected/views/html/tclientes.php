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
<body>
<?php
$active = 'tclientes';
include ('menuTapia.php');
?>


<div class="container" id="screenTClientes">
		<div class="row">
			<div class="col-sm-6">
				<h1 class="pageTitle">Clientes</h1>
			</div>
			<div class="col-sm-6 align-right">
<a  class="btn btn-primary superBoton" data-toggle="modal" href="#myModalCrearCliente"><i class="fa fa-plus"></i> Agregar Cliente</a>	
		</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<table class="table table-striped table-bordered tablaIndividual">
					<thead>
						<tr>
							<th>Descripci&oacute;n</th>
							<th>Nombre</th>
							<th>Apellido</th>
							<th>Tel&eacute;fono 1</th>
							<th>Correo</th>
							<th class="align-right">Acciones</th>
						</tr>
					</thead>
					<tbody>
						<tr class="odd">
							<td>Benedectis</td>
							<td>Alejandro</td>
							<td>de Benedectis</td>
							<td>1158973822</td>
							<td>ale@dimimax.com.ar</td>
							<td class="align-right">
							<button type="button" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar</button>
             				<button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button>
             				</td>
						</tr>
						<tr class="even">
							<td>Cartellone</td>
							<td>Gerardo</td>
							<td>Cartellone</td>
							<td>1144032539</td>
							<td>montevideolh@gmail.com</td>
							<td class="align-right">
							<button type="button" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar</button>
             				<button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button>
             				</td>
						</tr>
						<tr class="odd">
							<td>Cohen</td>
							<td>Eduardo</td>
							<td>Cohen</td>
							<td>1148040621</td>
							<td>oficinacohen@gmail.com</td>
							<td class="align-right">
							<button type="button" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar</button>
             				<button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button>
             				</td>
						</tr>
						<tr class="even">
							<td>Devitta</td>
							<td>Ezequiel</td>
							<td>Serrot</td>
							<td>1137708056</td>
							<td>damidevitta@tucci.com</td>
							<td class="align-right">
							<button type="button" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar</button>
             				<button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button>
             				</td>
						</tr>
						<tr class="odd">
							<td>Feler</td>
							<td>Alejandro</td>
							<td>Alejandro Portalupi</td>
							<td>1147737687</td>
							<td>alpo75@hotmail.com</td>
							<td class="align-right">
							<button type="button" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar</button>
             				<button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button>
             				</td>
						</tr>
						<tr class="even">
							<td>Greco</td>
							<td>Roberto</td>
							<td>Greco</td>
							<td>9</td>
							<td>rgreco@grandkids.net</td>
							<td class="align-right">
							<button type="button" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar</button>
             				<button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button>
             				</td>
						</tr>
						<tr class="odd">
							<td>Kansas</td>
							<td>Sebasti‡n</td>
							<td>Opazo</td>
							<td>1132567211</td>
							<td>sopazo@bistrosa.com.ar</td>
							<td class="align-right">
							<button type="button" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar</button>
             				<button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button>
             				</td>
						</tr>
						<tr class="even">
							<td>Kim</td>
							<td>Ileana</td>
							<td>Sannuto</td>
							<td>1164292597</td>
							<td>ileanasannuto@gmail.com</td>
							<td class="align-right">
							<button type="button" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar</button>
             				<button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button>
             				</td>
						</tr>
						<tr class="odd">
							<td>Kuchikian</td>
							<td>Ricardo</td>
							<td>Kuchikian</td>
							<td>1131410440</td>
							<td>rkuchikian@eseka.com.ar</td>
							<td class="align-right">
							<button type="button" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar</button>
             				<button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button>
             				</td>
						</tr>
						<tr class="even">
							<td>Liliana</td>
							<td>Liliana</td>
							<td></td>
							<td>+5491144116956</td>
							<td>lilic@fibertel.com.ar</td>
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

<div id="myModalCrearCliente" class="modal fade"  aria-hidden="false">
<form id="brand-form" method="post">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h4 class="modal-title">Agregar Cliente</h4>
      </div>
      <div class="modal-body">
      <div class="row">
  <div class="form-group col-sm-6">   
  	<label for="campoNombre">Nombre</label>
  <input class="form-control" name="campoNombre" type="text">
  </div>
  <div class="form-group col-sm-6">   
  	<label for="campoApellido">Apellido</label>
  <input class="form-control" name="campoApellido" type="text">
  </div>
  </div>
      <div class="row">
  <div class="form-group col-sm-6">   
  	<label for="campoNombre">Designaci&oacute;n</label>
  <input class="form-control" name="campoNombre" type="text">
  </div>
  <div class="form-group col-sm-6">   
  	<label for="campoNombre">Documento</label>
  <input class="form-control" name="campoNombre" type="text">
  </div>
  </div>
      <div class="row">
  <div class="form-group col-sm-6">   
  	<label for="campoNombre">Fecha de Nacimiento</label>
  <input class="form-control" name="campoNombre" type="text">
  </div>
  <div class="form-group col-sm-6">   
  	<label for="campoApellido">Telefono 1</label>
  <input class="form-control" name="campoApellido" type="text">
  </div>
  </div>
      <div class="row">
  <div class="form-group col-sm-6">   
  	<label for="campoNombre">Telefono 2</label>
  <input class="form-control" name="campoNombre" type="text">
  </div>
  <div class="form-group col-sm-6">   
  	<label for="campoApellido">Telefono 3</label>
  <input class="form-control" name="campoApellido" type="text">
  </div>
  </div>
      <div class="row">
  <div class="form-group col-sm-6">   
  	<label for="campoApellido">Correo</label>
    <input class="form-control" name="campoNombre" type="text">
  </div>
  <div class="form-group col-sm-6">   
  	<label for="campoNombre">Direccion</label>
    <input class="form-control" name="campoApellido" type="text">
  </div>
  </div>
      <div class="row">
  <div class="form-group col-sm-6">   
  	<label for="campoApellido">Url</label>
    <input class="form-control" name="campoNombre" type="text">
  </div>
  <div class="form-group col-sm-6">   
  	<label for="campoApellido">Recibe Correo</label>
  	<input style="display:block;" checked="checked" type="checkbox" value="1">
  </div>
  </div>
      <div class="row rowUsuario">
  <div class="form-group col-sm-6">   
  	<label for="campoNombre">Usuario</label>
  <input class="form-control" name="campoNombre" type="text">
  </div>
  <div class="form-group col-sm-6">   
  	<label for="campoApellido">Constrase&ntilde;a</label>
  <input class="form-control" name="campoApellido" type="text">
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