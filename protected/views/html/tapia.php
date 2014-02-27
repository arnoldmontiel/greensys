<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 dramaal//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="ROBOTS" content="NOINDEX, NOFOLLOW">
<title>TAPIA</title>
<!-- Bootstrap -->
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
<link rel="stylesheet" href="css/font-awesome.min.css">
<meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<?php include('estilos.php');?>
<script src="js/jquery.js"></script>

<script>

$(document).ready(function() {

	
	
$('#accordion').on('show.bs.collapse', function (e) {
  //  alert('Event fired on #' + e.currentTarget.id);
  
//$('body').stop(true,true).animate({ scrollTop: $(this).offset().top - 70}, 200);  

//var posTop = $(this).offset().top - 30;

//$('body').offset({ top: posTop, left: 0)});


 });
});

</script>
</head>
<body>
<?php 
$active='tinicio';
include('menuTapia.php');?>
<div class="container" id="screenMonitor">
<div class="row">
<div class="col-xs-6"><h1 class="pageTitle">Monitor</h1></div>
<div class="col-xs-6 clearfix"><input type="text" class="form-control pull-right formSearch" placeholder=" Buscar"></div>
</div>
  <div class="row">
    <div class="col-sm-12">
      
    <div class="panel-group" id="accordion">
  <div class="panel panel-default">
    <div class="panel-heading container-fluid">
    <div class="row">
    <div class="col-xs-6 text-left">  <h4 class="panel-title pull-left"><a data-toggle="collapse" data-parent="#accordion" href="#collapse1">Cohen - La Angostura</a></h4></div>
    <div class="col-xs-4 text-right"> 
    <div class="clearfix progressResumenMonitorNum">
      <span class="badge circleEjecucion pull-left">80</span> 
      <span class="badge circleStandBy">1</span>
      <span class="badge circlePendiente">1</span> 
      <span class="badge pull-right">10</span>
    </div> 
    <div class="progress progressResumenMonitor">
      <div class="progress-bar progress-bar-success" style="width: 80%">
      </div>
      <div class="progress-bar progress-bar-warning" style="width: 1%">
      </div>
      <div class="progress-bar progress-bar-danger" style="width: 1%">
      </div>
    </div></div>
    <div class="col-xs-2 text-right">    <button class="btn btn-default btn-sm pull-right"><i class="fa fa-plus"></i> Ver Proyecto</button>
    </div>
    </div>
    
    </div>
    <div id="collapse1" class="panel-collapse collapse in">
      <div class="panel-body container-fluid">
      <div class="row">
      <div class="col-md-9 col-sm-12">
      <ul class="nav nav-tabs navTabsMonitor">
  <li class="active"><a href="#">&Uacute;ltimas</a></li>
  <li><a href="#">Pendientes</a></li>
  <li><a href="#">Stand By</a></li>
  <li><a href="#">Activas</a></li>
  <li><a href="#">Finalizadas</a></li>
  <li class="visible-sm visible-xs"><a href="#">Gr&aacute;fico</a></li>
