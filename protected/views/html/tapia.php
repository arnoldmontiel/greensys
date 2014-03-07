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
<!-- Modernizr -->
<script src="js/modernizr.js"></script>
<!-- FastClick -->
<script src="js/fastclick.js"></script>

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
<div class="col-sm-6 col-xs-12 col-nexus-6 hidden-xs"><h1 class="pageTitle">Monitor</h1></div>
<div class="col-sm-6 col-xs-12 col-nexus-6 text-right "><input type="text" class="form-control formSearch" placeholder=" Buscar"></div>
</div>
  <div class="row">
    <div class="col-sm-12">
      
    <div class="panel-group" id="accordion">
  <div class="panel panel-default">
    <div class="panel-heading container-fluid">
    <div class="row">
    <div class="col-sm-6 col-xs-10 col-nexus-6 text-left">  <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapse1">Cohen - La Angostura</a></h4></div>
    <div class="col-sm-4 col-nexus-4 text-right hidden-xs"> 
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
    <div class="col-sm-2 col-nexus-2 text-right">    
    <button class="btn btn-default btn-sm pull-right hidden-xs"><i class="fa fa-arrow-circle-right"></i> Ver Proyecto</button>
    <button class="btn btn-default btn-xs pull-right hidden-nexus visible-xs"><i class="fa fa-arrow-circle-right"></i></button>
    </div>
    </div>
    
    </div>
    <div id="collapse1" class="panel-collapse collapse in">
      <div class="panel-body container-fluid">
      <div class="row">
      <div class="col-md-9 col-sm-12">
      <div class="progressInternal visible-xs hidden-nexus">
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
    </div>
      </div>
            <ul class="nav nav-tabs navTabsMonitor hidden-xs">
  <li class="active"><a href="#">&Uacute;ltimas</a></li>
  <li><a href="#">Pendientes</a></li>
  <li><a href="#">Stand By</a></li>
  <li><a href="#">Activas</a></li>
  <li><a href="#">Finalizadas</a></li>
  <li class="visible-sm visible-nexus"><a href="#">Gr&aacute;fico</a></li>
