

<nav class="navbar navbar-default navbar-fixed-top menuTapia" role="navigation"  id="Menu">
<div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
           <div class="navbar-header">
          <a class="navbar-brand dropdown-toggle" data-toggle="dropdown" href="#" id="MenuLogo">TAPIA
          <i class="fa fa-caret-down fa-fw"></i>
          </a>
          <ul class="dropdown-menu">
			<li><a href="index.php">GREEN</a></li>
          </ul>
        </div>
        
          <div class="nav navbar-nav navbar-left visible-xs">
				<button class="toggle-menu menu-left btn btn-default navbar-btn jPushMenuBtn" id="toggleMain">
					<i class="fa fa-reorder fa-fw"></i>
				</button>
			</div>
			<p class="navbar-text visible-xs" id="mobilePageName">
			Monitor			
			</p>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex5-collapse">
          <ul class="nav navbar-nav">
          <li <?php if ($active=="tinicio"){ echo 'class="active"';}?> ><a href="tapia.php"><i class="fa fa-home fa-fw"></i> Monitor</a></li>
          <li <?php if ($active=="tproyectos"){ echo 'class="active"';}?> ><a href="tproyectos.php"><i class="fa fa-star fa-fw"></i> Proyectos</a></li>
          <li <?php if ($active=="tclientes"){ echo 'class="active"';}?> ><a href="tclientes.php"><i class="fa fa-glass fa-fw"></i> Clientes</a></li>
          <li <?php if ($active=="tformularios"){ echo 'class="active"';}?> ><a href="tformularios.php"><i class="fa fa-truck fa-fw"></i> Formularios</a></li>
          <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">M&aacute;s <i class="fa fa-caret-down fa-fw"></i></a>
                        <ul class="dropdown-menu">
                          <li><a href="tetapas.php">Etapas</a></li>
                          <li><a href="tusuarios.php">Usuarios</a></li>
                          <li><a href="tperfiles.php">Perfiles</a></li>
                          <li><a href="tdocumentos.php">Documentos</a></li>
                        </ul>
          </li>
          </ul>

        </div><!-- /.navbar-collapse -->
        </div>
      </nav>