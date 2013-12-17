

<nav class="navbar navbar-default navbar-fixed-top" role="navigation"  id="Menu">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <a class="navbar-brand" href="#" id="MenuLogo">Green</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex5-collapse">
          <ul class="nav navbar-nav">
          <li <?php if ($active=="inicio"){ echo 'class="active"';}?> ><a href="index.php"><i class="fa fa-home fa-fw"></i> Dashboard</a></li>
          <li <?php if ($active=="productos"){ echo 'class="active"';}?> ><a href="<?php echo ProductController::createUrl("product/index")?>"><i class="fa fa-star fa-fw"></i> Productos</a></li>
          <li <?php if ($active=="proveedores"){ echo 'class="active"';}?> ><a href="mis-series.php"><i class="fa fa-truck fa-fw"></i> Proveedores</a></li>
          <li <?php if ($active=="precios"){ echo 'class="active"';}?> ><a href="marketplace.php"><i class="fa fa-book fa-fw"></i> Listas de Precios</a></li>
          <li <?php if ($active=="clientes"){ echo 'class="active"';}?> ><a href="descargas.php"><i class="fa fa-glass fa-fw"></i> Clientes</a></li>
          <li <?php if ($active=="proyectos"){ echo 'class="active"';}?> ><a href="descargas.php"><i class="fa fa-building fa-fw"></i> Proyectos</a></li>
          <li <?php if ($active=="presupuestos"){ echo 'class="active"';}?> ><a href="descargas.php"><i class="fa fa-dollar fa-fw"></i> Presupuestos</a></li>
          <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">M&aacute;s <i class="fa fa-caret-down fa-fw"></i></a>
                        <ul class="dropdown-menu">
                          <li><a href="#">Permisos</a></li>
                          <li><a href="#">Usuarios</a></li>
                          <li><a href="#">Areas</a></li>
                          <li><a href="#">Importadores</a></li>
                          <li><a href="#">Requerimientos</a></li>
                          <li><a href="#">Servicios</a></li>
                        </ul>
          </li>
          </ul>

        </div><!-- /.navbar-collapse -->
      </nav>