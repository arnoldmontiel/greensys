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
<div class="container" id="screenProductos">
  <h1 class="pageTitle">Agregar Producto</h1>
    <div class="rowSeparator noTopMargin">Información Básica</div>
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
</select>        </div>
    </div>
    <!-- /.col-sm-3 --> 
    <div class="col-sm-3">
    <div class="form-group">
          <label for="exampleInputEmail1">Sub Categoría</label>
<select class="form-control">
  <option>Audio</option>
  <option>Video</option>
</select>        </div>
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
            Yes
          </label>
        </div>     </div>
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
            Yes
          </label>
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
    <div class="buttonsBottom"><button type="button" class="btn btn-default btn-lg"> Cancelar</button> <button type="button" class="btn btn-primary btn-lg"><i class="fa fa-save"></i> Guardar</button></div>
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