</ul>
<div class="tab-content">
<div class="tab-pane active">
      <ul class="list-group">
     <!-- Empieza Tarea -->
  <li class="list-group-item line linePendiente" data-toggle="modal" data-target="#myModalDetalle">
  <div class="circle circlePendiente visible-sm visible-nexus"></div> 
  <div class="circularLabel circlePendiente pull-left hidden-sm hidden-xs">Finalizado</div>
    <div class="labelTaskMobile labelTaskMobilePedido visible-xs hidden-nexus">Pedido Cotizaci&oacute;n <span class="labelTaskMobileDate pull-right">20/10/2012 30:09:10</span></div>
  <div class=" monitorInfo" >
   <a class="monitorInfoTitle">Instalaci&oacute;n de Pelicano en PC de Rack  </a> <span class="iconsGroup"><img src="img/iconSet/circlePDF20.png" />  <img src="img/iconSet/circleW20.png" /> <img src="img/iconSet/circleX20.png" /> <img src="img/iconSet/circleIMG20.png" /> <img src="img/iconSet/circleCAD20.png" /></span>
  <div class="monitorDates"> 
 <span class="label label-default labelDate visible-xs-inline">UPD</span>  
 <span class="label label-default labelDate hidden-xs-inline">UPDATED</span>
 <span class="monitorDate">11/12/2013 30:12:23  - <strong>Matias Montiel</strong> </span>
 </div>     
  </div>
     <span class="label label-info labelTask hidden-xs">Pedido Cotizaci&oacute;n <br/> 20/10/2012 30:09:10</span>
  </li>
      <!-- Termina Tarea -->
  
      <!-- Empieza Tarea -->
  <li class="list-group-item line lineEjecucion odd">
 <div class="circle circleEjecucion visible-sm visible-nexus"></div> 
  <div class="circularLabel circleEjecucion pull-left hidden-sm hidden-xs">En Ejecucion</div>
      <div class="labelTaskMobile labelTaskMobileServicio visible-xs hidden-nexus">Servicio T&eacute;cnico<span class="labelTaskMobileDate pull-right">20/10/2012 30:09:10</span></div>
  <div class=" monitorInfo" >
   <a class="monitorInfoTitle">Perforacion Suite</a> <span class="iconsGroup"></span>
 <div class="monitorDates"> 
 <span class="label label-default labelDate visible-xs-inline">UPD</span>  
 <span class="label label-default labelDate hidden-xs-inline">UPDATED</span>
 <span class="monitorDate">11/12/2013 30:12:23  - <strong>Matias Montiel</strong> </span>
 </div>
      </div>
     <span class="label label-warning labelTask hidden-xs">Servicio T&eacute;cnico <br/> 20/10/2012 30:09:10</span>
  </li>
      <!-- Termina Tarea -->
      <!-- Empieza Tarea -->
  <li class="list-group-item line lineEjecucion ">
 <div class="circle circleEjecucion visible-sm visible-nexus"></div> 
  <div class="circularLabel circleEjecucion pull-left hidden-sm hidden-xs">En Ejecucion</div>
  <div class="labelTaskMobile labelTaskMobileImplementacion visible-xs hidden-nexus">Implementaci&oacute;n<span class="labelTaskMobileDate pull-right">20/10/2012 30:09:10</span></div>
  <div class=" monitorInfo" >
   <a class="monitorInfoTitle">Agregar Iphone al sistema  </a> <span class="iconsGroup"><img src="img/iconSet/circleW20.png" /> <img src="img/iconSet/circleX20.png" /></span>
 <div class="monitorDates"> 
 <span class="label label-default labelDate visible-xs-inline">UPD</span>  
 <span class="label label-default labelDate hidden-xs-inline">UPDATED</span>
 <span class="monitorDate">11/12/2013 30:12:23  - <strong>Matias Montiel</strong> </span>
 </div>     
  </div>
     <span class="label label-primary labelTask hidden-xs">Implementacion<br/> 20/10/2012 30:09:10</span>
     </li>
      <!-- Termina Tarea -->
      <!-- Empieza Tarea -->
  <li class="list-group-item line lineStandBy odd">
 <div class="circle circleStandBy visible-sm visible-nexus"></div> 
  <div class="circularLabel circleStandBy pull-left hidden-sm hidden-xs">Stand By</div>
    <div class="labelTaskMobile labelTaskMobileImplementacion visible-xs hidden-nexus">Implementaci&oacute;n<span class="labelTaskMobileDate pull-right">20/10/2012 30:09:10</span></div>
  <div class=" monitorInfo" >
   <a class="monitorInfoTitle">Comprar nuevos parlantes  </a> <span class="iconsGroup"><img src="img/iconSet/circleIMG20.png" /></span>
 <div class="monitorDates"> 
 <span class="label label-default labelDate visible-xs-inline">UPD</span>  
 <span class="label label-default labelDate hidden-xs-inline">UPDATED</span>
 <span class="monitorDate">11/12/2013 30:12:23  - <strong>Matias Montiel</strong> </span>
 </div>     
   </div>
     <span class="label label-primary labelTask hidden-xs">Implementacion<br/> 20/10/2012 30:09:10</span>
  </li>
      <!-- Termina Tarea -->
</ul>
      </div>
     
      </div>
            </div>
      <div class="col-md-3 col-nexus-3 hidden-sm hidden-xs visible-nexus align-center"><img src="img/pieChart.jpg" style="margin-top:40px;"/></div>
    </div>
    </div><!-- /tab-pane -->
    </div><!-- /tab-content -->
  </div><!-- /panel-default -->
  
  
    <div class="panel panel-default">
    <div class="panel-heading container-fluid">
    <div class="row">
    <div class="col-sm-6 col-xs-10 col-nexus-6 text-left">  <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapse2">Proyecto 2</a></h4></div>
        <div class="col-xs-4 col-nexus-4 text-right hidden-xs"> 
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
    <div class="col-sm-2 col-nexus-2 text-right">    
    <button class="btn btn-default btn-sm pull-right hidden-xs"><i class="fa fa-arrow-circle-right"></i> Ver Proyecto</button>
    <button class="btn btn-default btn-xs pull-right visible-xs hidden-nexus"><i class="fa fa-arrow-circle-right"></i></button>
    </div>
    </div>
    
    </div>
    <div id="collapse2" class="panel-collapse collapse">
      <div class="panel-body container-fluid">
      <div class="row">
      <div class="col-md-9 col-sm-12">
      <div class="progressInternal visible-xs hidden-nexus">
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
    </div>
      </div>
            <ul class="nav nav-tabs navTabsMonitor hidden-xs">
  <li class="active"><a href="#">&Uacute;ltimas</a></li>
  <li><a href="#">Pendientes</a></li>
  <li><a href="#">Stand By</a></li>
  <li><a href="#">Activas</a></li>
  <li><a href="#">Finalizadas</a></li>
  <li class="visible-sm visible-nexus"><a href="#">Gr&aacute;fico</a></li>
