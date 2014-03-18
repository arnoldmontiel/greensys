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
<!-- jPushMenu -->
<script src="js/jPushMenuDelfi.js"></script>
<link href="css/jPushMenu.css" rel="stylesheet" />

</head>
<body class="bodyTapia cbp-spmenu-push">

<?php
$active = 'tareas';
include ('menuTapia.php');
?>
<script>	
$(document).ready(function() {
	  $('#toggleFiltro.toggle-menu').jPushMenu({
			closeOnClickOutside:false,
			menu: '#pushFiltro'});
		$( "#pushFiltro .pushMenuSuperGroup a" ).click(function() {
			 //$(this).addClass('pushMenuActive').siblings().removeClass('pushMenuActive');
			  //Para marcar mas de uno:
			  $( this ).toggleClass( "pushMenuActive" );
			  var selector = $(this).attr("data-filter");

			  //Desmarco todo el menu comun
			  $("#filtroGenero li").removeClass('active');
			  //Marco el item correspondiente en menu comun
			  $("#filtroGenero li a[data-filter='" + selector + "']").parent('li').addClass('active');
			  //Cerrar menu			
			 // $('.jPushMenuBtn,body,.cbp-spmenu').removeClass('disabled active cbp-spmenu-open cbp-spmenu-push-toleft cbp-spmenu-push-toright');
			  //$(".modal-backdrop").remove();
			   
			  return false;
			  		});
	});
</script>

	<nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="pushFiltro">
		<div class="cbp-title">Filtrar Tareas <button class="btn btn-default btn-sm btnLimpiar"><i class="fa fa-undo"></i> Limpiar</button></div>
		<a class="toggle-menuMarketplace close-menu"><i class="fa fa-times-circle"></i></a>
		<div class="pushMenuSuperGroup">
		<div class="pushMenuGroup">
		<div class="pushMenuGroupTitle">FECHA</div>
		<div class="pushMenuDates">
		<form class="row form-inline" role="form">
 		 <div class="form-group col-xs-6">
  		  <label  for="fromDate">Desde</label>
  		  <input type="text" class="form-control"  placeholder="">
		  </div>
 		 <div class="form-group col-xs-6">
  		  <label  for="fromDate">Hasta</label>
  		  <input type="text" class="form-control"  placeholder="">
		  </div>
		</form>
		</div>
		</div>
		<div class="pushMenuGroup">
		<div class="pushMenuGroupTitle">ETAPAS</div>
		<a class="pushMenuItem" href="#">Pendiente</a>
		<a class="pushMenuItem" href="#">En Ejecuci&oacute;n</a>
		<a class="pushMenuItem" href="#">Stand By</a>
		<a class="pushMenuItem" href="#">Sin Seguimiento</a>
		<a class="pushMenuItem" href="#">Finalizado</a>
		</div>
		<div class="pushMenuGroup">
		<div class="pushMenuGroupTitle">Tareas</div>
		<a class="pushMenuItem" href="#">Implementaci&oacute;n</a>
		<a class="pushMenuItem" href="#">Pedido de Documentaci&oacute;n</a>
		<a class="pushMenuItem" href="#">Datos Iniciales</a>
		<a class="pushMenuItem" href="#">Pedido de Informaci&oacute;n</a>
		<a class="pushMenuItem" href="#">Pedido de Compras</a>
		<a class="pushMenuItem" href="#">Informaci&oacute;n T&eacute;cnica</a>
		<a class="pushMenuItem" href="#">Pedido de Cotizaci&oacute;n</a>
		<a class="pushMenuItem" href="#">Informaci&oacute;n Comercials</a>
		<a class="pushMenuItem" href="#">Pedido de RMA</a>
		<a class="pushMenuItem" href="#">Pedido de Facturaci&oacute;n</a>
		<a class="pushMenuItem" href="#">Informaci&oacute;n Privada</a>
		<a class="pushMenuItem" href="#">Programaci&oacute;n</a>
		<a class="pushMenuItem" href="#">Servicio T&eacute;cnico</a>
		<a class="pushMenuItem" href="#">Desarrollo Tecnol&oacute;gico</a>
		</div>
		</div>
		
	</nav>

<div class="container" id="screenTTareas">
<div class="row">
<div class="col-sm-6 col-xs-4 col-nexus-6"><h1 class="pageTitle pull-left hidden-xs">Mis Tareas</h1> 
    <button class="toggle-menu menu-left btn btn-primary btnFiltro" id="toggleFiltro"> <i class="fa fa-filter"></i> Filtrar </button></div>
<div class=" col-sm-6 col-xs-8 col-nexus-6 text-right ">
<input type="text" class="form-control formSearch" placeholder=" Buscar Tareas"></div>
</div>
		
		  <div class="row">
    <div class="col-sm-12">
    
      <ul class="list-group">
     <!-- Empieza Tarea -->
  <li class="list-group-item clearfix line linePendiente" >
  <a href="ttarea.php" class="clearfix">
  <div class="circle circlePendiente visible-sm visible-nexus"></div> 
  <div class="circularLabel circlePendiente pull-left hidden-sm hidden-xs">Finalizado</div>
    <div class="labelTaskMobile labelTaskMobilePedido visible-xs hidden-nexus">Pedido Cotizaci&oacute;n <span class="labelTaskMobileDate pull-right">20/10/2012 30:09:10</span></div>
  <div class="monitorInfo" >
  <div class="monitorInfoProyecto">Cohen - La Angostura</div>
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
  <div class="monitorInfoProyecto">Cohen - La Angostura</div>
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
  <div class="monitorInfoProyecto">Cohen - La Angostura</div>
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
  <div class="monitorInfoProyecto">Cohen - La Angostura</div>
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



			</div><!-- /.col-sm-12 -->
		</div><!-- /.row -->
		
			
		
	</div>

 
      
	<!-- Le javascript
    ================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script src="js/bootstrap.min.js"></script>
	<!--call jPushMenu, required-->

</body>
</html>