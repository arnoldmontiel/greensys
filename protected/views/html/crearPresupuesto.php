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
$active='productos';
include('menu.php');?>
<div class="container" id="screenCrearPresupuesto">
  <h1 class="pageTitle">Presupuesto</h1>
  
  
  <div class="row">
    <div class="col-sm-6">
    
    <div class="panel panel-success">
        <div class="panel-body">
          <h2>Alvear Tower - Contacto Inicial <a class="superEdit" data-toggle="modal" data-target="#myModalEditarPresupuesto"><i class="fa fa-pencil"></i></a></h2>

        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sodales euismod neque vitae convallis. Phasellus in nunc vitae metus porttitor suscipit.
<table class="table table-striped table-bordered tablaIndividual tablaDatosPanel" width="100%">
        <tbody>
            <tr>
                <td width="20%" class="bold">Estado</td>
                <td>Abierto</td>
            </tr>
            <tr>
                <td class="bold">Versi&oacute;n</td>
                <td>1.0</td>
            </tr>
        </tbody>
      </table>
                <button type="button" class="btn btn-primary marginLeft pull-right"><i class="fa fa-archive fa-fw"></i> Cerrar Versi&oacute;n</button>
                <button type="button" class="btn btn-primary marginLeft pull-right"><i class="fa fa-print fa-fw"></i> Imprimir</button>
      <button type="button" class="btn btn-primary pull-right"><i class="fa fa-eye fa-fw"></i> Preview</button> 
        </div>
        </div>
    </div>
    <div class="col-sm-6">
    <!--
    <div class="panel panel-default">
        <!-- Default panel contents
        <div class="panel-heading">Acciones</div>
        <div class="panel-body">
        <button type="button" class="btn btn-primary marginLeft"><i class="fa fa-archive fa-fw"></i> Cerrar Versi&oacute;n</button>
                <button type="button" class="btn btn-primary marginLeft"><i class="fa fa-print fa-fw"></i> Imprimir</button>
      <button type="button" class="btn btn-primary "><i class="fa fa-eye fa-fw"></i> Preview</button> 
        </div>
      </div>

    </div> -->
    </div>
  </div>
 
   <div class="row">
    <div class="col-sm-12">
      <ul class="nav nav-tabs">
        <li class="active"><a href="#tabBanio" data-toggle="tab">Baño</a></li>
        <li><a href="#tabEsperando" data-toggle="tab">Living</a></li>
        <li><a href="#tabAprobados" data-toggle="tab">Comedor</a></li>
                <li class="pull-right"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModalAgregarProductos">Agregar Productos</button></li>
        <li class="pull-right">
          <div class="btn-group btnAlternateView">
  <button type="button" class="btn btn-default active">Áreas</button>
  <button type="button" class="btn btn-default">Servicios</button>
</div>
        </li>
      </ul>
      <div class="tab-content">
  <div class="tab-pane active" id="tabBanio">
<table class="table table-striped table-bordered tablaIndividual" width="100%">
        <thead>
          <tr>
            <th style="text-align:left;">Model</th>
            <th style="text-align:left;">Cantidad</th>
            <th style="text-align:left;">Part Number</th>
            <th style="text-align:left;">Codigo</th>
            <th style="text-align:left;">Marca</th>
            <th style="text-align:left;">Stock</th>
            <th style="text-align:left;">Servicio</th>
            <th style="text-align:left;">Precio</th>
            <th style="text-align:left;">Descuento</th>
            <th style="text-align:left;">Total</th>
            <th style="text-align:left;">Horas Inst.</th>
            <th style="text-align:left;">Horas Prog.</th>
            <th style="text-align:right;">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>AD4</td>
            <td><input type="model" id="campoCantidad" class="form-control inputSmall"></td>
            <td>10-210341-12</td>
            <td>DHRT-01</td>
            <td>RTI</td>
            <td>5</td>
            <td>
            <select class="form-control" id="campoServicio">