</ul>
<div class="tab-content">
<div class="tab-pane active">
      <ul class="list-group">
     <!-- Empieza Tarea -->
  <li class="list-group-item line linePendiente ">
  <div class="circle circlePendiente visible-sm visible-nexus"></div> 
  <div class="circularLabel circlePendiente pull-left hidden-sm hidden-xs">Finalizado</div>
    <div class="labelTaskMobile labelTaskMobilePedido visible-xs hidden-nexus">Pedido Cotizaci&oacute;n <span class="labelTaskMobileDate pull-right">20/10/2012 30:09:10</span></div>
  <div class=" monitorInfo" >
   <a class="monitorInfoTitle">Instalaci&oacute;n de Pelicano en PC de Rack  </a> <span class="iconsGroup"><img src="img/iconSet/circlePDF20.png" />  <img src="img/iconSet/circleW20.png" /> <img src="img/iconSet/circleX20.png" /> <img src="img/iconSet/circleIMG20.png" /> <img src="img/iconSet/circleCAD20.png" /></span>
  <div class="monitorDates"> 
 <span class="label label-default labelDate visible-xs-inline">UPD</span>  
 <span class="label label-default labelDate hidden-xs-inline">UPDATED</span>
 <span class="monitorDate">11/12/2013 30:12:23  - <strong>Matias Montiel</strong> </span>
 </div>     
  </div>
     <span class="label label-info labelTask hidden-xs">Pedido Cotizaci&oacute;n <br/> 20/10/2012 30:09:10</span>
  </li>
      <!-- Termina Tarea -->
  
      <!-- Empieza Tarea -->
  <li class="list-group-item line lineEjecucion odd">
 <div class="circle circleEjecucion visible-sm visible-nexus"></div> 
  <div class="circularLabel circleEjecucion pull-left hidden-sm hidden-xs">En Ejecucion</div>
      <div class="labelTaskMobile labelTaskMobileServicio visible-xs hidden-nexus">Servicio T&eacute;cnico<span class="labelTaskMobileDate pull-right">20/10/2012 30:09:10</span></div>
  <div class=" monitorInfo" >
   <a class="monitorInfoTitle">Perforacion Suite</a> <span class="iconsGroup"></span>
 <div class="monitorDates"> 
 <span class="label label-default labelDate visible-xs-inline">UPD</span>  
 <span class="label label-default labelDate hidden-xs-inline">UPDATED</span>
 <span class="monitorDate">11/12/2013 30:12:23  - <strong>Matias Montiel</strong> </span>
 </div>
      </div>
     <span class="label label-warning labelTask hidden-xs">Servicio T&eacute;cnico <br/> 20/10/2012 30:09:10</span>
  </li>
      <!-- Termina Tarea -->
      <!-- Empieza Tarea -->
  <li class="list-group-item line lineEjecucion ">
 <div class="circle circleEjecucion visible-sm visible-nexus"></div> 
  <div class="circularLabel circleEjecucion pull-left hidden-sm hidden-xs">En Ejecucion</div>
  <div class="labelTaskMobile labelTaskMobileImplementacion visible-xs hidden-nexus">Implementaci&oacute;n<span class="labelTaskMobileDate pull-right">20/10/2012 30:09:10</span></div>
  <div class=" monitorInfo" >
   <a class="monitorInfoTitle">Agregar Iphone al sistema  </a> <span class="iconsGroup"><img src="img/iconSet/circleW20.png" /> <img src="img/iconSet/circleX20.png" /></span>
 <div class="monitorDates"> 
 <span class="label label-default labelDate visible-xs-inline">UPD</span>  
 <span class="label label-default labelDate hidden-xs-inline">UPDATED</span>
 <span class="monitorDate">11/12/2013 30:12:23  - <strong>Matias Montiel</strong> </span>
 </div>     
  </div>
     <span class="label label-primary labelTask hidden-xs">Implementacion<br/> 20/10/2012 30:09:10</span>
     </li>
      <!-- Termina Tarea -->
      <!-- Empieza Tarea -->
  <li class="list-group-item line lineStandBy odd">
 <div class="circle circleStandBy visible-sm visible-nexus"></div> 
  <div class="circularLabel circleStandBy pull-left hidden-sm hidden-xs">Stand By</div>
    <div class="labelTaskMobile labelTaskMobileImplementacion visible-xs hidden-nexus">Implementaci&oacute;n<span class="labelTaskMobileDate pull-right">20/10/2012 30:09:10</span></div>
  <div class=" monitorInfo" >
   <a class="monitorInfoTitle">Comprar nuevos parlantes  </a> <span class="iconsGroup"><img src="img/iconSet/circleIMG20.png" /></span>
 <div class="monitorDates"> 
 <span class="label label-default labelDate visible-xs-inline">UPD</span>  
 <span class="label label-default labelDate hidden-xs-inline">UPDATED</span>
 <span class="monitorDate">11/12/2013 30:12:23  - <strong>Matias Montiel</strong> </span>
 </div>     
   </div>
     <span class="label label-primary labelTask hidden-xs">Implementacion<br/> 20/10/2012 30:09:10</span>
  </li>
      <!-- Termina Tarea -->
