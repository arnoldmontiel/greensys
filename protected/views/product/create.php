<ol class="breadcrumb">
  <li><a href="productos.php">Productos</a></li>
  <li class="active"><a href="#">Agregar Producto</a></li>
</ol>

<?php echo $this->renderPartial('_formNew', array(
											'model'=>$model,
											'modelHyperlink'=>$modelHyperlink,
											'modelNote'=>$modelNote,
											'ddlSubCategory'=>$ddlSubCategory,
											'ddlRacks'=>$ddlRacks,
											)); ?>