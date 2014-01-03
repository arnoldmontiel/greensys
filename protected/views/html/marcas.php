<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 dramaal//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="ROBOTS" content="NOINDEX, NOFOLLOW">
<title>GREEN</title>
<!-- Bootstrap -->
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
<link rel="stylesheet" href="css/font-awesome.min.css">
<meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<?php include('estilos.php');?>
<script src="js/jquery.js"></script>
</head>
<body>
<?php 
$active='presupuestos';
include('menu.php');?>
<div class="container" id="screenMarcas">
  <div class="row">
    <div class="col-sm-6">
  <h1 class="pageTitle">Marcas</h1>
  </div>
    <div class="col-sm-6 align-right">
  <a class="btn btn-primary superBoton" data-toggle="modal" data-target="#myModalCrearMarca"><i class="fa fa-plus"></i> Agregar Marca</a>
  </div>
  </div>
  <div class="row">
    <div class="col-sm-12">
      <table class="table table-striped table-bordered tablaIndividual" width="100%">
        <thead>
          <tr>
            <th style="text-align:left;">Nombre</th>
            <th style="text-align:left;">Descripci&oacute;n</th>
            <th style="text-align:right;">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>RTI</td>
            <td>Esta es una descripcion</td>
            <td style="text-align:right;">
            <div class="buttonsTableProd">
            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar</button>
            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button>
            </div>
          </tr>
          <tr>
            <td>RTI</td>
            <td>Esta es una descripcion</td>
            <td style="text-align:right;">
            <div class="buttonsTableProd">
            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar</button>
            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button>
            </div>
          </tr>
          <tr>
            <td>RTI</td>
            <td>Esta es una descripcion</td>
            <td style="text-align:right;">
            <div class="buttonsTableProd">
            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar</button>
            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button>
            </div>
          </tr>
          <tr>
            <td>RTI</td>
            <td>Esta es una descripcion</td>
            <td style="text-align:right;">
            <div class="buttonsTableProd">
            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar</button>
            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button>
            </div>
          </tr>
        </tbody>
      </table>
    </div>
    <!-- /.col-sm-12 --> 
  </div>
  <!-- /.row --> 
</div>
<!-- /container --> 

<!--MODAL CREAR PRESU-->
<div class="modal fade" id="myModalCrearMarca">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Agregar Marca</h4>
      </div>
      <div class="modal-body">

<form role="form">
  <div class="form-group">
    <label for="campoNombre">Nombre</label>
		<input type="text" id="campoNombre" class="form-control">
  </div>
  <div class="form-group">
    <label for="campoDescripcion">Descripci&oacute;n</label>
	<textarea class="form-control" rows="3" id="campoDescripcion"></textarea>
  </div>
</form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary btn-lg"><i class="fa fa-save"></i> Guardar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--END MODAL CREAR-->

<!-- Le javascript
    ================================================== --> 
<!-- Placed at the end of the document so the pages load faster --> 
<script src="js/bootstrap.min.js"></script>
</body>
</html>