<nav class="navbar navbar-default navbar-fixed-top" role="navigation"  id="Menu">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <a class="navbar-brand dropdown-toggle" data-toggle="dropdown" href="#" id="MenuLogo">Green
          <i class="fa fa-caret-down fa-fw"></i>
          </a>
          <ul class="dropdown-menu">
			<li><a href="<?php echo Yii::app()->createUrl('site')?>">TAPIA</a></li>
          </ul>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex5-collapse">
          <ul class="nav navbar-nav">
          <?php $active = Yii::app()->controller->id;?>
          <li <?php if ($active=="site"){ echo 'class="active"';}?> ><a href="<?php echo Yii::app()->createUrl("site/indexGreen")?>"><i class="fa fa-home fa-fw"></i> Dashboard</a></li>
          <?php if(Yii::app()->user->checkAccess('ProductManage')):?>			          
          	<li <?php if ($active=="product"){ echo 'class="active"';}?> ><a href="<?php echo Yii::app()->createUrl("product/index")?>"><i class="fa fa-star fa-fw"></i> Productos</a></li>
          <?php endif?>			                    	
          <?php if(Yii::app()->user->checkAccess('BudgetManage')):?>			          
          <li <?php if ($active=="budget"){ echo 'class="active"';}?> ><a href="<?php echo Yii::app()->createUrl("budget/index")?>"><i class="fa fa-dollar fa-fw"></i> Presupuestos</a></li>
          <?php endif?>						                    	
          <?php if(Yii::app()->user->checkAccess('BrandManage')):?>			          
          <li <?php if ($active=="brand"){ echo 'class="active"';}?> ><a href="<?php echo Yii::app()->createUrl("brand/index")?>"><i class="fa fa-truck fa-fw"></i> Marcas</a></li>
          <?php endif?>			                    	
          <?php if(Yii::app()->user->checkAccess('PriceListManage')):?>			          
          <li <?php if ($active=="priceList"){ echo 'class="active"';}?> ><a href="<?php echo Yii::app()->createUrl("priceList/index")?>"><i class="fa fa-book fa-fw"></i> Listas de Precios</a></li>
          <?php endif?>			                    	
          <?php if(Yii::app()->user->checkAccess('CustomerManage')):?>			          
          <li <?php if ($active=="customer"){ echo 'class="active"';}?> ><a href="<?php echo Yii::app()->createUrl("customer/index")?>"><i class="fa fa-glass fa-fw"></i> Clientes</a></li>
          <?php endif?>			                    	
          <?php if(Yii::app()->user->checkAccess('ProjectManage')):?>			          
          <li <?php if ($active=="project"){ echo 'class="active"';}?> ><a href="<?php echo Yii::app()->createUrl("project/index")?>"><i class="fa fa-building fa-fw"></i> Proyectos</a></li>
          <?php endif?>                    	
          <?php if(Yii::app()->user->checkAccess('AreaManage')):?>			          
          <li <?php if ($active=="area"){ echo 'class="active"';}?> ><a href="<?php echo Yii::app()->createUrl("area/index")?>"><i class="fa fa-cutlery fa-fw"></i> Areas</a></li>
          <?php endif?>                    	
          <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">M&aacute;s <i class="fa fa-caret-down fa-fw"></i></a>
                        <ul class="dropdown-menu">
				          <?php if(Yii::app()->user->checkAccess('BudgetManage')):?>			          
                	      <li><a href="#">Permisos</a></li>
				          <?php endif?>			                    	
                	      <?php if(Yii::app()->user->checkAccess('UserManage')):?>			          
                	      <li><a href="#">Usuarios</a></li>
				          <?php endif?>			                    	
                	      <?php if(Yii::app()->user->checkAccess('ImporterManage')):?>			          
                	      <li><a href="<?php echo Yii::app()->createUrl("importer/index")?>">Importadores</a></li>
				          <?php endif?>			                    	
                	      <?php if(Yii::app()->user->checkAccess('ProductRequirementManage')):?>			          
                	      <li><a href="<?php echo Yii::app()->createUrl("productRequirement/index")?>">Requerimientos</a></li>
				          <?php endif?>			                    	
                	      <?php if(Yii::app()->user->checkAccess('ServiceManage')):?>			          
                	      <li><a href="<?php echo Yii::app()->createUrl("service/index")?>">Servicios</a></li>
				          <?php endif?>			                    	
				          <?php if(Yii::app()->user->checkAccess('CurrencyManage')):?>			          
                	      <li><a href="<?php echo Yii::app()->createUrl("currency/index")?>">Monedas</a></li>
				          <?php endif?>
                	      </ul>
          </li>
          </ul>
          <ul class="nav navbar-nav pull-right">
          <li><a href="<?php echo Yii::app()->createUrl('site/logout')?>"><i class="fa fa-sign-out fa-fw"></i> Salir</a></li>
          </ul>

        </div><!-- /.navbar-collapse -->
      </nav>