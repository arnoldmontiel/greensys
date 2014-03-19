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
$active = 'ttareas';
include ('menuTapia.php');
?>

<div class="container" id="screenTTarea">
<div class="row">
<div class="col-sm-12 col-xs-12 col-nexus-12"><h2 class="proyectTitle hidden-xs"><a href="tproyecto.php"><i class="fa fa-arrow-circle-left"></i> Cohen - La Angostura</a></h2> </div>
</div>
<div class="row">
<div class="col-sm-12">
<div class="taskStatus">
      <span class="label label-primary">Pedido de Cotizaci&oacute;n</span>
      <span class="label label-warning">Stand By</span>
      </div>
</div>
</div>
<div class="row">
<div class="col-sm-6 col-xs-12 col-nexus-6"><h1 class="taskProyTitle">Instalaci&oacute;n de Pelicano en PC de Rack</h1> </div>
	<div class="col-sm-6  col-xs-12 align-right">
      <button id="btn-cancel" type="button" class="btn btn-primary" ><i class="fa fa-share-square-o"></i> Exportar</button>
      <button id="btn-cancel" type="button" class="btn btn-primary" ><i class="fa fa-times-circle"></i> Finalizar</button>	
</div>
</div>
		
		  <div class="row">
    <div class="col-sm-12">
    <div class="taskMainSpec">
  <div class="taskMonitorAutor">09/09/2013 12:34:57  &bull; Matias Montiel</div>
   <div class="taskMonitorComment"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi rhoncus nulla eu pellentesque interdum. Curabitur a metus sagittis, suscipit risus sit amet, convallis nunc.</div>
      </div>
</div><!-- /.col-sm-12 -->
		</div><!-- /.row -->
		
		<div class="row">
			<div class="col-sm-12">
      
      
      <ul class="list-group listNotas">
  <li class="list-group-item">
  <div class="taskMonitorAutor">09/09/2013 12:34:57  &bull; Matias Montiel</div>
    <div class="taskMonitorComment">PM solicito la instalacion de Pelicano en PC del Rack.</div>
  </li>
  <li class="list-group-item">
  <div class="taskMonitorAutor">09/09/2013 12:34:57  &bull; Matias Montiel</div>
        <div class="taskMonitorComment">PV ya coordino con Carlos Mu–oz para traer en una encomienda la PC.</div>
  <div class="taskMonitorArchivo"><img src="img/iconSet/circleW20.png" /> <a>archivoword.doc</a> (35kb) &raquo; desglose materiales</div>
  </li>
  
  <li class="list-group-item">
  <div class="taskMonitorAutor">09/09/2013 12:34:57  &bull; Matias Montiel</div>
      <div class="taskMonitorArchivo"><img src="img/iconSet/circleCAD20.png" /> <a>otroarchivodistinto.cad</a> (35kb) &raquo; Listado con todo lo que hay que hacer, texto que tengo que poner para ver si esto entra bien.
  </div>
  </li>
   <li class="list-group-item listTextarea">
		<div class="row">
			<div class="col-sm-6">  <div class="taskMonitorAutor">Delfina Rossi</div>
			</div>
			<div class="col-sm-6 align-right">  <div class="taskMonitorSaved">Guardado 20/10/20 12:23:10 <i class="fa fa-save"></i></div>
			</div>
			</div>

   <textarea class="form-control" rows="3" placeholder="Escriba aqui..."></textarea>
   <div class="expandAdjuntar hidden align-center">
      <button id="btn-cancel" type="button" class="btn btn-default btn-sm" ><i class="fa fa-paperclip"></i> Documentos</button>
      <button id="btn-cancel" type="button" class="btn btn-default btn-sm" ><i class="fa fa-paperclip"></i> Im&aacute;genes</button>
      <button id="btn-cancel" type="button" class="btn btn-default btn-sm" ><i class="fa fa-paperclip"></i> Documentos T&eacute;cnicos</button>	
	
   </div>
			<div class="align-right">
      <button id="btn-cancel" type="button" class="btn btn-default btn-sm pull-left" ><i class="fa fa-eraser"></i> Reset</button>
      <button id="btn-cancel" type="button" class="btn btn-default btn-sm btnAdjuntar" ><i class="fa fa-paperclip"></i> Adjuntar</button>
      <button id="btn-cancel" type="button" class="btn btn-default btn-sm" ><i class="fa fa-check-square-o"></i> Publicar</button>	
		</div>
   </li>
</ul>
			</div>
			<!-- /.col-sm-12 -->
		</div>
		<!-- /.row -->
		
			
		
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
	<!--call jPushMenu, required-->

</body>
</html>