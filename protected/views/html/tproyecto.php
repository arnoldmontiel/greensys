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
<body class="bodyTapia">
<?php
$active = 'tinicio';
include ('menuTapia.php');
?>


<div class="container" id="screenTProyecto">
		<div class="row ">
			<div class="col-sm-6">
				<h1 class="pageTitle">Cohen - La Angostura</h1>
			</div>
			<div class="col-sm-6 align-right">
      <button id="btn-cancel" type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-plus"></i> Nueva Tarea</button>
      <button id="btn-cancel" type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-share-square-o"></i> Exportar</button>
		</div>
		
		<div class="row mainTaskInfo hidden">
		<div class="col-sm-6">
		<!-- empieza progress -->
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
    </div>
		<!-- termina progress -->
    
      </div>
      
		<div class="col-sm-6"></div>
		</div>
		
		</div><!-- /row -->
		
		  <div class="row">
    <div class="col-sm-12">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tabTareas" data-toggle="tab">Tareas</a></li>
        <li><a href="#tabGenerales" data-toggle="tab">Documentos Generales</a></li>
        <li><a href="#tabTecnicos" data-toggle="tab">Documentos T&eacute;cnicos</a></li>
        <li><a href="#tabImagenes" data-toggle="tab">Im&aacute;genes</a></li>
      </ul>
    <div class="tab-content">
    <div class="tab-pane active" id="tabTareas">
     <div class="searchOverTab"><input type="text" class="form-control" placeholder=" Buscar Tarea"></div>
      
      
      <ul class="list-group">
     <!-- Empieza Tarea -->
  <li class="list-group-item clearfix line linePendiente" >
  <a href="ttarea.php" class="clearfix">
  <div class="circle circlePendiente visible-sm visible-nexus"></div> 
  <div class="circularLabel circlePendiente pull-left hidden-sm hidden-xs">Finalizado</div>
    <div class="labelTaskMobile labelTaskMobilePedido visible-xs hidden-nexus">Pedido Cotizaci&oacute;n <span class="labelTaskMobileDate pull-right">20/10/2012 30:09:10</span></div>
  <div class=" monitorInfo" >
   <div class="monitorInfoTitle">Instalaci&oacute;n de Pelicano en PC de Rack  </div> <span class="iconsGroup"><img src="img/iconSet/circlePDF20.png" />  <img src="img/iconSet/circleW20.png" /> <img src="img/iconSet/circleX20.png" /> <img src="img/iconSet/circleIMG20.png" /> <img src="img/iconSet/circleCAD20.png" /></span>
  <div class="monitorDates"> 
 <span class="label label-default labelDate visible-xs-inline">UPD</span>  
 <span class="label label-default labelDate hidden-xs-inline">UPDATED</span>
 <span class="monitorDate">11/12/2013 30:12:23  - <strong>Matias Montiel</strong> </span>
 </div>     
  </div>
     <span class="label label-info labelTask hidden-xs">Pedido Cotizaci&oacute;n <br/> 20/10/2012 30:09:10</span>
  </a></li>
      <!-- Termina Tarea -->
  
      <!-- Empieza Tarea -->
  <li class="list-group-item clearfix line lineEjecucion odd">
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
  <li class="list-group-item clearfix line lineEjecucion ">
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
  <li class="list-group-item clearfix line lineStandBy odd">
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