</ul>
<div class="tab-content">
<div class="tab-pane active">
      <ul class="list-group">
      <!-- Empieza Tarea -->
  <li href="#" class="list-group-item container-fluid">
  <div class="row">
  <div class="col-xs-8">
  <div class="pull-left"><div class="circle circlePendiente visible-sm visible-xs"></div> 
  <span class="circularLabel circlePendiente hidden-sm hidden-xs">Pendiente</span></div>
  <div class="pull-left monitorInfo">
   <a class="monitorInfoTitle">Instalaci&oacute;n de Pelicano en PC de Rack</a>
 11/12/2013 20:35:40 - Matias Montiel
 </div>
  </div>
  <div class="col-xs-4">
  <span class="label label-warning labelTask pull-left">Servicio T&eacute;cnico</span>
  <button class="btn btn-default pull-right btnDeleteMonitor"><i class="fa fa-trash-o"></i></button>
  </div>
  </div>
  </li>
      <!-- Termina Tarea -->
      <!-- Empieza Tarea -->
  <li href="#" class="list-group-item container-fluid">
 <div class="row">
  <div class="col-xs-8">
  <div class="pull-left"><div class="circle circleFinalizado visible-sm visible-xs"></div>
  <span class="circularLabel circleFinalizado hidden-sm hidden-xs">Finalizado</span></div>
  <div class="pull-left monitorInfo">
   <a class="monitorInfoTitle titleDone">Perforaci&oacute;n - Suite </a>
 11/12/2013 20:35:40 - Matias Montiel
 </div>
  </div>
  <div class="col-xs-4">
  <span class="label label-info labelTask pull-left">Pedido Cotizaci&oacute;n</span>
  <button class="btn btn-default pull-right btnDeleteMonitor"><i class="fa fa-trash-o"></i></button>
  </div>
  </div>  
  </li>
      <!-- Termina Tarea -->
      <!-- Empieza Tarea -->
  <li href="#" class="list-group-item container-fluid">
 <div class="row">
  <div class="col-xs-8">
  <div class="pull-left"><div class="circle circleFinalizado visible-sm visible-xs"></div>
  <span class="circularLabel circleFinalizado hidden-sm hidden-xs">Finalizado</span></div>
  <div class="pull-left monitorInfo">
   <a class="monitorInfoTitle titleDone">Agregar Iphone al sistema  </a>
 11/12/2013 20:35:40 - Matias Montiel
 </div>
  </div>
  <div class="col-xs-4">
  <span class="label label-info labelTask pull-left">Pedido Cotizaci&oacute;n</span>
  <button class="btn btn-default pull-right btnDeleteMonitor"><i class="fa fa-trash-o"></i></button>
  </div>
  </div>  
  </li>
      <!-- Termina Tarea -->
      <!-- Empieza Tarea -->
  <li href="#" class="list-group-item container-fluid">
 <div class="row">
  <div class="col-xs-8">
  <div class="pull-left"><div class="circle circleStandBy visible-sm visible-xs"></div>
  <span class="circularLabel circleStandBy hidden-sm hidden-xs">Stand By</span></div>
  <div class="pull-left monitorInfo">
   <a class="monitorInfoTitle">Instalaci&oacute;n de Pelicano en otro lado </a>
 11/12/2013 20:35:40 - Matias Montiel
 </div>
  </div>
  <div class="col-xs-4">
  <span class="label label-primary labelTask pull-left">Implementaci&oacute;n</span>
  <button class="btn btn-default pull-right btnDeleteMonitor"><i class="fa fa-trash-o"></i></button>
  </div>
  </div>  
  </li>
      <!-- Termina Tarea -->
      <!-- Empieza Tarea -->
  <li href="#" class="list-group-item container-fluid">
 <div class="row">
  <div class="col-xs-8">
  <div class="pull-left"><div class="circle circleEjecucion visible-sm visible-xs"></div>
  <span class="circularLabel circleEjecucion hidden-sm hidden-xs">En Ejecuci&oacute;n</span></div>
  <div class="pull-left monitorInfo">
   <a class="monitorInfoTitle">Apple TV no funciona en Ipad de Juan  </a>
 11/12/2013 20:35:40 - Matias Montiel
 </div>
  </div>
  <div class="col-xs-4">
  <span class="label label-info labelTask pull-left">Pedido Cotizaci&oacute;n</span>
  <button class="btn btn-default pull-right btnDeleteMonitor"><i class="fa fa-trash-o"></i></button>
  </div>
  </div>  
  </li>
      <!-- Termina Tarea -->
