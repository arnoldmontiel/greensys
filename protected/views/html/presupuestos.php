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
  <a class="btn btn-primary superBoton" data-toggle="modal" data-target="#myModalCrearPresupuesto"><i class="fa fa-plus"></i> Crear Presupuesto</a>
      <table class="table table-striped table-bordered tablaIndividual" width="100%">
        <thead>
          <tr>
            <th style="text-align:left;">Proyecto</th>
            <th style="text-align:left;">Nº Versi&oacute;n</th>
            <th style="text-align:left;">Descripci&oacute;n</th>
            <th style="text-align:left;">Descuento</th>
            <th style="text-align:left;">Fecha Creaci&oacute;n</th>
            <th style="text-align:left;">Fecha Inicio</th>
            <th style="text-align:right;">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Casa Nordelta</td>
            <td>1.0</td>
            <td>Actualizaci&oacute;n de Cine y nuevas persianas.</td>
            <td>0</td>
            <td>2013-08-28 12:20:12</td>
            <td>--</td>
            <td style="text-align:right;">
            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar</button>
            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button>
            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-archive"></i> Cerrar</button>
            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-download"></i> Descargar</button></td>
          </tr>
          <tr>
            <td>Punta del Este Shopping</td>
            <td>1.0</td>
            <td>Automatizaci&oacute;n del hogar.</td>
            <td>0</td>
            <td>2013-08-28 12:20:12</td>
            <td>--</td>
            <td style="text-align:right;">
            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar</button>
            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button>
            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-archive"></i> Cerrar</button>
            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-download"></i> Descargar</button></td>
          </tr>
          <tr>
            <td>Contaco Inicial</td>
            <td>1.0</td>
            <td>Ambientaci&oacute;n de luces.</td>
            <td>0</td>
            <td>2013-08-28 12:20:12</td>
            <td>--</td>
            <td style="text-align:right;">
            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar</button>
            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button>
            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-archive"></i> Cerrar</button>
            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-download"></i> Descargar</button></td>
          </tr>
          <tr>
            <td>Casa Lopez</td>
            <td>1.0</td>
            <td>Actualizaci&oacute;n de Cine y nuevas persianas.</td>
            <td>0</td>
            <td>2013-08-28 12:20:12</td>
            <td>--</td>
            <td style="text-align:right;">
            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar</button>
            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button>
            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-archive"></i> Cerrar</button>
            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-download"></i> Descargar</button>
            </td>
          </tr>
        </tbody>
      </table>
      </div><!-- /.tab1 --> 
     <div class="tab-pane" id="tabEsperando">
      <table class="table table-striped table-bordered tablaIndividual" width="100%">
        <thead>
          <tr>
            <th style="text-align:left;">Proyecto</th>
            <th style="text-align:left;">Cerrado</th>
            <th style="text-align:left;">Nº Versi&oacute;n</th>
            <th style="text-align:left;">Descripci&oacute;n</th>
            <th style="text-align:left;">Descuento</th>
            <th style="text-align:left;">Fecha Creaci&oacute;n</th>
            <th style="text-align:left;">Fecha Inicio</th>
            <th style="text-align:right;">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Casa Nordelta</td>
            <td>20 Dic 2013 12:20:12</td>
            <td>1.0</td>
            <td>Actualizaci&oacute;n de Cine y nuevas persianas.</td>
            <td>0</td>
            <td>2013-08-28 12:20:12</td>
            <td>--</td>
            <td style="text-align:right;">
            <div class="btn-group">
    <button data-toggle="dropdown" class="btn btn-default btn-sm dropdown-toggle">Estado <i class="fa fa-caret-down"></i></button>
    <ul class="dropdown-menu">
        <li><a href="#"><i class="fa fa-refresh"></i> Re-Abrir</a></li>
        <li><a href="#"><i class="fa fa-check"></i> Aprobado</a></li>
        <li><a href="#"><i class="fa fa-times-circle"></i> Cancelado</button></a></li>
    </ul></div>
           <button type="button" class="btn btn-default btn-sm"><i class="fa fa-download"></i> Descargar</button> 
          <!-- <button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i> Re-Abrir</button> 
           <button type="button" class="btn btn-default btn-sm"><i class="fa fa-check"></i> Aprobado</button> 
           <button type="button" class="btn btn-default btn-sm"><i class="fa fa-times-circle"></i> Cancelado</button>-->
           </td>
          </tr>
          <tr>
            <td>Punta del Este Shopping</td>
            <td>20 Dic 2013 12:20:12</td>
            <td>1.0</td>
            <td>Automatizaci&oacute;n del hogar.</td>
            <td>0</td>
            <td>2013-08-28 12:20:12</td>
            <td>--</td>
            <td style="text-align:right;">
            <div class="btn-group">
    <button data-toggle="dropdown" class="btn btn-default btn-sm dropdown-toggle">Estado <i class="fa fa-caret-down"></i></button>
    <ul class="dropdown-menu">
        <li><a href="#"><i class="fa fa-refresh"></i> Re-Abrir</a></li>
        <li><a href="#"><i class="fa fa-check"></i> Aprobado</a></li>
        <li><a href="#"><i class="fa fa-times-circle"></i> Cancelado</button></a></li>
    </ul></div>
           <button type="button" class="btn btn-default btn-sm"><i class="fa fa-download"></i> Descargar</button> </td>
          </tr>
          <tr>
            <td>Contaco Inicial</td>
            <td>20 Dic 2013 12:20:12</td>
            <td>1.0</td>
            <td>Ambientaci&oacute;n de luces.</td>
            <td>0</td>
            <td>2013-08-28 12:20:12</td>
            <td>--</td>
            <td style="text-align:right;">
            <div class="btn-group">
    <button data-toggle="dropdown" class="btn btn-default btn-sm dropdown-toggle">Estado <i class="fa fa-caret-down"></i></button>
    <ul class="dropdown-menu">
        <li><a href="#"><i class="fa fa-refresh"></i> Re-Abrir</a></li>
        <li><a href="#"><i class="fa fa-check"></i> Aprobado</a></li>
        <li><a href="#"><i class="fa fa-times-circle"></i> Cancelado</button></a></li>
    </ul></div>
           <button type="button" class="btn btn-default btn-sm"><i class="fa fa-download"></i> Descargar</button> </td>
          </tr>
          <tr>
            <td>Casa Lopez</td>
            <td>20 Dic 2013 12:20:12</td>
            <td>1.0</td>
            <td>Actualizaci&oacute;n de Cine y nuevas persianas.</td>
            <td>0</td>
            <td>2013-08-28 12:20:12</td>
            <td>--</td>
            <td style="text-align:right;">
            <div class="btn-group">
    <button data-toggle="dropdown" class="btn btn-default btn-sm dropdown-toggle">Estado <i class="fa fa-caret-down"></i></button>
    <ul class="dropdown-menu">
        <li><a href="#"><i class="fa fa-refresh"></i> Re-Abrir</a></li>
        <li><a href="#"><i class="fa fa-check"></i> Aprobado</a></li>
        <li><a href="#"><i class="fa fa-times-circle"></i> Cancelado</button></a></li>
    </ul></div>
           <button type="button" class="btn btn-default btn-sm"><i class="fa fa-download"></i> Descargar</button> </td>
          </tr>
        </tbody>
      </table>
      </div><!-- /.tab2 --> 
     <div class="tab-pane" id="tabAprobados">
      <table class="table table-striped table-bordered tablaIndividual" width="100%">
        <thead>
          <tr>
            <th style="text-align:left;">Proyecto</th>
            <th style="text-align:left;">Aprobado</th>
            <th style="text-align:left;">Nº Versi&oacute;n</th>
            <th style="text-align:left;">Descripci&oacute;n</th>
            <th style="text-align:left;">Descuento</th>
            <th style="text-align:left;">Fecha Creaci&oacute;n</th>
            <th style="text-align:left;">Fecha Inicio</th>
            <th style="text-align:right;">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Casa Nordelta</td>
            <td>20 Dic 2013 12:20:12</td>
            <td>1.0</td>
            <td>Actualizaci&oacute;n de Cine y nuevas persianas.</td>
            <td>0</td>
            <td>2013-08-28 12:20:12</td>
            <td>--</td>
            <td style="text-align:right;">
           <button type="button" class="btn btn-default btn-sm"><i class="fa fa-download"></i> Descargar</button> 
           </td>
          </tr>
          <tr>
            <td>Punta del Este Shopping</td>
            <td>20 Dic 2013 12:20:12</td>
            <td>1.0</td>
            <td>Automatizaci&oacute;n del hogar.</td>
            <td>0</td>
            <td>2013-08-28 12:20:12</td>
            <td>--</td>
            <td style="text-align:right;">
           <button type="button" class="btn btn-default btn-sm"><i class="fa fa-download"></i> Descargar</button> </td>
          </tr>
          <tr>
            <td>Contaco Inicial</td>
            <td>20 Dic 2013 12:20:12</td>
            <td>1.0</td>
            <td>Ambientaci&oacute;n de luces.</td>
            <td>0</td>
            <td>2013-08-28 12:20:12</td>
            <td>--</td>
            <td style="text-align:right;">
           <button type="button" class="btn btn-default btn-sm"><i class="fa fa-download"></i> Descargar</button> </td>
          </tr>
          <tr>
            <td>Casa Lopez</td>
            <td>20 Dic 2013 12:20:12</td>
            <td>1.0</td>
            <td>Actualizaci&oacute;n de Cine y nuevas persianas.</td>
            <td>0</td>
            <td>2013-08-28 12:20:12</td>
            <td>--</td>
            <td style="text-align:right;">
           <button type="button" class="btn btn-default btn-sm"><i class="fa fa-download"></i> Descargar</button> </td>
          </tr>
        </tbody>
      </table>
      </div><!-- /.tab3 --> 
     <div class="tab-pane" id="tabCancelados">
      <table class="table table-striped table-bordered tablaIndividual" width="100%">
        <thead>
          <tr>
            <th style="text-align:left;">Proyecto</th>
            <th style="text-align:left;">Cancelado</th>
            <th style="text-align:left;">Nº Versi&oacute;n</th>
            <th style="text-align:left;">Descripci&oacute;n</th>
            <th style="text-align:left;">Raz&oacute;n</th>
            <th style="text-align:right;">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Casa Nordelta</td>
            <td>20 Dic 2013 12:20:12</td>
            <td>4.0</td>
            <td>Actualizaci&oacute;n de Cine y nuevas persianas.</td>
            <td><span class="label label-info">El cliente contrato a otra empresa.</span></td>
            <td style="text-align:right;">
    <button class="btn btn-default btn-sm"><i class="fa fa-refresh"></i> Re-Abrir</button>
    <button class="btn btn-default btn-sm"><i class="fa fa-download"></i> Descargar</button>
           </td>
          </tr>
          <tr>
            <td>Punta del Este Shopping</td>
            <td>20 Dic 2013 12:20:12</td>
            <td>1.0</td>
            <td>Automatizaci&oacute;n del hogar.</td>
            <td><span class="label label-info">No teniamos disponible los equipos.</span></td>
            <td style="text-align:right;">
    <button class="btn btn-default btn-sm"><i class="fa fa-refresh"></i> Re-Abrir</button>
    <button class="btn btn-default btn-sm"><i class="fa fa-download"></i> Descargar</button>
           </td>
          </tr>
          <tr>
            <td>Contaco Inicial</td>
            <td>20 Dic 2013 12:20:12</td>
            <td>1.0</td>
            <td>Ambientaci&oacute;n de luces.</td>
            <td><span class="label label-info">Desacuerdos por precio.</span></td>
            <td style="text-align:right;">
    <button class="btn btn-default btn-sm"><i class="fa fa-refresh"></i> Re-Abrir</button>
    <button class="btn btn-default btn-sm"><i class="fa fa-download"></i> Descargar</button>
           </td>
          </tr>
        </tbody>
      </table>
      </div><!-- /.tab4 --> 
      </div><!-- /.tab-content -->
    </div>
    <!-- /.col-sm-12 --> 
  </div>
  <!-- /.row --> 
