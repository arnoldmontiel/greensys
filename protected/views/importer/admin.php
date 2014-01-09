<!-- /EMPIEZA LISTADO IMPORTADORES --> 

<div class="container" id="screenImportadores">
<div class="row">
    <div class="col-sm-6">
  <h1 class="pageTitle">Importadores</h1>
  </div>
    <div class="col-sm-6 align-right">
  <a class="btn btn-primary superBoton" data-toggle="modal" data-target="#myModalNewImporter"><i class="fa fa-plus"></i> Agregar Importador</a>
  </div>
  </div>
<div class="row">
<div class="col-sm-12">
<table class="table table-striped table-bordered tablaIndividual">
<thead>
<tr>
<th>Contacto</th>
<th>Tel&eacute;fono 1</th>
<th>Tel&eacute;fono 2</th>
<th>E-mail</th>
<th style="text-align:right;">Acciones</th>
</tr>
</thead>
<tbody>
<tr>
<td>Luis - Electronica</td>
<td>198777266</td>
<td>55534344</td>
<td>luis@lala.com</td>
<td style="text-align:right;">
<div class="buttonsTableProd">
<a class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar</a>
<button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button>
</div>
</td>
</tr>
</tbody>
</table>   
      
</div><!-- /.col-sm-12 --> 
</div><!-- /.row --> 

</div><!-- /.container --> 


<!-- /FINAL LISTADO IMPORTADORES --> 


<!-- /EMPIEZA EDIT / NEW INDIVIDUAL IMPORTADOR --> 


<div class="container" id="screenAgregarImportador">
<h1 class="pageTitle">Agregar Importador</h1>

<div class="row">
<div class="col-sm-12">


</div><!-- /.col-sm-12 --> 
</div><!-- /.row --> 

</div><!-- /.container --> 

<!-- /TERMINA EDIT / NEW INDIVIDUAL IMPORTADOR --> 

<div id="myModalNewImporter" class="modal fade in" style="display: hidden;" aria-hidden="false"><form id="brand-form" action="/GreenCliente/index.php?r=brand/ajaxCreate" method="post">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h4 class="modal-title">Agregar Importador</h4>
      </div>
      <div class="modal-body">

      <div class="row">
  <div class="form-group col-sm-4">    
	<label>Contacto</label>
	<input class="form-control" type="text">	  
  </div>
  <div class="form-group col-sm-4">
	<label>Correo</label>
	<input class="form-control" type="text">
	</div>
  <div class="form-group col-sm-4">
	<label>Direcci&oacute;n</label>
	<input class="form-control" type="text">
	</div>
	</div>
	<div class="row">
  <div class="form-group col-sm-4">    
	<label>Tel&eacute;fono 1</label>
	<input class="form-control" type="text">	  
  </div>
  <div class="form-group col-sm-4">    
	<label>Tel&eacute;fono 2</label>
	<input class="form-control" type="text">	  
  </div>
  <div class="form-group col-sm-4">
	<label>Telefono 3</label>
	<input class="form-control" type="text">
	</div>
  </div>
        <div class="row">
  <div class="form-group col-sm-12">
 <h4>Configuraci&oacute;n de Env&iacute;o</h4>
 </div>
  </div>
        <div class="row">
  <div class="form-group col-sm-12">
	<label>Descripcion</label>
	<input class="form-control" type="text">
  </div>
  </div>
 
        <div class="row">
  <div class="col-sm-8 grupoAereo"> 
   <h4>A&eacute;reo</h4> 
  <div class="row">
  <div class="form-group col-sm-6">  
	<label>Costo por Medida de Unidad</label>
	<input class="form-control" type="text">
  </div>
  <div class="form-group col-sm-3">  
	<label>Peso Max</label>
	<input class="form-control" type="text">
  </div>
  <div class="form-group col-sm-3">  
	<label>Alto Max</label>
	<input class="form-control" type="text">
  </div>
  </div>
  <div class="row">
  <div class="form-group col-sm-6">  
	<label>Unidad</label>
	<input class="form-control" type="text">
  </div>
  <div class="form-group col-sm-3">  
	<label>Largo Max</label>
	<input class="form-control" type="text">
  </div>
  <div class="form-group col-sm-3">  
	<label>Vol Max</label>
	<input class="form-control" type="text">
  </div>
  </div>
  <div class="row">
  <div class="form-group col-sm-6">  
	<label>Dias</label>
	<input class="form-control" type="text">
  </div>
  <div class="form-group col-sm-3">  
	<label>Ancho Max</label>
	<input class="form-control" type="text">
  </div>
  <div class="form-group col-sm-3">  
	<label>Unidad Max</label>
	<input class="form-control" type="text">
  </div>
  </div>
  
 </div>
  <div class="col-sm-4 grupoMaritimo">  
   <h4>Maritimo</h4>
  <div class="form-group">  
	<label>Costo por Medida de Unidad</label>
	<input class="form-control" type="text">
  </div>
  <div class="form-group">  
	<label>Unidad</label>
	<input class="form-control" type="text">
  </div>
  <div class="form-group">  
	<label>D&iacute;as</label>
	<input class="form-control" type="text">
  </div>
 </div>
 </div>
 
    
</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Cancelar</button>
        <button id="saveBrand" type="button" class="btn btn-primary btn-lg"><i class="fa fa-save"></i> Guardar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</form>

</div>


<?php
$this->breadcrumbs=array(
	'Importers'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Importer', 'url'=>array('index')),
	array('label'=>'Create Importer', 'url'=>array('create')),
);


?>

<h1>Manage Importers</h1>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'importer-grid',
	'dataProvider'=>$model->searchSummary(),
	'filter'=>$model,
	'columns'=>array(
		array(
 			'name'=>'contact_description',
			'value'=>'$data->contact->description',
		),
		array(
 			'name'=>'contact_telephone_1',
			'value'=>'$data->contact->telephone_1',
		),
		array(
 			'name'=>'contact_telephone_2',
			'value'=>'$data->contact->telephone_2',
		),
		array(
 			'name'=>'contact_email',
			'value'=>'$data->contact->email',
		),
array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