</div><!-- /tab-pane -->
    <div class="tab-pane" id="tabGenerales">
     <div class="searchOverTab"><input type="text" class="form-control" placeholder=" Buscar Documento"></div>
     <table class="table table-bordered tablaIndividual">
					<thead>
						<tr>
							<th colspan="2">C&oacute;mputo y M&eacute;tricas</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
							<ul class="archivosListado">
							<li class="archivosLast"><span class="label label-default">&Uacute;LTIMO</span> <span class="bold">Desglose de Materiales </span><br/>
							<a class="archivosLink"><img src="img/iconSet/circleCAD20.png" />  Smartliving_Madero_5249927d46d03.xlsx</a> (61.67 Kb) - <span class="bold">amagatelli</span> el 30/09/2013 12:02:34
							</li>
							<li>Desglose de Materiales 02 </br>
							<a class="archivosLink"><img src="img/iconSet/circleCAD20.png" />  Smartliving_Madero_5249927d46d03.xlsx</a> (61.67 Kb) - <span class="bold">amagatelli</span> el 30/09/2013 12:02:34
							</li>
							<li> Materiales </br>
							<a class="archivosLink"><img src="img/iconSet/circleCAD20.png" />  Smartliving_Madero_5249927d46d03.xlsx</a> (61.67 Kb) - <span class="bold">amagatelli</span> el 30/09/2013 12:02:34
							</li>
							<li> Desglose de Materiales </br>
							<a class="archivosLink"><img src="img/iconSet/circleCAD20.png" />  Smartliving_Madero_5249927d46d03.xlsx</a> (61.67 Kb) - <span class="bold">amagatelli</span> el 30/09/2013 12:02:34
							</li>
							<li> Desglose de Materiales </br>
							<a class="archivosLink"><img src="img/iconSet/circleCAD20.png" />  Smartliving_Madero_5249927d46d03.xlsx</a> (61.67 Kb) - <span class="bold">amagatelli</span> el 30/09/2013 12:02:34
							</li>
							</ul>
							</td>
							<td class="align-center verticalTop">
							<button type="button" class="btn btn-default btn-sm verticalTop"><i class="fa fa-pencil"></i> Ver Permisos G-Drive</button>
             				</td>
						</tr>
						<tr>
							<td>
							<ul class="archivosListado">
							<li class="archivosLast"><span class="label label-default">&Uacute;LTIMO</span> Desglose de Materiales <br/>
							<a class="archivosLink"><img src="img/iconSet/circleCAD20.png" />  Smartliving_Madero_5249927d46d03.xlsx</a> (61.67 Kb) - <span class="bold">amagatelli</span> el 30/09/2013 12:02:34
							</li>
							<li> Desglose de Materiales 02 </br>
							<a class="archivosLink"><img src="img/iconSet/circleCAD20.png" />  Smartliving_Madero_5249927d46d03.xlsx</a> (61.67 Kb) - <span class="bold">amagatelli</span> el 30/09/2013 12:02:34
							</li>
							<li> Materiales </br>
							<a class="archivosLink"><img src="img/iconSet/circleCAD20.png" />  Smartliving_Madero_5249927d46d03.xlsx</a> (61.67 Kb) - <span class="bold">amagatelli</span> el 30/09/2013 12:02:34
							</li>
							<li> Desglose de Materiales </br>
							<a class="archivosLink"><img src="img/iconSet/circleCAD20.png" />  Smartliving_Madero_5249927d46d03.xlsx</a> (61.67 Kb) - <span class="bold">amagatelli</span> el 30/09/2013 12:02:34
							</li>
							<li> Desglose de Materiales </br>
							<a class="archivosLink"><img src="img/iconSet/circleCAD20.png" />  Smartliving_Madero_5249927d46d03.xlsx</a> (61.67 Kb) - <span class="bold">amagatelli</span> el 30/09/2013 12:02:34
							</li>
							</ul>
							</td>
							<td class="align-center verticalTop">
							<button type="button" class="btn btn-default btn-sm verticalTop"><i class="fa fa-pencil"></i> Ver Permisos G-Drive</button>
             				</td>
						</tr>
					</tbody>
				</table>
</div><!-- /tab-pane -->
    <div class="tab-pane" id="tabTecnicos">
     <div class="searchOverTab"><input type="text" class="form-control" placeholder=" Buscar Documento"></div>
Tecnicos
     </div>
    <div class="tab-pane" id="tabImagenes">
     <div class="searchOverTab"><input type="text" class="form-control" placeholder=" Buscar Imagen"></div>
Imagenes
     </div>
    </div> <!-- /tab-content -->
    



			</div><!-- /.col-sm-12 -->
		</div><!-- /.row -->
		
			
		
	</div>

      <script>    
    $('.btnAdjuntar').on('click', function(e) {
      $('.expandAdjuntar').toggleClass("hidden"); //you can list several class names 
      e.preventDefault();
    });
</script>
      
	<!-- Le javascript
    ================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script src="js/bootstrap.min.js"></script>
</body>
</html>