</ul>
      </div>
     
      </div>
            </div>
      <div class="col-md-3 col-nexus-3 hidden-sm hidden-xs visible-nexus align-center"><img src="img/pieChart.jpg" style="margin-top:40px;"/></div>
    </div>
    </div><!-- /tab-pane -->
    </div><!-- /tab-content -->
  </div><!-- /panel-default -->
  
  <div class="panel panel-default">
    <div class="panel-heading container-fluid">
    <div class="row">
    <div class="col-sm-6 col-xs-10 col-nexus-6 text-left">  <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapse3">Proyecto 3</a></h4></div>
      <div class="col-xs-4 col-nexus-4 text-right hidden-xs"> 
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
    <div class="col-sm-2 text-right col-nexus-2">    
    <button class="btn btn-default btn-sm pull-right hidden-xs"><i class="fa fa-arrow-circle-right"></i> Ver Proyecto</button>
    <button class="btn btn-default btn-xs pull-right visible-xs hidden-nexus"><i class="fa fa-arrow-circle-right"></i></button>
    </div>
    </div>
    </div>
    <div id="collapse3" class="panel-collapse collapse">
      <div class="panel-body container-fluid">
      <div class="row">
      <div class="col-md-9 col-sm-12">
      <div class="progressInternal visible-xs hidden-nexus">
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
    </div>
      </div>
            <ul class="nav nav-tabs navTabsMonitor hidden-xs">
  <li class="active"><a href="#">&Uacute;ltimas</a></li>
  <li><a href="#">Pendientes</a></li>
  <li><a href="#">Stand By</a></li>
  <li><a href="#">Activas</a></li>
  <li><a href="#">Finalizadas</a></li>
  <li class="visible-sm visible-nexus"><a href="#">Gr&aacute;fico</a></li>
