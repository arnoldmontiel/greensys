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
$active='inicio';
include('menu.php');?>
<ol class="breadcrumb">
  <li class="active"><a href="#">Dashboard</a></li>
</ol>
<div class="container" id="screenInicio">
  <h1 class="pageTitle">Dashboard</h1>
  <div class="row">
    <div class="col-md-8">
      <div class="row">
        <div class="col-md-6">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title"><i class="fa fa-star fa-fw"></i> Productos</h3>
            </div>
            <div class="panel-body">
              <div class="list-group"> <a href="#" class="list-group-item">Ver Productos <i class="fa fa-list fa-fw pull-right"></i></a> <a href="agregarProducto.php" class="list-group-item">Agregar Producto <i class="fa fa-plus fa-fw pull-right"></i></a> <a href="#" class="list-group-item">Ver Pendientes <i class="fa fa-warning fa-fw pull-right"></i></a>  <a href="#" class="list-group-item">Ver Excel de Marcas <i class="fa fa-list fa-fw pull-right"></i></a><a href="#" class="list-group-item">Cargar Excel de Marca <i class="fa fa-upload fa-fw pull-right"></i></a> </div>
            </div>
          </div>
        </div>
        <!-- /.col-md-6 -->
        <div class="col-md-6">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title"><i class="fa fa-book fa-fw"></i> Listas de Precios</h3>
            </div>
            <div class="panel-body">
              <div class="list-group"> <a href="#" class="list-group-item">Ver Precios Compra <i class="fa fa-list fa-fw pull-right"></i></a> <a href="#" class="list-group-item">Ver Precios Venta <i class="fa fa-list fa-fw pull-right"></i></a> </div>
            </div>
          </div>
        </div>
        <!-- /.col-md-6 --> 
      </div>
      <!-- /.row -->
      <div class="row">
        <div class="col-md-6">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title"><i class="fa fa-building fa-fw"></i> Proyectos</h3>
            </div>
            <div class="panel-body">
              <div class="list-group"> <a href="#" class="list-group-item">Ver Proyectos <i class="fa fa-list fa-fw pull-right"></i></a> <a href="#" class="list-group-item">Crear Proyecto <i class="fa fa-plus fa-fw pull-right"></i></a> </div>
            </div>
          </div>
        </div>
        <!-- /.col-md-6 -->
        <div class="col-md-6">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title"><i class="fa fa-truck fa-fw"></i> Proveedores</h3>
            </div>
            <div class="panel-body">
              <div class="list-group"> <a href="#" class="list-group-item">Ver Proveedores <i class="fa fa-list fa-fw pull-right"></i></a> <a href="#" class="list-group-item">Crear Proveedor <i class="fa fa-plus fa-fw pull-right"></i></a> </div>
            </div>
          </div>
        </div>
        <!-- /.col-md-6 --> 
      </div>
      <!-- /.row -->
      <div class="row">
        <div class="col-md-6">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title"><i class="fa fa-glass fa-fw"></i> Clientes</h3>
            </div>
            <div class="panel-body">
              <div class="list-group"> <a href="#" class="list-group-item">Ver Clientes <i class="fa fa-list fa-fw pull-right"></i></a> <a href="#" class="list-group-item">Crear Cliente <i class="fa fa-plus fa-fw pull-right"></i></a> </div>
            </div>
          </div>
        </div>
        <!-- /.col-md-6 -->
        <div class="col-md-6">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title"><i class="fa fa-dollar fa-fw"></i> Presupuestos</h3>
            </div>
            <div class="panel-body">
              <div class="list-group"> <a href="#" class="list-group-item">Ver Presupuestos <i class="fa fa-list fa-fw pull-right"></i></a> <a href="#" class="list-group-item">Crear Presupuesto <i class="fa fa-plus fa-fw pull-right"></i></a> </div>
            </div>
          </div>
        </div>
        <!-- /.col-md-6 --> 
      </div>
      <!-- /.row --> 
    </div>
    <!-- /.col-md-8 -->
    
    <div class="col-md-4">
      <div class="panel panel-success">
        <div class="panel-heading">
          <h3 class="panel-title"><i class="fa fa-cog fa-fw"></i> GREEN Setup</h3>
        </div>
        <div class="panel-body">
          <p>Completa los siguientes pasos en orden para comenzar a presupuestar:</p>
        </div>
<ul class="list-group">
<li class="list-group-item"><span class="listNumber done">1</span> Cargar Productos <span class="label label-success pull-right"><i class="fa fa-check fa-fw"></i> Hecho</span></li>
  <li class="list-group-item"><span class="listNumber">2</span> Cargar Marcas <button type="button" class="btn btn-default pull-right">Completar</button></li>
  <li class="list-group-item"><span class="listNumber">3</span> Cargar Clientes <button type="button" class="btn btn-default pull-right">Completar</button></li>
  <li class="list-group-item"><span class="listNumber">4</span> Cargar Excel de Marca <button type="button" class="btn btn-default pull-right">Completar</button></li>
</ul>
        </div>
    <!-- /.panel-body -->
    </div>
    <!-- /.col-md-4 --> 
    
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