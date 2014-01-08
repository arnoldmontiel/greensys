<?php $this->pageTitle=Yii::app()->name; ?>
<div class="container" id="screenInicio">
  <h1 class="pageTitle">Dashboard</h1>
  <div class="row">
    <div class="col-md-8">
      <div class="row">
      <?php if(Yii::app()->user->checkAccess('ProductManage')):?>			
      
        <div class="col-md-6">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title"><i class="fa fa-star fa-fw"></i> Productos</h3>
            </div>
            <div class="panel-body">
              <div class="list-group"> <a href="<?php echo Yii::app()->createUrl('product')?>" class="list-group-item">Ver Productos <i class="fa fa-list fa-fw pull-right"></i></a> <a href="<?php echo Yii::app()->createUrl('product')?>" class="list-group-item">Ver Prod. por Marcas <i class="fa fa-list fa-fw pull-right"></i></a> <a href="<?php echo Yii::app()->createUrl('product')?>" class="list-group-item">Ver Pendientes <i class="fa fa-warning fa-fw pull-right"></i></a> <a href="<?php echo Yii::app()->createUrl('product')?>" class="list-group-item">Cargar Excel de Marca <i class="fa fa-upload fa-fw pull-right"></i></a> </div>
            </div>
          </div>
        </div>
        <?php endif?>
        <!-- /.col-md-6 -->
      	<?php if(Yii::app()->user->checkAccess('PriceListManage')):?>			
        <div class="col-md-6">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title"><i class="fa fa-book fa-fw"></i> Listas de Precios</h3>
            </div>
            <div class="panel-body">
              <div class="list-group"> <a href="<?php echo Yii::app()->createUrl('priceList/admin')?>" class="list-group-item">Ver Precios Compra <i class="fa fa-list fa-fw pull-right"></i></a> <a href="<?php echo Yii::app()->createUrl('priceList/admin')?>" class="list-group-item">Ver Precios Venta <i class="fa fa-list fa-fw pull-right"></i></a> </div>
            </div>
          </div>
        </div>
        <!-- /.col-md-6 --> 
        <?php endif?>
       </div>
      <!-- /.row -->
      <?php if(Yii::app()->user->checkAccess('ProjectManage')):?>			
       <div class="row">
        <div class="col-md-6">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title"><i class="fa fa-building fa-fw"></i> Proyectos</h3>
            </div>
            <div class="panel-body">
              <div class="list-group"> <a href="<?php echo Yii::app()->createUrl('project/admin')?>" class="list-group-item">Ver Proyectos <i class="fa fa-list fa-fw pull-right"></i></a> <a href="<?php echo Yii::app()->createUrl('project/create')?>" class="list-group-item">Crear Proyecto <i class="fa fa-plus fa-fw pull-right"></i></a> </div>
            </div>
          </div>
        </div>
        <!-- /.col-md-6 -->
        <?php endif?>
      	<?php if(Yii::app()->user->checkAccess('SupplierMagane')||Yii::app()->user->checkAccess('SupplierManage')):?>			
        <div class="col-md-6">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title"><i class="fa fa-truck fa-fw"></i> Proveedores</h3>
            </div>
            <div class="panel-body">
              <div class="list-group"> <a href="<?php echo Yii::app()->createUrl('supplier/admin')?>" class="list-group-item">Ver Proveedores <i class="fa fa-list fa-fw pull-right"></i></a> <a href="<?php echo Yii::app()->createUrl('supplier/create')?>" class="list-group-item">Crear Proveedor <i class="fa fa-plus fa-fw pull-right"></i></a> </div>
            </div>
          </div>
        </div>
        <!-- /.col-md-6 --> 
        <?php endif?>
        <?php if(Yii::app()->user->checkAccess('CustomerManage')):?>			
        </div>
      <!-- /.row -->
      <div class="row">
        <div class="col-md-6">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title"><i class="fa fa-glass fa-fw"></i> Clientes</h3>
            </div>
            <div class="panel-body">
              <div class="list-group"> <a href="<?php echo Yii::app()->createUrl('customer/admin')?>" class="list-group-item">Ver Clientes <i class="fa fa-list fa-fw pull-right"></i></a> <a href="<?php echo Yii::app()->createUrl('budget/create')?>" class="list-group-item">Crear Cliente <i class="fa fa-plus fa-fw pull-right"></i></a> </div>
            </div>
          </div>
        </div>
        <?php endif?>
        <!-- /.col-md-6 -->
        <?php if(Yii::app()->user->checkAccess('BudgetManage')):?>			
        <div class="col-md-6">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title"><i class="fa fa-dollar fa-fw"></i> Presupuestos</h3>
            </div>
            <div class="panel-body">
              <div class="list-group"> 
              	<a href="<?php echo Yii::app()->createUrl('budget/admin')?>" class="list-group-item">Ver Presupuestos 
              		<i class="fa fa-list fa-fw pull-right"></i>
              	</a> 
              	<a href="<?php echo Yii::app()->createUrl('budget/create')?>" class="list-group-item">Crear Presupuesto 
              		<i class="fa fa-plus fa-fw pull-right"></i>
              	</a>
              	</div>
            </div>
          </div>
        </div>
        <!-- /.col-md-6 --> 
        <?php endif?>
        </div>
      <!-- /.row --> 
    </div>
    <!-- /.col-md-8 -->
    
    <div class="col-md-4">
      <div class="panel panel-success">
        <div class="panel-heading">
          <h3 class="panel-title"><i class="fa fa-cog fa-fw"></i> GREEN Setup</h3>
        </div>
        <div class="panel-body">
          <p>Completa los siguientes pasos en orden para comenzar a presupuestar:</p>
        </div>
<ul class="list-group">
<li class="list-group-item"><span class="listNumber done">1</span> Cargar Areas <span class="label label-success pull-right"><i class="fa fa-check fa-fw"></i> Hecho</span></li>
  <li class="list-group-item"><span class="listNumber">2</span> Cargar Servicios <button type="button" class="btn btn-default pull-right">Completar</button></li>
  <li class="list-group-item"><span class="listNumber">2</span> Cargar Proveedores <button type="button" class="btn btn-default pull-right">Completar</button></li>
  <li class="list-group-item"><span class="listNumber">2</span> Cargar Productos <button type="button" class="btn btn-default pull-right">Completar</button></li>
  <li class="list-group-item"><span class="listNumber">2</span> Cargar Clientes <button type="button" class="btn btn-default pull-right">Completar</button></li>
  <li class="list-group-item"><span class="listNumber">3</span> Cargar Proyectos <button type="button" class="btn btn-default pull-right">Completar</button></li>
</ul>
        <div class="panel-body">
   <div class="alert alert-success">
        <h4>Setup Completo!</h4>
        <p>Ya podes comenzar a presupuestar:</p>
        <p>
          <button type="button" class="btn btn-primary"><i class="fa fa-plus"></i> Crear Presupuesto</button>
        </p>
      </div>
      </div>
        </div>
    <!-- /.panel -->
    </div>
    <!-- /.col-md-4 --> 
    
  </div>
  <!-- /.row --> 
</div>