</ul>
<div class="tab-content">
<div class="tab-pane active">
      <ul class="list-group">
     <!-- Empieza Tarea -->
  <li class="list-group-item line linePendiente ">
  <div class="circle circlePendiente visible-sm visible-nexus"></div> 
  <div class="circularLabel circlePendiente pull-left hidden-sm hidden-xs">Finalizado</div>
    <div class="labelTaskMobile labelTaskMobilePedido visible-xs hidden-nexus">Pedido Cotizaci&oacute;n <span class="labelTaskMobileDate pull-right">20/10/2012 30:09:10</span></div>
  <div class=" monitorInfo" >
   <a class="monitorInfoTitle">Instalaci&oacute;n de Pelicano en PC de Rack  </a> <span class="iconsGroup"><img src="img/iconSet/circlePDF20.png" />  <img src="img/iconSet/circleW20.png" /> <img src="img/iconSet/circleX20.png" /> <img src="img/iconSet/circleIMG20.png" /> <img src="img/iconSet/circleCAD20.png" /></span>
  <div class="monitorDates"> 
 <span class="label label-default labelDate visible-xs-inline">UPD</span>  
 <span class="label label-default labelDate hidden-xs-inline">UPDATED</span>
 <span class="monitorDate">11/12/2013 30:12:23  - <strong>Matias Montiel</strong> </span>
 </div>     
  </div>
     <span class="label label-info labelTask hidden-xs">Pedido Cotizaci&oacute;n <br/> 20/10/2012 30:09:10</span>
  </li>
      <!-- Termina Tarea -->
  
      <!-- Empieza Tarea -->
  <li class="list-group-item line lineEjecucion odd">
 <div class="circle circleEjecucion visible-sm visible-nexus"></div> 
  <div class="circularLabel circleEjecucion pull-left hidden-sm hidden-xs">En Ejecucion</div>
      <div class="labelTaskMobile labelTaskMobileServicio visible-xs hidden-nexus">Servicio T&eacute;cnico<span class="labelTaskMobileDate pull-right">20/10/2012 30:09:10</span></div>
  <div class=" monitorInfo" >
   <a class="monitorInfoTitle">Perforacion Suite</a> <span class="iconsGroup"></span>
 <div class="monitorDates"> 
 <span class="label label-default labelDate visible-xs-inline">UPD</span>  
 <span class="label label-default labelDate hidden-xs-inline">UPDATED</span>
 <span class="monitorDate">11/12/2013 30:12:23  - <strong>Matias Montiel</strong> </span>
 </div>
      </div>
     <span class="label label-warning labelTask hidden-xs">Servicio T&eacute;cnico <br/> 20/10/2012 30:09:10</span>
  </li>
      <!-- Termina Tarea -->
      <!-- Empieza Tarea -->
  <li class="list-group-item line lineEjecucion ">
 <div class="circle circleEjecucion visible-sm visible-nexus"></div> 
  <div class="circularLabel circleEjecucion pull-left hidden-sm hidden-xs">En Ejecucion</div>
  <div class="labelTaskMobile labelTaskMobileImplementacion visible-xs hidden-nexus">Implementaci&oacute;n<span class="labelTaskMobileDate pull-right">20/10/2012 30:09:10</span></div>
  <div class=" monitorInfo" >
   <a class="monitorInfoTitle">Agregar Iphone al sistema  </a> <span class="iconsGroup"><img src="img/iconSet/circleW20.png" /> <img src="img/iconSet/circleX20.png" /></span>
 <div class="monitorDates"> 
 <span class="label label-default labelDate visible-xs-inline">UPD</span>  
 <span class="label label-default labelDate hidden-xs-inline">UPDATED</span>
 <span class="monitorDate">11/12/2013 30:12:23  - <strong>Matias Montiel</strong> </span>
 </div>     
  </div>
     <span class="label label-primary labelTask hidden-xs">Implementacion<br/> 20/10/2012 30:09:10</span>
     </li>
      <!-- Termina Tarea -->
      <!-- Empieza Tarea -->
  <li class="list-group-item line lineStandBy odd">
 <div class="circle circleStandBy visible-sm visible-nexus"></div> 
  <div class="circularLabel circleStandBy pull-left hidden-sm hidden-xs">Stand By</div>
    <div class="labelTaskMobile labelTaskMobileImplementacion visible-xs hidden-nexus">Implementaci&oacute;n<span class="labelTaskMobileDate pull-right">20/10/2012 30:09:10</span></div>
  <div class=" monitorInfo" >
   <a class="monitorInfoTitle">Comprar nuevos parlantes  </a> <span class="iconsGroup"><img src="img/iconSet/circleIMG20.png" /></span>
 <div class="monitorDates"> 
 <span class="label label-default labelDate visible-xs-inline">UPD</span>  
 <span class="label label-default labelDate hidden-xs-inline">UPDATED</span>
 <span class="monitorDate">11/12/2013 30:12:23  - <strong>Matias Montiel</strong> </span>
 </div>     
   </div>
     <span class="label label-primary labelTask hidden-xs">Implementacion<br/> 20/10/2012 30:09:10</span>
  </li>
      <!-- Termina Tarea -->
