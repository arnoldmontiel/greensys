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
$active = 'tclientes';
include ('menuTapia.php');
?>


<div class="container" id="screenTClientes">
		<div class="row">
			<div class="col-sm-12">
				<h1 class="pageTitle">Etapas</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<table class="table table-striped table-bordered tablaIndividual">
					<thead>
						<tr>
							<th>Descripci&oacute;n</th>
							<th class="align-right">Acciones</th>
						</tr>
					</thead>
					<tbody>
						<tr class="odd">
							<td>En Ejecuci&oacute;n</td>
							<td class="align-right">
							<button type="button" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar</button>
             				<button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button>
             				</td>
						</tr>
						<tr class="even">
							<td>Pendiente</td>
							<td class="align-right">
							<button type="button" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar</button>
             				<button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button>
             				</td>
						</tr>
						<tr class="odd">
							<td>Sin Seguimiento</td>
							<td class="align-right">
							<button type="button" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar</button>
             				<button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button>
             				</td>
						</tr>
						<tr class="even">
							<td>Stand By</td>
							<td class="align-right">
							<button type="button" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar</button>
             				<button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button>
             				</td>
						</tr>
					</tbody>
				</table>
			</div>
			<!-- /.col-sm-12 -->
		</div>
		<!-- /.row -->
	</div>




	<!-- Le javascript
    ================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script src="js/bootstrap.min.js"></script>
</body>
</html>