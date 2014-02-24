

<nav class="navbar navbar-default navbar-fixed-top menuTapia" role="navigation"  id="Menu">
        <!-- Brand and toggle get grouped for better mobile display -->
           <div class="navbar-header">
          <a class="navbar-brand dropdown-toggle" data-toggle="dropdown" href="#" id="MenuLogo">TAPIA
          <i class="fa fa-caret-down fa-fw"></i>
          </a>
          <ul class="dropdown-menu">
			<li><a href="index.php">GREEN</a></li>
          </ul>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex5-collapse">
          <ul class="nav navbar-nav">
          <li <?php if ($active=="tinicio"){ echo 'class="active"';}?> ><a href="tapia.php"><i class="fa fa-home fa-fw"></i> Monitor</a></li>
          <li <?php if ($active=="tproyectos"){ echo 'class="active"';}?> ><a href="tproyectos.php"><i class="fa fa-star fa-fw"></i> Proyectos</a></li>
          <li <?php if ($active=="tclientes"){ echo 'class="active"';}?> ><a href="tclientes.php"><i class="fa fa-truck fa-fw"></i> Clientes</a></li>
          <li <?php if ($active=="tformularios"){ echo 'class="active"';}?> ><a href="tformularios.php"><i class="fa fa-truck fa-fw"></i> Formularios</a></li>
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