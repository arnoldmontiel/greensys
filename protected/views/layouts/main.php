<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="ROBOTS" content="NOINDEX, NOFOLLOW">
<title>GREEN</title>
<!-- Bootstrap -->
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
<link rel="stylesheet" href="css/font-awesome.min.css">
<meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<!-- jPushMenu -->
<script src="js/jPushMenuDelfi.js"></script>
<link href="css/jPushMenu.css" rel="stylesheet" />
<!-- JS Tree -->
<link rel="stylesheet" href="css/jstree.min.css" />
<script src="js/jstree.min.js"></script>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl."/js/tools.js");?>
<?php include('estilos.php');?>
</head>

<body>
<?php 
$active='inicio';
include('menu.php');?>

<nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-right" id="pushArea">
		<div class="cbp-title">Elegir Area </div>
		<div class="sideMenuBotones"> <button class="btn btn-default"><i class="fa fa-pencil"></i> Editar </button><button class="btn btn-default"><i class="fa fa-trash-o"></i> Borrar </button><button class="btn btn-primary"><i class="fa fa-plus"></i> Agregar</button></div>
		<a class="toggle-menuMarketplace close-menu"><i class="fa fa-times-circle"></i></a>
		
				<div id="jstree" class="treeMenu">
  <ul>
    <li data-jstree='{"icon":"images/areaIcon/area.ico"}'>Planta Baja
      <ul>
        <li data-jstree='{"icon":"images/areaIcon/entry.ico"}'><a>Hall Ingreso</a></li>
        <li data-jstree='{"icon":"images/areaIcon/toilet.ico"}'><a href="#">Bano Visita</a></li>
        <li data-jstree='{"icon":"images/areaIcon/den.ico"}'><a href="#">Sala</a></li>
      </ul>
    </li>
  </ul>
</div>
				
				</div>
		
	</nav>

<?php echo $content; ?>
<div id="myModalUploadExcel" class="modal fade" style="display: none;" aria-hidden="true">
</div>
<div id="myModalEditField" class="modal fade" style="display: none;" aria-hidden="true">
</div>
<div id="modalPlaceHolder" class="modal fade" style="display: none;" aria-hidden="true">
</div>
<div id="myModalFormBudget" class="modal fade" style="display: none;" aria-hidden="true">
</div>
<div id="myModalFormImporter" class="modal fade" style="display: none;" aria-hidden="true">
</div>
<div id="myModalChangeStateBudget" class="modal fade" style="display: none;" aria-hidden="true">
</div>
<div id="myModalAddProduct" class="modal fade" style="display: none;" aria-hidden="true">
</div>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