<option value="1">Home Theater</option>
<option value="2">Multiroom Audio</option>
<option value="3">Control de iluminación</option>
              </select>
            </td>
            <td class="precioTabla"><div class="precioTablaValor">500 USD</div> <button type="button" class="btn btn-primary btn-xs pull-right dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown"><i class="fa fa-pencil"></i></button>
              <ul class="dropdown-menu superDropdown" role="menu" aria-labelledby="dropdownMenu1">
    <li role="presentation" class="introProveedor">
    
    <div class="titleProveedor">Luis - Electronica </div>
    <table class="table">
        <thead>
          <tr>
            <th>MSRP</th>
            <th style="text-align:center;">Dealer Cost</th>
            <th style="text-align:right;">Profit Rate</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>899.00</td>
            <td style="text-align:center;">450.00</td>
            <td style="text-align:right;">2.00</td>
            </tr>
        </tbody>
      </table>
    <table class="table tableOpcionesPrecio">
        <tbody>
          <tr>
            <td>Maritimo</td>
            <td>50 Dias</td>
            <td>$200 <i class="fa fa-arrow-down precioMasBajo"></i></td>
            <td style="text-align:right;">    <input type="radio" name="optionsRadios" id="optionProv" value="option1" checked></td>
            </tr>
          <tr>
            <td>Aereo</td>
            <td>50 Dias</td>
            <td>$500</td>
            <td style="text-align:right;">    <input type="radio" name="optionsRadios" id="optionProv" value="option1" checked></td>
            </tr>
        </tbody>
      </table>
    </li>
     <li role="presentation" class="introProveedor">
    
    <div class="titleProveedor">Luis - Muebles </div>
    <table class="table">
        <thead>
          <tr>
            <th>MSRP</th>
            <th style="text-align:center;">Dealer Cost</th>
            <th style="text-align:right;">Profit Rate</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>899.00</td>
            <td style="text-align:center;">450.00</td>
            <td style="text-align:right;">2.00</td>
            </tr>
        </tbody>
      </table>
    <table class="table tableOpcionesPrecio">
        <tbody>
          <tr>
            <td>Maritimo</td>
            <td>50 Dias</td>
            <td>$500</td>
            <td style="text-align:right;">    <input type="radio" name="optionsRadios" id="optionProv" value="option1" checked></td>
            </tr>
          <tr>
            <td>Aereo</td>
            <td>50 Dias</td>
            <td>$500</td>
            <td style="text-align:right;">    <input type="radio" name="optionsRadios" id="optionProv" value="option1" checked></td>
            </tr>
        </tbody>
      </table>
    </li>
  </ul>
            </td>
            <td>
            <input type="model" id="campoPrecio" class="form-control">
            <select class="form-control" id="campoTipoPrecio">
<option value="1">%</option>
<option value="2">USD</option>
              </select>
            </td>
            <td>500 USD</td>
            <td>-</td>
            <td>-</td>
            <td style="text-align:right;"> <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Remover</button></td>
          </tr>
          <tr>
            <td>AD4</td>
            <td><input type="model" id="campoCantidad" class="form-control inputSmall"></td>
            <td>10-210341-12</td>
            <td>DHRT-01</td>
            <td>RTI</td>
            <td>5</td>
            <td>
            <select class="form-control" id="campoServicio">
<option value="1">Home Theater</option>
<option value="2">Multiroom Audio</option>
<option value="3">Control de iluminación</option>
              </select>
            </td>
            <td>500 USD</td>
            <td>
            <input type="model" id="campoPrecio" class="form-control">
            <select class="form-control" id="campoTipoPrecio">
<option value="1">%</option>
<option value="2">USD</option>
              </select>
            </td>
            <td>500 USD</td>
            <td>-</td>
            <td>-</td>
            <td style="text-align:right;"> <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Remover</button></td>
          </tr>
        </tbody>
      </table>
   </div>
   
   </div>
    </div>
    </div>
  <div class="row navbar-fixed-bottom">
    <div class="col-sm-12">
      <div class="buttonsFloatBottom">
        <button type="button" class="btn btn-default"> Cancelar</button>
        <button type="button" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
      </div>
    </div>
    <!-- /.col-sm-12 --> 
  </div>
  <!-- /.row --> 
  
  
    <div class="row ">
  <div class="col-sm-6">
  </div>
  <div class="col-sm-6">
  <div class="tituloFinalPresu">Total</div>
<table class="table">
        <tbody>
          <tr>
            <td width="20%">Subtotal</td>
            <td>1000</td>
          </tr>
          <tr>
            <td>Discount</td>
            <td>1000</td>
          </tr>
          <tr>
            <td>Total</td>
            <td>2000</td>
          </tr>
        </tbody>
      </table>
  </div>
  </div>
  
</div>
<!-- /container --> 

<!--MODAL AGREGAR PROD-->
<div class="modal fade" id="myModalAgregarProductos">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Agregar Productos</h4>
      </div>
      <div class="modal-body">
       <ul class="nav nav-tabs">
        <li class="active"><a href="#tabTodos" data-toggle="tab">Todos</a></li>
        <li><a href="#tabCategoria" data-toggle="tab">por Categor&iacute;a</a></li>
        <li><a href="#tabGrupo" data-toggle="tab">por Grupo</a></li>
        <li class="pull-right">Total Agregados <span class="label label-success">20</span></li>
      </ul>
      <div class="tab-content">
  <div class="tab-pane active" id="tabTodos">
