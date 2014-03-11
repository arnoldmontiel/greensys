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
$active = 'tformularios';
include ('menuTapia.php');
?>


<div class="container" id="screenTFormularios">
		<div class="row">
			<div class="col-sm-6">
				<h1 class="pageTitle">Formularios</h1>
			</div>
			<div class="col-sm-6 align-right">
<a  class="btn btn-primary superBoton" data-toggle="modal" href="#myModalCrearFormulario"><i class="fa fa-plus"></i> Crear Formulario</a>	
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<table class="table table-striped table-bordered tablaIndividual">
					<thead>
						<tr>
							<th>Nombre</th>
							<th>Descripci&oacute;n</th>
							<th>Con Seguimiento</th>
							<th class="align-right">Acciones</th>
						</tr>
					</thead>
					<tbody>
						<tr class="odd">
							<td style="width: 180px;">Desarrollo Tecnol&oacute;gico</td>
							<td>Mantiene una bit&aacute;cora del desarrollo de nuevas metas
								tecnol&oacute;gicas de la empresa.</td>
							<td><input disabled="disabled" type="checkbox" value="1"></td>
							<td class="align-right">
							<button type="button" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar</button>
             				<button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button>
             				</td>
						</tr>
						<tr class="even">
							<td style="width: 180px;">Informaci&oacute;n Comercial</td>
							<td>Entrega de informaci&oacute;n comercial a la obra</td>
							<td><input disabled="disabled" type="checkbox" value="1"></td>
							<td class="align-right">
							<button type="button" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar</button>
             				<button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button>
             				</td>
						</tr>
						<tr class="odd">
							<td style="width: 180px;">Informaci&oacute;n Privada</td>
							<td>Entregar passwords, nœmeros de IP, licencias y otros.</td>
							<td><input disabled="disabled" type="checkbox" value="1"></td>
							<td class="align-right">
							<button type="button" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar</button>
             				<button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button>
             				</td>
						</tr>
						<tr class="even">
							<td style="width: 180px;">Informaci&oacute;n T&eacute;cnica</td>
							<td>Entregar informaci&oacute;n de ’ndole t&eacute;cnica a la obra</td>
							<td><input disabled="disabled" type="checkbox" value="1"></td>
							<td class="align-right">
							<button type="button" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar</button>
             				<button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button>
             				</td>
						</tr>
						<tr class="odd">
							<td style="width: 180px;">Pedido de Compras</td>
							<td>Solicitud de compra de un equipo o material</td>
							<td><input disabled="disabled" checked="checked" type="checkbox" value="1"></td>
							<td class="align-right">
							<button type="button" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar</button>
             				<button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button>
             				</td>
						</tr>
						<tr class="even">
							<td style="width: 180px;">Pedido de Cotizaci&oacute;n</td>
							<td>Solicitud de confecci&oacute;n de un presupuesto.</td>
							<td><input disabled="disabled" checked="checked" type="checkbox" value="1"></td>
							<td class="align-right">
							<button type="button" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar</button>
             				<button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button>
             				</td>
						</tr>
						<tr class="odd">
							<td style="width: 180px;">Pedido de Documentaci&oacute;n</td>
							<td>Solicitud de entrega formal de documentaci&oacute;n</td>
							<td><input disabled="disabled" type="checkbox" value="1"></td>
							<td class="align-right">
							<button type="button" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar</button>
             				<button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button>
             				</td>
						</tr>
						<tr class="even">
							<td style="width: 180px;">Pedido de Facturaci&oacute;n</td>
							<td>Solicitud de confecci&oacute;n de una factura</td>
							<td><input disabled="disabled" type="checkbox" value="1"></td>
							<td class="align-right">
							<button type="button" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar</button>
             				<button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button>
             				</td>
						</tr>
						<tr class="odd">
							<td style="width: 180px;">Pedido de Informaci&oacute;n</td>
							<td>Solicitud informal de informaci&oacute;n</td>
							<td><input disabled="disabled" checked="checked" type="checkbox" value="1"></td>
							<td class="align-right">
							<button type="button" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar</button>
             				<button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button>
             				</td>
						</tr>
						<tr class="even">
							<td style="width: 180px;">Pedido de RMA</td>
							<td>Solicitud de env’o a RMA</td>
							<td><input disabled="disabled" checked="checked" type="checkbox" value="1"></td>
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

