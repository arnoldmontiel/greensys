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
</head>
<body>
<?php 
$active='tinicio';
include('menuTapia.php');?>
<div class="container" id="screenMonitor">
  <h1 class="pageTitle">Monitor</h1>
  <div class="row">
    <div class="col-md-12">
      
    <div class="panel-group" id="accordion">
  <div class="panel panel-default">
    <div class="panel-heading">
    
    <div class="row">
    <div class="col-md-6 text-left">  <h4 class="panel-title pull-left"><a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Cohen - La Angostura</a></h4></div>
    <div class="col-md-4 text-right">  <div class="progress progressResumenMonitor">
      <div class="progress-bar progress-bar-success" style="width: 35%">
        <span class="sr-only">35% Complete (success)</span>
      </div>
      <div class="progress-bar progress-bar-warning" style="width: 20%">
        <span class="sr-only">20% Complete (warning)</span>
      </div>
      <div class="progress-bar progress-bar-danger" style="width: 10%">
        <span class="sr-only">10% Complete (danger)</span>
      </div>
    </div></div>
    <div class="col-md-2 text-right">    <button class="btn btn-default btn-sm pull-right"><i class="fa fa-plus"></i> Ver todo</button>
    </div>
    </div>
    
    </div>
    <div id="collapseOne" class="panel-collapse collapse in">
      <div class="panel-body">

      <ul class="list-group">
  <li href="#" class="list-group-item clearfix">
  <div class="pull-left"><div class="circle circlePendiente"></div></div>
  <div class="pull-left hidden">
  <span class="label label-success labelMonitor">En Ejecuci&oacute;n</span><br/>
  <span class="label label-warning labelMonitorType typeTecnico">Servicio T&eacute;cnico</span></div>
   <div class="pull-left monitorInfo">
   <div class="monitorInfoTitle">Instalaci&oacute;n de Pelicano en PC de Rack <span class="label label-warning">Servicio T&eacute;cnico</span> </div>
 11/12/2013 20:35:40 - Matias Montiel</div>
    <button class="btn btn-default pull-right btnDeleteMonitor"><i class="fa fa-trash-o"></i></button>
  </li>
  <li href="#" class="list-group-item clearfix odd">
  <div class="pull-left"><div class="circle circleFinalizado"></div></div>
  <div class="pull-left hidden">
  <span class="label label-danger labelMonitor">Pendiente</span><br/>
  <span class="label label-warning labelMonitorType typeImplementacion">Implementaci&oacute;n</span></div>
   <div class="pull-left monitorInfo">
   <div class="monitorInfoTitle">Implementar sistema de audio <span class="label label-info">Pedido Cotizaci&oacute;n</span> </div>
 11/12/2013 20:35:40 - Matias Montiel</div>
    <button class="btn btn-default pull-right btnDeleteMonitor"><i class="fa fa-trash-o"></i></button>
  </li>
  <li href="#" class="list-group-item clearfix">
  <div class="pull-left"><div class="circle circlePendiente"></div></div>
  <div class="pull-left hidden">
  <span class="label label-default labelMonitor">Finalizado</span><br/>
  <span class="label label-warning labelMonitorType typeCotizacion">Pedido Cotizaci&oacute;n</span></div>
   <div class="pull-left monitorInfo">
   <div class="monitorInfoTitle">Perforaci&oacute;n - Suite <span class="label label-info">Pedido Cotizaci&oacute;n</span></div>
 11/12/2013 20:35:40 - Matias Montiel</div>
    <button class="btn btn-default pull-right btnDeleteMonitor"><i class="fa fa-trash-o"></i></button>
  </li>
  <li href="#" class="list-group-item clearfix odd">
  <div class="pull-left"><div class="circle circleStandBy"></div></div>
  <div class="pull-left hidden">
  <span class="label label-success labelMonitor">En Ejecuci&oacute;n</span><br/>
  <span class="label label-warning labelMonitorType">Servicio T&eacute;cnico</span></div>
   <div class="pull-left monitorInfo">
   <div class="monitorInfoTitle">Instalaci&oacute;n de Pelicano en otro lado <span class="label label-success">Implementacion</span></div>
 11/12/2013 20:35:40 - Matias Montiel</div>
    <button class="btn btn-default pull-right btnDeleteMonitor"><i class="fa fa-trash-o"></i></button>
  </li>
  <li href="#" class="list-group-item clearfix ">
  <div class="pull-left"><div class="circle circleEjecucion"></div></div>
  <div class="pull-left hidden">
  <span class="label label-danger labelMonitor">Pendiente</span><br/>
  <span class="label label-warning labelMonitorType typeImplementacion">Implementaci&oacute;n</span></div>
   <div class="pull-left monitorInfo">
   <div class="monitorInfoTitle">Apple TV no funciona en Ipad de Juan <span class="label label-info">Pedido Cotizaci&oacute;n</span></div>
 11/12/2013 20:35:40 - Matias Montiel</div>
    <button class="btn btn-default pull-right btnDeleteMonitor"><i class="fa fa-trash-o"></i></button>
  </li>
  <li href="#" class="list-group-item clearfix odd">
  <div class="pull-left"><div class="circle circleStandBy"></div></div>
  <div class="pull-left hidden">
  <span class="label label-default labelMonitor">Finalizado</span><br/>
  <span class="label label-warning labelMonitorType typeCotizacion">Pedido Cotizaci&oacute;n</span></div>
   <div class="pull-left monitorInfo">
   <div class="monitorInfoTitle">Agregar Iphone al sistema <span class="label label-info">Pedido Cotizaci&oacute;n</span></div>
 11/12/2013 20:35:40 - Matias Montiel</div>
    <button class="btn btn-default pull-right btnDeleteMonitor"><i class="fa fa-trash-o"></i></button>
  </li>
