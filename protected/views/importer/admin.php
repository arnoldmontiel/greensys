<div class="container" id="screenImportadores">
  <div class="row">
    <div class="col-sm-6">
  <h1 class="pageTitle">Importadores</h1>
  </div>
    <div class="col-sm-6 align-right">
  <a onclick="createImporter()" class="btn btn-primary superBoton" data-toggle="modal" data-target="#myModalNewImporter"><i class="fa fa-plus"></i> Agregar Importador</a>
  </div>
  </div>
  <div class="row">
    <div class="col-sm-12">
    <?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'importer-grid',
	'dataProvider'=>$model->searchSummary(),
	'filter'=>$model,
	'selectableRows' => 0,
	'summaryText'=>'',		
	'itemsCssClass' => 'table table-striped table-bordered tablaIndividual',
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
				'header'=>'Acciones',
				'value'=>function($data){				
					return '<button onclick="updateImporter('.$data->Id.');" type="button" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar</button>
    						<button onclick="deleteImporter('.$data->Id.');" type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button>';
				},
				'type'=>'raw',
				'htmlOptions'=>array("style"=>"text-align:right;"),
		),	
	),
)); ?>
    
    </div>
    <!-- /.col-sm-12 --> 
  </div>
  <!-- /.row --> 
</div>
<!-- /container --> 

<script type="text/javascript">

function createImporter()
{
	$.post("<?php echo ProductController::createUrl('AjaxOpenNewImporter'); ?>"
	).success(
		function(data){
			$('#myModalFormImporter').html(data);
	   		$('#myModalFormImporter').modal('show');	  
		});
}

function updateImporter(id)
{
	$.post("<?php echo BudgetController::createUrl('AjaxOpenUpdateImporter'); ?>",
		{
			id:id
		}
	).success(
		function(data){
			$('#myModalFormImporter').html(data);
	   		$('#myModalFormImporter').modal('show');	  
		});
	return false;
}

</script>

