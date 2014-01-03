<div class="container" id="screenAreas">
  <div class="row">
    <div class="col-sm-6">
  <h1 class="pageTitle">&Aacute;reas</h1>
  </div>
    <div class="col-sm-6 align-right">
  <a class="btn btn-primary superBoton" data-toggle="modal" data-target="#myModalCrearArea"><i class="fa fa-plus"></i> Agregar &Aacute;rea</a>
  </div>
  </div>
  <div class="row">
    <div class="col-sm-12">
    <?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'area-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'selectableRows' => 0,
	'summaryText'=>'',		
	'itemsCssClass' => 'table table-striped table-bordered tablaIndividual',
		'columns'=>array(
		'description',
		array(
 			'name'=>"main",
 			'type'=>'raw',
 			'value'=>'CHtml::checkBox("main",$data->main,array("disabled"=>"disabled"))',
 			'filter'=>CHtml::listData(
				array(
					array('id'=>'0','value'=>'No'),
					array('id'=>'1','value'=>'Yes')
					)
					,'id','value'
			),
		),		array(
				'header'=>'Acciones',
				'value'=>'"<button type=\"button\" class=\"btn btn-default btn-sm\" onclick=\"updateBrand(".$data->Id.");\" ><i class=\"fa fa-pencil\"></i> Editar</button>".'.
				'"<button type=\"button\" class=\"btn btn-default btn-sm\" onclick=\"deleteBrand(".$data->Id.");\" ><i class=\"fa fa-trash-o\"></i> Borrar</button>"',
				'type'=>'raw',
				'htmlOptions'=>array("style"=>"text-align:right;"),
				'headerHtmlOptions'=>array("style"=>"text-align:right;"),
		),
				
	),
)); ?>
    
    </div>
    <!-- /.col-sm-12 --> 
  </div>
  <!-- /.row --> 
</div>
<!-- /container --> 

<!--MODAL CREAR PRESU-->
<div class="modal fade" id="myModalCrearArea">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Agregar &Aacute;rea</h4>
      </div>
      <div class="modal-body">

<form role="form">
  <div class="form-group">
    <label for="campoDescripcion">Descripci&oacute;n</label>
		<input type="text" id="campoNombre" class="form-control">
  </div>
</form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary btn-lg"><i class="fa fa-save"></i> Guardar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
