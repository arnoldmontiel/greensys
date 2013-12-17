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
<ol class="breadcrumb">
  <li><a href="productos.php">Productos</a></li>
  <li class="active"><a href="#">Agregar Producto</a></li>
</ol>
<div class="container" id="screenAgregarProductos">
  <h1 class="pageTitle">Agregar Producto</h1>
  <div class="row">
    <div class="col-sm-6">
      <div class="rowSeparator noTopMargin">Información Básica</div>
      <table class="table table-striped table-bordered tablaIndividual form-inline" width="100%">
        <tbody>
          <tr>
            <td width="20%" style="text-align:right;"><label for="campoModel">Model</label></td>
            <td width="80%"><input type="model" id="campoModel" class="form-control"></td>
          </tr>
          <tr>
            <td style="text-align:right;"><label for="campoPartNumber">Part Number</label></td>
            <td><input type="model" id="campoPartNumber" class="form-control"></td>
          </tr>
          <tr>
            <td style="text-align:right;"><label for="campoMarca">Marca</label></td>
            <td class="combined"><select class="form-control" id="campoMarca">
                <option>Vantage</option>
                <option>RTI</option>
              </select>
              <button type="submit" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Agregar Marca</button></td>
          </tr>
          <tr>
            <td style="text-align:right;"><label for="campoProveedor">Proveedor</label></td>
            <td class="combined"><select class="form-control" id="campoProveedor">
                <option>Vantage</option>
                <option>RTI</option>
              </select>
              <button type="submit" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Agregar Proveedor</button></td>
          </tr>
          <tr>
            <td style="text-align:right;"><label for="campoCategoria">Categor&iacute;a</label></td>
            <td class="combined"><select class="form-control" id="campoCategoria">
                <option>Home Theater</option>
                <option>Tele</option>
              </select>
              <button type="submit" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Agregar Cat.</button></td>
          </tr>
          <tr>
            <td style="text-align:right;"><label for="campoSubcategoria">Subcategor&iacute;a</label></td>
            <td class="combined"><select class="form-control" id="campoSubcategoria">
                <option>Audio</option>
                <option>Video</option>
              </select>
              <button type="submit" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Agregar Subcat.</button></td>
          </tr>
          <tr>
            <td style="text-align:right;"><label for="campoNomenclatura">Nomenclatura</label></td>
            <td class="combined"><select class="form-control" id="campoNomenclatura">
                <option>Sin Asignar</option>
                <option>DTools</option>
              </select>
              <button type="submit" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Agregar Nomenc.</button></td>
          </tr>
          <tr>
            <td style="text-align:right;"><label for="campoTipo">Tipo</label></td>
            <td class="combined"><select class="form-control" id="campoTipo">
                <option>Controller</option>
                <option>Dimmer</option>
              </select>
              <button type="submit" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Agregar Tipo</button></td>
          </tr>
        </tbody>
      </table>
    </div>
    <!-- /.col-sm-6 -->
    <div class="col-sm-6">
      <div class="rowSeparator noTopMargin">MEDIDAS</div>
      <table class="table table-striped table-bordered tablaIndividual" width="100%">
        <tbody>
          <tr>
            <td width="20%" style="text-align:right;"><label for="campoLargo">Largo</label></td>
            <td width="80%"><input type="model" id="campoLargo" class="form-control" placeholder="0.0"></td>
          </tr>
          <tr>
            <td style="text-align:right;"><label for="campoAncho">Ancho</label></td>
            <td><input type="model" id="campoAncho" class="form-control" placeholder="0.0"></td>
          </tr>
          <tr>
            <td style="text-align:right;"><label for="campoAlto">Alto</label></td>
            <td><input type="model" id="campoAlto" class="form-control" placeholder="0.0"></td>
          </tr>
          <tr>
            <td style="text-align:right;"><label for="campoMeasureLinear">Measure Linear</label></td>
            <td><select class="form-control" id="campoMeasureLinear">
                <option>ml</option>
                <option>in</option>
                <option>ft</option>
                <option>mm</option>
                <option>cm</option>
              </select></td>
          </tr>
          <tr>
            <td style="text-align:right;"><label for="campoVolumen">Volumen</label></td>
            <td><input type="model" id="campoVolumen" class="form-control" placeholder="000m3"></td>
          </tr>
          <tr>
            <td style="text-align:right;"><label for="campoMedidaPeso">Medida Peso</label></td>
            <td><select class="form-control" id="campoMedidaPeso">
                <option>kg</option>
                <option>lb</option>
              </select></td>
          </tr>
          <tr>
            <td style="text-align:right;"><label for="campoPeso">Peso</label></td>
            <td><input type="model" id="campoPeso" class="form-control" placeholder="000m3"></td>
          </tr>
        </tbody>
      </table>
    </div>
    <!-- /.col-sm-6 --> 
  </div>
  <!-- /.row -->
  <div class="row">
    <div class="col-sm-6">
      <div class="rowSeparator noTopMargin">EXTRA</div>
      <table class="table table-striped table-bordered tablaIndividual form-inline" width="100%">
        <tbody>
          <tr>
            <td width="20%" style="text-align:right;"><label for="campoOcultar">Ocultar</label></td>
            <td width="80%"><div class="checkbox">
                <label>
                  <input type="checkbox" id="campoOcultar">
                  S&iacute; </label>
              </div></td>
          </tr>
          <tr>
            <td style="text-align:right;"><label for="campoDiscontinuado">Discontinuado</label></td>
            <td><div class="checkbox">
                <label>
                  <input type="checkbox" id="campoDiscontinuado">
                  S&iacute; </label>
              </div></td>
          </tr>
          <tr>
            <td style="text-align:right;"><label for="campoVolts">Volts</label></td>
            <td><select class="form-control" id="campoVolts">
                <option>110</option>
                <option>220</option>
                <option>0</option>
              </select></td>
          </tr>
          <tr>
            <td style="text-align:right;"><label for="campoRack">Necesita Rack</label></td>
            <td><div class="checkbox">
                <label>
                  <input type="checkbox" id="campoRack">
                  S&iacute; </label>
              </div></td>
          </tr>
          <tr>
            <td style="text-align:right;"><label for="campoCantRack">Cantidad Rack</label></td>
            <td><select class="form-control" id="campoCantRack">
                <option>0</option>
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
                <option>6</option>
                <option>7</option>
                <option>8</option>
                <option>9</option>
                <option>10</option>
              </select></td>
          </tr>
          <tr>
            <td style="text-align:right;"><label for="campoCantVent">Cantidad Ventiladores</label></td>
            <td><select class="form-control" id="campoCantVent">
                <option>0</option>
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
                <option>6</option>
                <option>7</option>
                <option>8</option>
                <option>9</option>
                <option>10</option>
              </select></td>
          </tr>
          <tr>
            <td style="text-align:right;"><label for="campoColor">Color</label></td>
            <td><input type="model" id="campoColor" class="form-control" placeholder=""></td>
          </tr>
          <tr>
            <td style="text-align:right;"><label for="campoIcono">&Iacute;cono</label></td>
            <td><input type="file" id="campoIcono"></td>
          </tr>
        </tbody>
      </table>
    </div>
    <!-- /.col-sm-6 -->
    <div class="col-sm-6">
      <div class="rowSeparator noTopMargin">DESCRIPCIONES</div>
      <table class="table table-striped table-bordered tablaIndividual" width="100%">
        <tbody>
          <tr>
            <td width="20%" style="text-align:right;"><label for="campoDescCorta">Corta</label></td>
            <td width="80%"><textarea class="form-control" rows="3" id="campoDescCorta"></textarea></td>
          </tr>
          <tr>
            <td style="text-align:right;"><label for="campoDescLarga">Larga</label></td>
            <td><textarea class="form-control" rows="3" id="campoDescLarga"></textarea></td>
          </tr>
          <tr>
            <td style="text-align:right;"><label for="campoDescClientes">Clientes</label></td>
            <td><textarea class="form-control" rows="3" id="campoDescClientes"></textarea></td>
          </tr>
          <tr>
            <td style="text-align:right;"><label for="campoProveedores">Proveedores</label></td>
            <td><textarea class="form-control" rows="3" id="campoProveedores"></textarea></td>
          </tr>
        </tbody>
      </table>
    </div>
    <!-- /.col-sm-6 --> 
  </div>
  <!-- /.row -->
   <div class="row">
    <div class="col-sm-6">
      <div class="rowSeparator noTopMargin">PRECIOS</div>
      <table class="table table-striped table-bordered tablaIndividual form-inline" width="100%">
        <tbody>
          <tr>
            <td width="20%" style="text-align:right;"><label for="campoMSRP">MSRP</label></td>
            <td width="80%"><input type="model" id="campoMSRP" class="form-control" placeholder="0.00 USD"></td>
          </tr>
          <tr>
            <td style="text-align:right;"><label for="campoDealerCost">Dealer Cost</label></td>
            <td><input type="model" id="campoDealerCost" class="form-control" placeholder="0.00 USD"></td>
          </tr>
          <tr>
            <td style="text-align:right;"><label for="campoProfit">Profit Rate</label></td>
            <td><input type="model" id="campoProfit" class="form-control" placeholder="0.00 %"></td>
          </tr>
        </tbody>
      </table>
    </div>
    <!-- /.col-sm-6 -->
    <div class="col-sm-6">
      <div class="rowSeparator noTopMargin">HORAS</div>
      <table class="table table-striped table-bordered tablaIndividual" width="100%">
        <tbody>
          <tr>
            <td width="20%" style="text-align:right;"><label for="campoInstalacion">Tiempo Instalaci&oacute;n</label></td>
            <td width="80%"><input type="model" id="campoInstalacion" class="form-control" placeholder="0.0"></td>
          </tr>
          <tr>
            <td style="text-align:right;"><label for="campoProgramacion">Tiempo Programaci&oacute;n</label></td>
            <td><input type="model" id="campoProgramacion" class="form-control" placeholder="0.0"></td>
          </tr>
        </tbody>
      </table>  
    </div>
    <!-- /.col-sm-6 -->
    </div>
    <!-- /.row -->
   <div class="row">
    <div class="col-sm-6">
      <div class="rowSeparator noTopMargin">COSTOS UNIDAD</div>
      <table class="table table-striped table-bordered tablaIndividual form-inline" width="100%">
        <tbody>
          <tr>
            <td width="20%" style="text-align:right;"><label for="campoCostoA">Costo Unidad A</label></td>
            <td width="80%"><input type="model" id="campoCostoA" class="form-control" placeholder="0.00"></td>
          </tr>
          <tr>
            <td style="text-align:right;"><label for="campoCostoB">Costo Unidad B</label></td>
            <td><input type="model" id="campoCostoB" class="form-control" placeholder="0.00"></td>
          </tr>
          <tr>
            <td style="text-align:right;"><label for="campoCostoC">Costo Unidad C</label></td>
            <td><input type="model" id="campoCostoC" class="form-control" placeholder="0.00"></td>
          </tr>
        </tbody>
      </table>
    </div>
    <!-- /.col-sm-6 -->
    <div class="col-sm-6">
      <div class="rowSeparator noTopMargin">PRECIOS UNIDAD</div>
      <table class="table table-striped table-bordered tablaIndividual" width="100%">
        <tbody>
          <tr>
            <td width="20%" style="text-align:right;"><label for="campoPrecioA">Precio Unidad A</label></td>
            <td width="80%"><input type="model" id="campoPrecioA" class="form-control" placeholder="0.00"></td>
          </tr>
          <tr>
            <td style="text-align:right;"><label for="campoPrecioB">Precio Unidad B</label></td>
            <td><input type="model" id="campoPrecioB" class="form-control" placeholder="0.00"></td>
          </tr>
          <tr>
            <td style="text-align:right;"><label for="campoPrecioC">Precio Unidad C</label></td>
            <td><input type="model" id="campoPrecioC" class="form-control" placeholder="0.00"></td>
          </tr>
        </tbody>
      </table>  
    </div>
    <!-- /.col-sm-6 -->
    </div>
    <!-- /.row -->
   <div class="row">
    <div class="col-sm-6">
      <div class="rowSeparator noTopMargin">INPUTS</div>
      <table class="table table-striped table-bordered tablaIndividual" width="100%">
        <tbody>
          <tr>
            <td width="20%" style="text-align:right;"><label for="campoITermianles">Input Terminales</label></td>
            <td width="80%"><textarea class="form-control" rows="3" id="campoITermianles"></textarea></td>
          </tr>
          <tr>
            <td style="text-align:right;"><label for="campoISenales">Input Señales</label></td>
            <td><textarea class="form-control" rows="3" id="campoISenales"></textarea></td>
          </tr>
          <tr>
            <td style="text-align:right;"><label for="campoILabels">Input Labels</label></td>
            <td><textarea class="form-control" rows="3" id="campoILabels"></textarea></td>
          </tr>
        </tbody>
      </table>
    </div>
    <!-- /.col-sm-6 -->
    <div class="col-sm-6">
      <div class="rowSeparator noTopMargin">OUTPUTS</div>
      <table class="table table-striped table-bordered tablaIndividual" width="100%">
        <tbody>
          <tr>
            <td width="20%" style="text-align:right;"><label for="campoOTermianles">Output Terminales</label></td>
            <td width="80%"><textarea class="form-control" rows="3" id="campoOTermianles"></textarea></td>
          </tr>
          <tr>
            <td style="text-align:right;"><label for="campoOSenales">Output Señales</label></td>
            <td><textarea class="form-control" rows="3" id="campoOSenales"></textarea></td>
          </tr>
          <tr>
            <td style="text-align:right;"><label for="campoOLabels">Output Labels</label></td>
            <td><textarea class="form-control" rows="3" id="campoOLabels"></textarea></td>
          </tr>
        </tbody>
      </table>
    </div>
    <!-- /.col-sm-6 -->
    </div>
    <!-- /.row -->
  
   <div class="row">
    <div class="col-sm-6">
      <div class="rowSeparator noTopMargin">ENV&iacute;O</div>
      <table class="table table-striped table-bordered tablaIndividual" width="100%">
        <tbody>
          <tr>
            <td width="20%" style="text-align:right;"><label for="campoDescCorta">Despachante por defecto</label></td>
            <td width="80%"><textarea class="form-control" rows="3" id="campoDescCorta"></textarea></td>
          </tr>
          <tr>
            <td style="text-align:right;"><label for="campoDescLarga">Envío por defecto</label></td>
            <td><textarea class="form-control" rows="3" id="campoDescLarga"></textarea></td>
          </tr>
          <tr>
            <td style="text-align:right;"><label for="campoDescLarga">Envío por defecto</label></td>
            <td><textarea class="form-control" rows="3" id="campoDescClientes"></textarea></td>
          </tr>
        </tbody>
      </table>
    </div>
    <!-- /.col-sm-6 -->
    <div class="col-sm-6">
      <div class="rowSeparator noTopMargin">otroOUTPUTS</div>
      <table class="table table-striped table-bordered tablaIndividual" width="100%">
        <tbody>
          <tr>
            <td width="20%" style="text-align:right;"><label for="campoDescCorta">Output Terminales</label></td>
            <td width="80%"><textarea class="form-control" rows="3" id="campoDescCorta"></textarea></td>
          </tr>
          <tr>
            <td style="text-align:right;"><label for="campoDescLarga">Output Señales</label></td>
            <td><textarea class="form-control" rows="3" id="campoDescLarga"></textarea></td>
          </tr>
          <tr>
            <td style="text-align:right;"><label for="campoDescClientes">Output Labels</label></td>
            <td><textarea class="form-control" rows="3" id="campoDescClientes"></textarea></td>
          </tr>
        </tbody>
      </table>
    </div>
    <!-- /.col-sm-6 -->
    </div>
    <!-- /.row -->
  
  <div class="row">
    <div class="col-sm-3">
      <div class="form-group">
        <label for="exampleInputEmail1">Model</label>
        <input type="model" class="form-control">
      </div>
    </div>
    <!-- /.col-sm-3 -->
    <div class="col-sm-3">
      <div class="form-group">
        <label for="exampleInputEmail1">Part Number</label>
        <input type="partNumber" class="form-control">
      </div>
    </div>
    <!-- /.col-sm-3 -->
    <div class="col-sm-3">
      <div class="form-group">
        <label for="exampleInputEmail1">Marca</label>
        <button type="button" class="btn btn-default btn-xs pull-right"><i class="fa fa-plus"></i> Agregar Marca</button>
        <select class="form-control">
          <option>Vantage</option>
          <option>RTI</option>
        </select>
      </div>
    </div>
    <!-- /.col-sm-3 -->
    <div class="col-sm-3">
      <div class="form-group">
        <label for="exampleInputEmail1">Proveedor</label>
        <button type="button" class="btn btn-default btn-xs pull-right"><i class="fa fa-plus"></i> Agregar Proveedor</button>
        <select class="form-control">
          <option>Vantage</option>
          <option>RTI</option>
        </select>
      </div>
    </div>
    <!-- /.col-sm-3 --> 
  </div>
  <!-- /.row -->
  <div class="rowSeparator">Descripciones</div>
  <div class="row">
    <div class="col-sm-6">
      <div class="form-group">
        <label for="exampleInputEmail1">Descripción Corta</label>
        <textarea class="form-control" rows="3"></textarea>
      </div>
    </div>
    <!-- /.col-sm-6 -->
    <div class="col-sm-6">
      <div class="form-group">
        <label for="exampleInputEmail1">Descripción Larga</label>
        <textarea class="form-control" rows="3"></textarea>
      </div>
    </div>
    <!-- /.col-sm-6 --> 
  </div>
  <!-- /.row -->
  <div class="row">
    <div class="col-sm-6">
      <div class="form-group">
        <label for="exampleInputEmail1">Descripción para Clientes</label>
        <textarea class="form-control" rows="3"></textarea>
      </div>
    </div>
    <!-- /.col-sm-6 -->
    <div class="col-sm-6">
      <div class="form-group">
        <label for="exampleInputEmail1">Descripción para Proveedores</label>
        <textarea class="form-control" rows="3"></textarea>
      </div>
    </div>
    <!-- /.col-sm-6 --> 
  </div>
  <!-- /.row -->
  <div class="rowSeparator">Extra</div>
  <div class="row">
    <div class="col-sm-3">
      <div class="form-group">
        <label for="exampleInputEmail1">Categoría</label>
        <select class="form-control">
          <option>Home Theater</option>
          <option>Tele</option>
        </select>
      </div>
    </div>
    <!-- /.col-sm-3 -->
    <div class="col-sm-3">
      <div class="form-group">
        <label for="exampleInputEmail1">Sub Categoría</label>
        <select class="form-control">
          <option>Audio</option>
          <option>Video</option>
        </select>
      </div>
    </div>
    <!-- /.col-sm-3 -->
    <div class="col-sm-3">
      <div class="form-group">
        <label for="exampleInputEmail1">Nomenclatura</label>
        <select class="form-control">
          <option>Sin Asignar</option>
          <option>DTools</option>
        </select>
      </div>
    </div>
    <!-- /.col-sm-3 -->
    <div class="col-sm-3">
      <div class="form-group">
        <label for="exampleInputEmail1">Tipo</label>
        <select class="form-control">
          <option>--</option>
          <option>Controller</option>
        </select>
      </div>
    </div>
    <!-- /.col-sm-3 --> 
  </div>
  <!-- /.row -->
  <div class="row">
    <div class="col-sm-3">
      <div class="form-group">
        <label for="exampleInputEmail1">Discontinuado</label>
        <div class="checkbox">
          <label>
            <input type="checkbox" value="">
            Yes </label>
        </div>
      </div>
    </div>
    <!-- /.col-sm-3 -->
    <div class="col-sm-3">
      <div class="form-group">
        <label for="exampleInputEmail1">Volts</label>
        <select class="form-control">
          <option>None</option>
          <option>110</option>
          <option>220</option>
        </select>
      </div>
    </div>
    <!-- /.col-sm-3 -->
    <div class="col-sm-2">
      <div class="form-group">
        <label for="exampleInputEmail1">Necesita Rack</label>
        <div class="checkbox">
          <label>
            <input type="checkbox" value="">
            Yes </label>
        </div>
      </div>
    </div>
    <!-- /.col-sm-2 -->
    <div class="col-sm-2">
      <div class="form-group">
        <label for="exampleInputEmail1">Unit Rack</label>
        <select class="form-control">
          <option>1</option>
          <option>2</option>
          <option>3</option>
        </select>
      </div>
    </div>
    <!-- /.col-sm-2 -->
    <div class="col-sm-2">
      <div class="form-group">
        <label for="exampleInputEmail1">Unit Fan</label>
        <select class="form-control">
          <option>1</option>
          <option>2</option>
          <option>3</option>
        </select>
      </div>
    </div>
    <!-- /.col-sm-2 --> 
  </div>
  <!-- /.row -->
  <div class="rowSeparator">Medidas</div>
  <div class="row">
    <div class="col-sm-3">
      <div class="form-group">
        <label for="exampleInputEmail1">Largo</label>
        <input type="partNumber" class="form-control" placeholder="0.0">
      </div>
    </div>
    <!-- /.col-sm-3 -->
    <div class="col-sm-3">
      <div class="form-group">
        <label for="exampleInputEmail1">Ancho</label>
        <input type="partNumber" class="form-control" placeholder="0.0">
      </div>
    </div>
    <!-- /.col-sm-3 -->
    <div class="col-sm-3">
      <div class="form-group">
        <label for="exampleInputEmail1">Alto</label>
        <input type="partNumber" class="form-control" placeholder="0.0">
      </div>
    </div>
    <!-- /.col-sm-3 -->
    <div class="col-sm-3">
      <div class="form-group">
        <label for="exampleInputEmail1">Volumen</label>
        <input type="partNumber" class="form-control" placeholder="000m3">
      </div>
    </div>
    <!-- /.col-sm-3 --> 
  </div>
  <!-- /.row -->
  <div class="rowSeparator">Precios</div>
  <div class="row">
    <div class="col-sm-3">
      <div class="form-group">
        <label for="exampleInputEmail1">Largo</label>
        <input type="partNumber" class="form-control" placeholder="0.0">
      </div>
    </div>
    <!-- /.col-sm-3 -->
    <div class="col-sm-3">
      <div class="form-group">
        <label for="exampleInputEmail1">Ancho</label>
        <input type="partNumber" class="form-control" placeholder="0.0">
      </div>
    </div>
    <!-- /.col-sm-3 -->
    <div class="col-sm-3">
      <div class="form-group">
        <label for="exampleInputEmail1">Alto</label>
        <input type="partNumber" class="form-control" placeholder="0.0">
      </div>
    </div>
    <!-- /.col-sm-3 -->
    <div class="col-sm-3">
      <div class="form-group">
        <label for="exampleInputEmail1">Volumen</label>
        <input type="partNumber" class="form-control" placeholder="000m3">
      </div>
    </div>
    <!-- /.col-sm-3 --> 
  </div>
  <!-- /.row -->
  <div class="row">
    <div class="col-sm-12">
      <div class="buttonsBottom">
        <button type="button" class="btn btn-default btn-lg"> Cancelar</button>
        <button type="button" class="btn btn-primary btn-lg"><i class="fa fa-save"></i> Guardar</button>
      </div>
    </div>
    <!-- /.col-sm-12 --> 
  </div>
  <!-- /.row --> 
</div>
<!-- /container --> 

<!-- Le javascript
    ================================================== --> 
<!-- Placed at the end of the document so the pages load faster --> 
<script src="js/bootstrap.min.js"></script>
</body>
</html>