</ul>
      </div>
     
      </div>
            </div>
      <div class="col-md-3 col-nexus-3 hidden-sm hidden-xs visible-nexus align-center"><img src="img/pieChart.jpg" style="margin-top:40px;"/></div>
    </div>
    </div><!-- /tab-pane -->
   </div><!-- /panel-collapse -->
  </div><!-- /panel-default -->
 
</div><!-- /panel-group -->     
    </div>
    <!-- /.col-sm-12 -->
  </div>
  <!-- /.row --> 
</div>
<!-- /container --> 


<div id="myModalDetalle" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" >  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> <i class="fa fa-times-circle fa-lg"></i></button>
              <h4 class="modal-title">Instalaci&oacute;n de Pelicano en PC de Rack</h4>
      </div>
      <div class="modal-body">
      <div class="modalMonitorEstados clearfix">
      <div class="label label-primary visible-xs modalMonitorLabel">Pedido de Cotizaci&oacute;n &bull; 20/10/2020</div>
      <span class="label label-primary pull-left hidden-xs">Pedido de Cotizaci&oacute;n &bull; 20/10/2020</span>
      <span class="label label-warning pull-right hidden-xs">Stand By</span>
      </div>
      <div class="modalMonitorBloque">
      <div class="row">
      <div class="col-sm-7 col-xs-12 ">
      <span class="label label-warning visible-xs modalMonitorLabelStatus">Stand By</span>
      <div class="modalMonitorProyecto">Cohen - La Angostura</div>
      <div class="modalMonitorTarea">Instalaci&oacute;n de Pelicano en PC de Rack</div>
      </div>
      <div class="col-sm-5 col-xs-12 text-right">
      <div class="modalMonitorButtons">
      <button id="btn-cancel" type="button" class="btn btn-primary btn-sm" data-dismiss="modal"><i class="fa fa-share-square-o"></i> Exportar</button>
      <button id="btn-cancel" type="button" class="btn btn-primary btn-sm" data-dismiss="modal"><i class="fa fa-times-circle"></i> Finalizar</button>
      </div>
      </div>
      </div>
      
      
      
      <ul class="list-group">
  <li class="list-group-item">
  <div class="modalMonitorAutor"><span class="lato">09/09/2013 12:34:57</span>  &bull; Matias Montiel</div>
    <div class="modalMonitorComment">PM solicito la instalacion de Pelicano en PC del Rack.</div>
  </li>
  <li class="list-group-item">
  <div class="modalMonitorAutor"><span class="lato">09/09/2013 12:34:57</span>  &bull; Matias Montiel</div>
      <div class="modalMonitorComment">PV ya coordino con Carlos Mu–oz para traer en una encomienda la PC.</div>
  <div class="modalMonitorArchivo"><img src="img/iconSet/circleW20.png" /> <a>archivoword.doc</a> (35kb) &raquo; desglose materiales</div>
  </li>
  
  <li class="list-group-item">
  <div class="modalMonitorAutor"><span class="lato">09/09/2013 12:34:57</span>  &bull; Matias Montiel</div>
    <div class="modalMonitorArchivo"><img src="img/iconSet/circleCAD20.png" /> <a>otroarchivodistinto.cad</a> (35kb) &raquo; Listado con todo lo que hay que hacer, texto que tengo que poner para ver si esto entra bien.
  </div>
  </li>
   <li class="list-group-item"><textarea class="form-control" rows="3">Escriba aqui...</textarea></li>
</ul>
</div>
      </div>
      <div class="modal-footer">
      <button id="btn-cancel" type="button" class="btn btn-default btn-lg" data-dismiss="modal">Cerrar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->

  </div>




<!-- Le javascript
    ================================================== --> 
<!-- Placed at the end of the document so the pages load faster --> 
<script src="js/bootstrap.min.js"></script>
</body>
</html>