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
<?php $area = Area::model()->find();?>
<?php $service = Service::model()->find();?>
<?php $brand = Brand::model()->find();?>
<?php $product = Product::model()->find();?>
<?php $customer = Customer::model()->find();?>
<?php $project = Project::model()->find();?>
<?php $currencyConversor = CurrencyConversor::model()->find();?>
<?php
$criteria = new CDbCriteria;
$criteria->with[]='contact';
$criteria->addCondition('contact.description != "FOB"'); 
$importer = Importer::model()->find($criteria);
?>
<li class="list-group-item"><span class="listNumber <?php echo (isset($area)?"done":"");?>">1</span> Cargar Áreas
	 <?php if(isset($area)):?>
	<span class="label label-success pull-right">
	<i class="fa fa-check fa-fw"></i> Hecho</span>	 
	 <?php else:?>
	 <a href="<?php echo Yii::app()->createUrl('area')?>" class="btn btn-default pull-right">Completar</a>
	 <?php endif?>
  </li>
  
  <li class="list-group-item"><span class="listNumber <?php echo (isset($service)?"done":"");?>">2</span> Cargar Servicios
	 <?php if(isset($service)):?>
	<span class="label label-success pull-right">
	<i class="fa fa-check fa-fw"></i> Hecho</span>	 
	 <?php else:?>
	 <a href="<?php echo Yii::app()->createUrl('service')?>" class="btn btn-default pull-right">Completar</a>
	 <?php endif?>
  </li>
  <li class="list-group-item"><span class="listNumber <?php echo (isset($importer)?"done":"");?>">3</span> Cargar Importadores
	 <?php if(isset($importer)):?>
	<span class="label label-success pull-right">
	<i class="fa fa-check fa-fw"></i> Hecho</span>	 
	 <?php else:?>
	 <a href="<?php echo Yii::app()->createUrl('importer')?>" class="btn btn-default pull-right">Completar</a>
	 <?php endif?>
   </li>
  <li class="list-group-item"><span class="listNumber <?php echo (isset($brand)?"done":"");?>">4</span> Cargar Marcas
	 <?php if(isset($brand)):?>
	<span class="label label-success pull-right">
	<i class="fa fa-check fa-fw"></i> Hecho</span>	 
	 <?php else:?>
	 <a href="<?php echo Yii::app()->createUrl('brand')?>" class="btn btn-default pull-right">Completar</a>
	 <?php endif?>
   </li>

  <li class="list-group-item"><span class="listNumber <?php echo (isset($product)?"done":"");?>">5</span> Cargar Productos 
  	 <?php if(isset($product)):?>
	<span class="label label-success pull-right">
	<i class="fa fa-check fa-fw"></i> Hecho</span>	 
	 <?php else:?>
	 <a href="<?php echo Yii::app()->createUrl('product')?>" class="btn btn-default pull-right">Completar</a>
	 <?php endif?>
   </li>

  <li class="list-group-item"><span class="listNumber <?php echo (isset($customer)?"done":"");?>">6</span> Cargar Clientes 
  	 <?php if(isset($customer)):?>
	<span class="label label-success pull-right">
	<i class="fa fa-check fa-fw"></i> Hecho</span>	 
	 <?php else:?>
	 <a href="<?php echo Yii::app()->createUrl('customer')?>" class="btn btn-default pull-right">Completar</a>
	 <?php endif?>
  </li>

  <li class="list-group-item"><span class="listNumber <?php echo (isset($project)?"done":"");?>">7</span> Cargar Proyectos
  	 <?php if(isset($project)):?>
	<span class="label label-success pull-right">
	<i class="fa fa-check fa-fw"></i> Hecho</span>	 
	 <?php else:?>
	 <a href="<?php echo Yii::app()->createUrl('project')?>" class="btn btn-default pull-right">Completar</a>
	 <?php endif?>
   </li>
  <li class="list-group-item"><span class="listNumber <?php echo (isset($currencyConversor)?"done":"");?>">8</span> Cargar Monedas
  	 <?php if(isset($currencyConversor)):?>
	<span class="label label-success pull-right">
	<i class="fa fa-check fa-fw"></i> Hecho</span>	 
	 <?php else:?>
	 <a href="<?php echo Yii::app()->createUrl('currency')?>" class="btn btn-default pull-right">Completar</a>
	 <?php endif?>
   </li>
   </ul>
<?php if(isset($area)&&isset($service)&&isset($brand)&&isset($product)&&isset($customer)&&isset($project)&&isset($currencyConversor)&&isset($importer)):?>
        <div class="panel-body">
   <div class="alert alert-success">
        <h4>Setup Completo!</h4>
        <p>Ya podes comenzar a presupuestar:</p>
        <p>
          <a href="<?php echo Yii::app()->createUrl('budget')?>" class="btn btn-primary"><i class="fa fa-plus"></i> Crear Presupuesto</a>
        </p>
      </div>
      </div>
      <?php endif?>
        </div>
    <!-- /.panel -->
    </div>
    <!-- /.col-md-4 --> 
    
  </div>
  <!-- /.row --> 
</div>