</ul>
      </div>
     
      </div>
            </div>
      <div class="col-md-3 hidden-sm hidden-xs align-center"><img src="img/pieChart.jpg" style="margin-top:40px;"/></div>
    </div>
    </div><!-- /tab-pane -->
    </div><!-- /tab-content -->
  </div><!-- /panel-default -->
  
  
    <div class="panel panel-default">
    <div class="panel-heading container-fluid">
    <div class="row">
    <div class="col-xs-6 text-left">  <h4 class="panel-title pull-left"><a data-toggle="collapse" data-parent="#accordion" href="#collapse2">Proyecto 2</a></h4></div>
    <div class="col-xs-4 text-right"> 
    <div class="clearfix progressResumenMonitorNum">
      <span class="badge circleEjecucion pull-left">5</span> 
      <span class="badge circleStandBy">5</span>
      <span class="badge circlePendiente">5</span> 
      <span class="badge pull-right">85</span>
    </div> 
    <div class="progress progressResumenMonitor">
      <div class="progress-bar progress-bar-success" style="width: 5%">
      </div>
      <div class="progress-bar progress-bar-warning" style="width: 5%">
      </div>
      <div class="progress-bar progress-bar-danger" style="width: 5%">
      </div>
    </div></div>
    <div class="col-xs-2 text-right">    <button class="btn btn-default btn-sm pull-right"><i class="fa fa-plus"></i> Ver Proyecto</button>
    </div>
    </div>
    
    </div>
    <div id="collapse2" class="panel-collapse collapse">
      <div class="panel-body container-fluid">
      <div class="row">
      <div class="col-md-9 col-sm-12">
      <ul class="nav nav-tabs navTabsMonitor">
  <li class="active"><a href="#">&Uacute;ltimas</a></li>
  <li><a href="#">Pendientes</a></li>
  <li><a href="#">Stand By</a></li>
  <li><a href="#">Activas</a></li>
  <li><a href="#">Finalizadas</a></li>
  <li class="visible-sm visible-xs"><a href="#">Gr&aacute;fico</a></li>
</ul>
<div class="tab-content">
<div class="tab-pane active">
      <ul class="list-group">
      <!-- Empieza Tarea -->
  <li href="#" class="list-group-item container-fluid">
  <div class="row">
  <div class="col-xs-8">
  <div class="pull-left"><div class="circle circlePendiente visible-sm visible-xs"></div> 
  <span class="circularLabel circlePendiente hidden-sm hidden-xs">Pendiente</span></div>
  <div class="pull-left monitorInfo">
   <a class="monitorInfoTitle">Instalaci&oacute;n de Pelicano en PC de Rack</a>
 11/12/2013 20:35:40 - Matias Montiel
 </div>
  </div>
  <div class="col-xs-4">
  <span class="label label-warning labelTask pull-left">Servicio T&eacute;cnico</span>
  <button class="btn btn-default pull-right btnDeleteMonitor"><i class="fa fa-trash-o"></i></button>
  </div>
  </div>
  </li>
      <!-- Termina Tarea -->
      <!-- Empieza Tarea -->
  <li href="#" class="list-group-item container-fluid">
 <div class="row">
  <div class="col-xs-8">
  <div class="pull-left"><div class="circle circleFinalizado visible-sm visible-xs"></div>
  <span class="circularLabel circleFinalizado hidden-sm hidden-xs">Finalizado</span></div>
  <div class="pull-left monitorInfo">
   <a class="monitorInfoTitle titleDone">Perforaci&oacute;n - Suite </a>
 11/12/2013 20:35:40 - Matias Montiel
 </div>
  </div>
  <div class="col-xs-4">
  <span class="label label-info labelTask pull-left">Pedido Cotizaci&oacute;n</span>
  <button class="btn btn-default pull-right btnDeleteMonitor"><i class="fa fa-trash-o"></i></button>
  </div>
  </div>  
  </li>
      <!-- Termina Tarea -->
      <!-- Empieza Tarea -->
  <li href="#" class="list-group-item container-fluid">
 <div class="row">
  <div class="col-xs-8">
  <div class="pull-left"><div class="circle circleFinalizado visible-sm visible-xs"></div>
  <span class="circularLabel circleFinalizado hidden-sm hidden-xs">Finalizado</span></div>
  <div class="pull-left monitorInfo">
   <a class="monitorInfoTitle titleDone">Agregar Iphone al sistema  </a>
 11/12/2013 20:35:40 - Matias Montiel
 </div>
  </div>
  <div class="col-xs-4">
  <span class="label label-info labelTask pull-left">Pedido Cotizaci&oacute;n</span>
  <button class="btn btn-default pull-right btnDeleteMonitor"><i class="fa fa-trash-o"></i></button>
  </div>
  </div>  
  </li>
      <!-- Termina Tarea -->
      <!-- Empieza Tarea -->
  <li href="#" class="list-group-item container-fluid">
 <div class="row">
  <div class="col-xs-8">
  <div class="pull-left"><div class="circle circleStandBy visible-sm visible-xs"></div>
  <span class="circularLabel circleStandBy hidden-sm hidden-xs">Stand By</span></div>
  <div class="pull-left monitorInfo">
   <a class="monitorInfoTitle">Instalaci&oacute;n de Pelicano en otro lado </a>
 11/12/2013 20:35:40 - Matias Montiel
 </div>
  </div>
  <div class="col-xs-4">
  <span class="label label-primary labelTask pull-left">Implementaci&oacute;n</span>
  <button class="btn btn-default pull-right btnDeleteMonitor"><i class="fa fa-trash-o"></i></button>
  </div>
  </div>  
  </li>
      <!-- Termina Tarea -->
      <!-- Empieza Tarea -->
  <li href="#" class="list-group-item container-fluid">
 <div class="row">
  <div class="col-xs-8">
  <div class="pull-left"><div class="circle circleEjecucion visible-sm visible-xs"></div>
  <span class="circularLabel circleEjecucion hidden-sm hidden-xs">En Ejecuci&oacute;n</span></div>
  <div class="pull-left monitorInfo">
   <a class="monitorInfoTitle">Apple TV no funciona en Ipad de Juan  </a>
 11/12/2013 20:35:40 - Matias Montiel
 </div>
  </div>
  <div class="col-xs-4">
  <span class="label label-info labelTask pull-left">Pedido Cotizaci&oacute;n</span>
  <button class="btn btn-default pull-right btnDeleteMonitor"><i class="fa fa-trash-o"></i></button>
  </div>
  </div>  
  </li>
      <!-- Termina Tarea -->