<table class="table table-striped table-bordered tablaIndividual" width="100%">
        <thead>
          <tr>
            <th style="text-align:left;">Model</th>
            <th style="text-align:left;">Part Number</th>
            <th style="text-align:left;">Codigo</th>
            <th style="text-align:left;">Marca</th>
            <th style="text-align:left;">Stock</th>
            <th style="text-align:left;">Categor&iacute;a</th>
            <th style="text-align:left;">Desc. Corta</th>
            <th style="text-align:right;">Acciones</th>
            <th style="text-align:center;">Agregados</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>AD4</td>
            <td>10-210341-12</td>
            <td>DHRT-01</td>
            <td>RTI</td>
            <td>5</td>
            <td>Distributed Audio</td>
            <td>Distributed Audio System</td>
            <td style="text-align:right;"><input type="text" id="campoFinal" class="form-control inputSmall" value="1"><button type="button" class="btn btn-default btn-sm"><i class="fa fa-save"></i> Aplicar</button></td>
            <td style="text-align:center;"><span class="label label-success">3</span>
</td>
          </tr>
          <tr>
            <td>AD4</td>
            <td>10-210341-12</td>
            <td>DHRT-01</td>
            <td>RTI</td>
            <td>5</td>
            <td>Distributed Audio</td>
            <td>Distributed Audio System</td>
            <td style="text-align:right;"><input type="text" id="campoFinal" class="form-control inputSmall" value="1"><button type="button" class="btn btn-default btn-sm"><i class="fa fa-save"></i> Aplicar</button></td>
            <td style="text-align:center;"><span class="label label-default">0</span>
</td>
          </tr>
          <tr>
            <td>AD4</td>
            <td>10-210341-12</td>
            <td>DHRT-01</td>
            <td>RTI</td>
            <td>5</td>
            <td>Distributed Audio</td>
            <td>Distributed Audio System</td>
            <td style="text-align:right;"><input type="text" id="campoFinal" class="form-control inputSmall" value="1"><button type="button" class="btn btn-default btn-sm"><i class="fa fa-save"></i> Aplicar</button></td>
            <td style="text-align:center;"><span class="label label-default">0</span>
</td>
          </tr>
          <tr>
            <td>AD4</td>
            <td>10-210341-12</td>
            <td>DHRT-01</td>
            <td>RTI</td>
            <td>5</td>
            <td>Distributed Audio</td>
            <td>Distributed Audio System</td>
            <td style="text-align:right;"><input type="text" id="campoFinal" class="form-control inputSmall" value="1"><button type="button" class="btn btn-default btn-sm"><i class="fa fa-save"></i> Aplicar</button></td>
            <td style="text-align:center;"><span class="label label-default">0</span>
</td>
          </tr>
          <tr>
            <td>AD4</td>
            <td>10-210341-12</td>
            <td>DHRT-01</td>
            <td>RTI</td>
            <td>5</td>
            <td>Distributed Audio</td>
            <td>Distributed Audio System</td>
            <td style="text-align:right;"><input type="text" id="campoFinal" class="form-control inputSmall" value="1"><button type="button" class="btn btn-default btn-sm"><i class="fa fa-save"></i> Aplicar</button></td>
            <td style="text-align:center;"><span class="label label-default">0</span>
</td>
          </tr>
          <tr>
            <td>AD4</td>
            <td>10-210341-12</td>
            <td>DHRT-01</td>
            <td>RTI</td>
            <td>5</td>
            <td>Distributed Audio</td>
            <td>Distributed Audio System</td>
            <td style="text-align:right;"><input type="text" id="campoFinal" class="form-control inputSmall" value="1"><button type="button" class="btn btn-default btn-sm"><i class="fa fa-save"></i> Aplicar</button></td>
            <td style="text-align:center;"><span class="label label-default">0</span>
</td>
          </tr>
        </tbody>
      </table>
      </div>
  <div class="tab-pane" id="tabCategoria">
  TAB 2
</div>
  <div class="tab-pane" id="tabGrupo">
  TAB 3
  </div>
  </div>      
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary btn-lg" data-dismiss="modal"><i class="fa fa-check"></i> Listo</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--END AGREGAR PROD-->

<!--MODAL EDITAR PRESU-->
<div class="modal fade" id="myModalEditarPresupuesto">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Editar Informaci&oacute;n</h4>
      </div>
      <div class="modal-body">

<form role="form">
  <div class="form-group">
    <label for="campoProyecto">Proyecto</label>
	<select class="form-control" id="campoProyecto">
                <option selected="selected">Alvear Tower - Contacto Inicial</option>
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
<!--END EDITAR PRESU-->

<!-- Le javascript
    ================================================== --> 
<!-- Placed at the end of the document so the pages load faster --> 
<script src="js/bootstrap.min.js"></script>
</body>
</html>