<div id="myModalCrearFormulario" class="modal fade"  aria-hidden="false">
<form id="brand-form" method="post">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h4 class="modal-title">Crear Formulario</h4>
      </div><div class="modal-body">
      <div class="row">
  <div class="form-group col-sm-6">   
  	<label for="campoNombre">Nombre</label>
  <input class="form-control" name="campoNombre" type="text">
  </div>
  <div class="form-group col-sm-6">   
  <div>&nbsp;</div>
  <label for="campoNombre">Con Seguimiento</label>
  <input checked="checked" type="checkbox" value="1">
  </div>
  </div>
  <div class="form-group">
  <label for="campoNombre">Descripci&oacute;n</label>
  <textarea class="form-control" name="campoNombre" rows="3"></textarea>
  </div>
  
  <label for="campoNombre">Permisos por Rol</label>
  <div class="mainBotones clearfix">
  <div class="rowBotones"> 
  <span class="labelBotones">Cliente</span>
	<div class="btn-group">
  <button type="button" class="btn btn-default btn-sm">Crear</button>
  <button type="button" class="btn btn-default btn-sm">Leer</button>
  <button type="button" class="btn btn-default btn-sm">Responder</button>
  <button type="button" class="btn btn-default btn-sm">Correo</button>
  <button type="button" class="btn btn-default btn-sm">Finalizar</button>
</div>
  </div>
  <div class="rowBotones odd">   
  <span class="labelBotones">Programaci&oacute;n</span>
	<div class="btn-group">
  <button type="button" class="btn btn-default btn-sm">Crear</button>
  <button type="button" class="btn btn-default btn-sm">Leer</button>
  <button type="button" class="btn btn-default btn-sm">Responder</button>
  <button type="button" class="btn btn-default btn-sm">Correo</button>
  <button type="button" class="btn btn-default btn-sm">Finalizar</button>
</div>
  </div>
  <div class="rowBotones"> 
  <span class="labelBotones">Implementaci&oacute;n</span>
	<div class="btn-group">
  <button type="button" class="btn btn-default btn-sm">Crear</button>
  <button type="button" class="btn btn-default btn-sm">Leer</button>
  <button type="button" class="btn btn-default btn-sm">Responder</button>
  <button type="button" class="btn btn-default btn-sm">Correo</button>
  <button type="button" class="btn btn-default btn-sm">Finalizar</button>
</div>
  </div>
  <div class="rowBotones odd"> 
  <span class="labelBotones">Ingenieria</span>
	<div class="btn-group">
  <button type="button" class="btn btn-default btn-sm">Crear</button>
  <button type="button" class="btn btn-default btn-sm">Leer</button>
  <button type="button" class="btn btn-default btn-sm">Responder</button>
  <button type="button" class="btn btn-default btn-sm">Correo</button>
  <button type="button" class="btn btn-default btn-sm">Finalizar</button>
</div>
  </div>
  <div class="rowBotones"> 
  <span class="labelBotones">G. Operativa</span>
	<div class="btn-group">
  <button type="button" class="btn btn-default btn-sm">Crear</button>
  <button type="button" class="btn btn-default btn-sm">Leer</button>
  <button type="button" class="btn btn-default btn-sm">Responder</button>
  <button type="button" class="btn btn-default btn-sm">Correo</button>
  <button type="button" class="btn btn-default btn-sm">Finalizar</button>
  </div>
  </div>
  <div class="rowBotones odd">
  <span class="labelBotones">G. Comercial</span>
	<div class="btn-group">
  <button type="button" class="btn btn-default btn-sm">Crear</button>
  <button type="button" class="btn btn-default btn-sm">Leer</button>
  <button type="button" class="btn btn-default btn-sm">Responder</button>
  <button type="button" class="btn btn-default btn-sm">Correo</button>
  <button type="button" class="btn btn-default btn-sm">Finalizar</button>
  </div>
  </div>
  <div class="rowBotones">
  <span class="labelBotones">Administraci&oacute;n</span>
	<div class="btn-group">
  <button type="button" class="btn btn-default btn-sm">Crear</button>
  <button type="button" class="btn btn-default btn-sm">Leer</button>
  <button type="button" class="btn btn-default btn-sm">Responder</button>
  <button type="button" class="btn btn-default btn-sm">Correo</button>
  <button type="button" class="btn btn-default btn-sm">Finalizar</button>
  </div>
  </div>
  <div class="rowBotones odd">
  <span class="labelBotones">I+D</span>
	<div class="btn-group">
  <button type="button" class="btn btn-default btn-sm">Crear</button>
  <button type="button" class="btn btn-default btn-sm">Leer</button>
  <button type="button" class="btn btn-default btn-sm">Responder</button>
  <button type="button" class="btn btn-default btn-sm">Correo</button>
  <button type="button" class="btn btn-default btn-sm">Finalizar</button>
  </div>
  </div>
  <div class="rowBotones">
  <span class="labelBotones">Socio</span>
	<div class="btn-group">
  <button type="button" class="btn btn-default btn-sm">Crear</button>
  <button type="button" class="btn btn-default btn-sm">Leer</button>
  <button type="button" class="btn btn-default btn-sm">Responder</button>
  <button type="button" class="btn btn-default btn-sm">Correo</button>
  <button type="button" class="btn btn-default btn-sm">Finalizar</button>
  </div>
  </div>
  </div><!-- /.mainBotones -->
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