</ul>
      </div>
     
      </div>
            </div>
      <div class="col-md-3 hidden-sm hidden-xs align-center"><img src="img/pieChart.jpg" style="margin-top:40px;"/></div>
    </div>
    </div><!-- /tab-pane -->
    </div><!-- /tab-content -->
  </div><!-- /panel-default -->
  
  <div class="panel panel-default">
    <div class="panel-heading container-fluid">
    <div class="row">
    <div class="col-xs-6 text-left">  <h4 class="panel-title pull-left"><a data-toggle="collapse" data-parent="#accordion" href="#collapse3">Proyecto 3</a></h4></div>
    <div class="col-xs-4 text-right"> 
    <div class="clearfix progressResumenMonitorNum">
      <span class="badge circleEjecucion pull-left">90</span> 
      <span class="badge circleStandBy">0</span>
      <span class="badge circlePendiente">0</span> 
      <span class="badge pull-right">10</span>
    </div> 
    <div class="progress progressResumenMonitor">
      <div class="progress-bar progress-bar-success" style="width: 90%">
      </div>
      <div class="progress-bar progress-bar-warning" style="width: 0%">
      </div>
      <div class="progress-bar progress-bar-danger" style="width: 0%">
      </div>
    </div></div>
    <div class="col-xs-2 text-right">    <button class="btn btn-default btn-sm pull-right"><i class="fa fa-plus"></i> Ver Proyecto</button>
    </div>
    </div>
    </div>
    <div id="collapse3" class="panel-collapse collapse">
      <div class="panel-body">
   contenido
   </div><!-- /panel-body -->
   </div><!-- /panel-collapse -->
  </div><!-- /panel-default -->
 
</div><!-- /panel-group -->     
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