</ul>
      
      
            </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
    <div class="row">
    <div class="col-md-6 text-left">  <h4 class="panel-title pull-left"><a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Sigal - Residencia</a></h4></div>
    <div class="col-md-4 text-right">  <div class="progress progressResumenMonitor">
      <div class="progress-bar progress-bar-success" style="width: 35%">
        <span class="sr-only">35% Complete (success)</span>
      </div>
      <div class="progress-bar progress-bar-warning" style="width: 20%">
        <span class="sr-only">20% Complete (warning)</span>
      </div>
      <div class="progress-bar progress-bar-danger" style="width: 10%">
        <span class="sr-only">10% Complete (danger)</span>
      </div>
    </div></div>
    <div class="col-md-2 text-right">    <button class="btn btn-default btn-sm pull-right"><i class="fa fa-plus"></i> Ver todo</button>
    </div>
    </div>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse">
      <div class="panel-body">
        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
    <div class="row">
    <div class="col-md-6 text-left">  <h4 class="panel-title pull-left"><a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Nombre del proyecto</a></h4></div>
    <div class="col-md-4 text-right">  <div class="progress progressResumenMonitor">
      <div class="progress-bar progress-bar-success" style="width: 20%">
        <span class="sr-only">35% Complete (success)</span>
      </div>
      <div class="progress-bar progress-bar-warning" style="width: 10%">
        <span class="sr-only">20% Complete (warning)</span>
      </div>
      <div class="progress-bar progress-bar-danger" style="width: 10%">
        <span class="sr-only">10% Complete (danger)</span>
      </div>
    </div></div>
    <div class="col-md-2 text-right">    <button class="btn btn-default btn-sm pull-right"><i class="fa fa-plus"></i> Ver todo</button>
    </div>
    </div>
    </div>
    <div id="collapseThree" class="panel-collapse collapse">
      <div class="panel-body">
        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
    <div class="row">
    <div class="col-md-6 text-left">  <h4 class="panel-title pull-left"><a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Nombre del proyecto</a></h4></div>
    <div class="col-md-4 text-right">  <div class="progress progressResumenMonitor">
      <div class="progress-bar progress-bar-success" style="width: 20%">
        <span class="sr-only">35% Complete (success)</span>
      </div>
      <div class="progress-bar progress-bar-warning" style="width: 10%">
        <span class="sr-only">20% Complete (warning)</span>
      </div>
      <div class="progress-bar progress-bar-danger" style="width: 10%">
        <span class="sr-only">10% Complete (danger)</span>
      </div>
    </div></div>
    <div class="col-md-2 text-right">    <button class="btn btn-default btn-sm pull-right"><i class="fa fa-plus"></i> Ver todo</button>
    </div>
    </div>
    </div>
    <div id="collapseThree" class="panel-collapse collapse">
      <div class="panel-body">
        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
    <div class="row">
    <div class="col-md-6 text-left">  <h4 class="panel-title pull-left"><a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Nombre del proyecto</a></h4></div>
    <div class="col-md-4 text-right">  <div class="progress progressResumenMonitor">
      <div class="progress-bar progress-bar-success" style="width: 20%">
        <span class="sr-only">35% Complete (success)</span>
      </div>
      <div class="progress-bar progress-bar-warning" style="width: 10%">
        <span class="sr-only">20% Complete (warning)</span>
      </div>
      <div class="progress-bar progress-bar-danger" style="width: 10%">
        <span class="sr-only">10% Complete (danger)</span>
      </div>
    </div></div>
    <div class="col-md-2 text-right">    <button class="btn btn-default btn-sm pull-right"><i class="fa fa-plus"></i> Ver todo</button>
    </div>
    </div>
    </div>
    <div id="collapseThree" class="panel-collapse collapse">
      <div class="panel-body">
        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
    <div class="row">
    <div class="col-md-6 text-left">  <h4 class="panel-title pull-left"><a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Nombre del proyecto</a></h4></div>
    <div class="col-md-4 text-right">  <div class="progress progressResumenMonitor">
      <div class="progress-bar progress-bar-success" style="width: 20%">
        <span class="sr-only">35% Complete (success)</span>
      </div>
      <div class="progress-bar progress-bar-warning" style="width: 10%">
        <span class="sr-only">20% Complete (warning)</span>
      </div>
      <div class="progress-bar progress-bar-danger" style="width: 10%">
        <span class="sr-only">10% Complete (danger)</span>
      </div>
    </div></div>
    <div class="col-md-2 text-right">    <button class="btn btn-default btn-sm pull-right"><i class="fa fa-plus"></i> Ver todo</button>
    </div>
    </div>
    </div>
    <div id="collapseThree" class="panel-collapse collapse">
      <div class="panel-body">
        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
    <div class="row">
    <div class="col-md-6 text-left">  <h4 class="panel-title pull-left"><a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Nombre del proyecto</a></h4></div>
    <div class="col-md-4 text-right">  <div class="progress progressResumenMonitor">
      <div class="progress-bar progress-bar-success" style="width: 20%">
        <span class="sr-only">35% Complete (success)</span>
      </div>
      <div class="progress-bar progress-bar-warning" style="width: 10%">
        <span class="sr-only">20% Complete (warning)</span>
      </div>
      <div class="progress-bar progress-bar-danger" style="width: 10%">
        <span class="sr-only">10% Complete (danger)</span>
      </div>
    </div></div>
    <div class="col-md-2 text-right">    <button class="btn btn-default btn-sm pull-right"><i class="fa fa-plus"></i> Ver todo</button>
    </div>
    </div>
    </div>
    <div id="collapseThree" class="panel-collapse collapse">
      <div class="panel-body">
        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
    <div class="row">
    <div class="col-md-6 text-left">  <h4 class="panel-title pull-left"><a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Nombre del proyecto</a></h4></div>
    <div class="col-md-4 text-right">  <div class="progress progressResumenMonitor">
      <div class="progress-bar progress-bar-success" style="width: 20%">
        <span class="sr-only">35% Complete (success)</span>
      </div>
      <div class="progress-bar progress-bar-warning" style="width: 10%">
        <span class="sr-only">20% Complete (warning)</span>
      </div>
      <div class="progress-bar progress-bar-danger" style="width: 10%">
        <span class="sr-only">10% Complete (danger)</span>
      </div>
    </div></div>
    <div class="col-md-2 text-right">    <button class="btn btn-default btn-sm pull-right"><i class="fa fa-plus"></i> Ver todo</button>
    </div>
    </div>
    </div>
    <div id="collapseThree" class="panel-collapse collapse">
      <div class="panel-body">
        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
    <div class="row">
    <div class="col-md-6 text-left">  <h4 class="panel-title pull-left"><a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Nombre del proyecto</a></h4></div>
    <div class="col-md-4 text-right">  <div class="progress progressResumenMonitor">
      <div class="progress-bar progress-bar-success" style="width: 20%">
        <span class="sr-only">35% Complete (success)</span>
      </div>
      <div class="progress-bar progress-bar-warning" style="width: 10%">
        <span class="sr-only">20% Complete (warning)</span>
      </div>
      <div class="progress-bar progress-bar-danger" style="width: 10%">
        <span class="sr-only">10% Complete (danger)</span>
      </div>
    </div></div>
    <div class="col-md-2 text-right">    <button class="btn btn-default btn-sm pull-right"><i class="fa fa-plus"></i> Ver todo</button>
    </div>
    </div>
    </div>
    <div id="collapseThree" class="panel-collapse collapse">
      <div class="panel-body">
        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
    <div class="row">
    <div class="col-md-6 text-left">  <h4 class="panel-title pull-left"><a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Nombre del proyecto</a></h4></div>
    <div class="col-md-4 text-right">  <div class="progress progressResumenMonitor">
      <div class="progress-bar progress-bar-success" style="width: 20%">
        <span class="sr-only">35% Complete (success)</span>
      </div>
      <div class="progress-bar progress-bar-warning" style="width: 10%">
        <span class="sr-only">20% Complete (warning)</span>
      </div>
      <div class="progress-bar progress-bar-danger" style="width: 10%">
        <span class="sr-only">10% Complete (danger)</span>
      </div>
    </div></div>
    <div class="col-md-2 text-right">    <button class="btn btn-default btn-sm pull-right"><i class="fa fa-plus"></i> Ver todo</button>
    </div>
    </div>
    </div>
    <div id="collapseThree" class="panel-collapse collapse">
      <div class="panel-body">
        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
    <div class="row">
    <div class="col-md-6 text-left">  <h4 class="panel-title pull-left"><a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Nombre del proyecto</a></h4></div>
    <div class="col-md-4 text-right">  <div class="progress progressResumenMonitor">
      <div class="progress-bar progress-bar-success" style="width: 20%">
        <span class="sr-only">35% Complete (success)</span>
      </div>
      <div class="progress-bar progress-bar-warning" style="width: 10%">
        <span class="sr-only">20% Complete (warning)</span>
      </div>
      <div class="progress-bar progress-bar-danger" style="width: 10%">
        <span class="sr-only">10% Complete (danger)</span>
      </div>
    </div></div>
    <div class="col-md-2 text-right">    <button class="btn btn-default btn-sm pull-right"><i class="fa fa-plus"></i> Ver todo</button>
    </div>
    </div>
    </div>
    <div id="collapseThree" class="panel-collapse collapse">
      <div class="panel-body">
        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
    <div class="row">
    <div class="col-md-6 text-left">  <h4 class="panel-title pull-left"><a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Nombre del proyecto</a></h4></div>
    <div class="col-md-4 text-right">  <div class="progress progressResumenMonitor">
      <div class="progress-bar progress-bar-success" style="width: 20%">
        <span class="sr-only">35% Complete (success)</span>
      </div>
      <div class="progress-bar progress-bar-warning" style="width: 10%">
        <span class="sr-only">20% Complete (warning)</span>
      </div>
      <div class="progress-bar progress-bar-danger" style="width: 10%">
        <span class="sr-only">10% Complete (danger)</span>
      </div>
    </div></div>
    <div class="col-md-2 text-right">    <button class="btn btn-default btn-sm pull-right"><i class="fa fa-plus"></i> Ver todo</button>
    </div>
    </div>
    </div>
    <div id="collapseThree" class="panel-collapse collapse">
      <div class="panel-body">
        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
    <div class="row">
    <div class="col-md-6 text-left">  <h4 class="panel-title pull-left"><a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Nombre del proyecto</a></h4></div>
    <div class="col-md-4 text-right">  <div class="progress progressResumenMonitor">
      <div class="progress-bar progress-bar-success" style="width: 20%">
        <span class="sr-only">35% Complete (success)</span>
      </div>
      <div class="progress-bar progress-bar-warning" style="width: 10%">
        <span class="sr-only">20% Complete (warning)</span>
      </div>
      <div class="progress-bar progress-bar-danger" style="width: 10%">
        <span class="sr-only">10% Complete (danger)</span>
      </div>
    </div></div>
    <div class="col-md-2 text-right">    <button class="btn btn-default btn-sm pull-right"><i class="fa fa-plus"></i> Ver todo</button>
    </div>
    </div>
    </div>
    <div id="collapseThree" class="panel-collapse collapse">
      <div class="panel-body">
        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
      </div>
    </div>
  </div>
</div>
     
    </div>
    <!-- /.col-md-12 -->
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