</div>
<!-- /container --> 

<!--MODAL CREAR PRESU-->
<div class="modal fade" id="myModalCrearPresupuesto">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Crear Presupuesto</h4>
      </div>
      <div class="modal-body">

<form role="form">
  <div class="form-group">
    <label for="campoProyecto">Proyecto</label>
	<select class="form-control" id="campoProyecto">
                <option>Alvear Tower - Contacto Inicial</option>
                <option>Ariel Wasserman - Contacto Inicial</option>
                <option>RTI</option>
              </select>
  </div>
  <div class="form-group">
    <label for="campoEstado">Estado</label>
	<select class="form-control" id="campoEstado">
                <option>Nuevo</option>
              </select>
  </div>
  <div class="form-group">
    <label for="campoDescuento">Descuento</label>
	<input type="text" id="campoDescuento" class="form-control">
  </div>
  <div class="form-group">
    <label for="campoDescripcion">Descripci&oacute;n</label>
	<textarea class="form-control" rows="3" id="campoDescripcion"></textarea>
  </div>
  <div class="form-group col-sm-6 limpiarPadding paddingRight">
    <label for="campoEstInicial">Fecha Estimada Inicio</label>
	<input type="text" id="campoEstInicial" class="form-control">
  </div>
  <div class="form-group col-sm-6 limpiarPadding paddingLeft">
    <label for="campoEstFinal">Fecha Estimada Finalizaci&oacute;n</label>
	<input type="text" id="campoEstFinal" class="form-control">
  </div>
  <div class="form-group col-sm-6 limpiarPadding paddingRight">
    <label for="campoInicio">Fecha Inicio</label>
	<input type="text" id="campoInicio" class="form-control">
  </div>
  <div class="form-group col-sm-6 limpiarPadding paddingLeft">
    <label for="campoFinal">Fecha Finalizaci&oacute;n</label>
	<input type="text" id="campoFinal" class="form-control">
  </div>
</form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary btn-lg"><i class="fa fa-save"></i> Guardar</button>
        <a href="crearPresupuesto.php" class="btn btn-primary btn-lg"><i class="fa fa-save"></i> Guardar y Agregar Prods.</a>
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