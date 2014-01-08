<div class="container" id="screenProjects">
  <div class="row">
    <div class="col-sm-6">
  <h1 class="pageTitle">Proyectos</h1>
  </div>
    <div class="col-sm-6 align-right">
  <a id="createCostomer" class="btn btn-primary superBoton" data-toggle="modal" data-target="#myModalCrearProject"><i class="fa fa-plus"></i> Agregar Projecto</a>
  </div>
  </div>
  <div class="row">
    <div class="col-sm-12">
    <?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'project-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'selectableRows' => 0,
	'summaryText'=>'',		
	'itemsCssClass' => 'table table-striped table-bordered tablaIndividual',
		'columns'=>array(
				array('name'=>'contact_description','value'=>'$data->customer->contact->description'),
				'description',
				'address',
				array(
				'header'=>'Acciones',
				'value'=>'"<button type=\"button\" class=\"btn btn-default btn-sm\" onclick=\"updateProject(".$data->Id.");\" ><i class=\"fa fa-pencil\"></i> Editar</button>"',
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

<script type="text/javascript">
$('#createProject').click(
		function(){
			$.post(
			'<?php echo ProjectController::createUrl('project/AjaxShowCreateModal')?>',{field_caller:'custoemr-grid'}).success(
					function(data)
					{
					if(data!=null)
					{	
						$('#modalPlaceHolder').html(data);
						$('#modalPlaceHolder').modal('show');
					}
				}
			);
		return false;
		}
		);
function deleteProject(id)
{
	if(confirm("¿Seguro desea eliminar el cliente?"))
	{
		$.post(
				'<?php echo ProjectController::createUrl('project/AjaxDelete')?>',{id:id}).success(
						function(data)
						{
							$.fn.yiiGridView.update('project-grid');
						}
				);
		}
}
function updateProject(id)
{
	$.post(
			'<?php echo ProjectController::createUrl('project/AjaxShowUpdateModal')?>',{id:id,field_caller:'project-grid'}).success(
					function(data)
					{
					if(data!=null)
					{	
						$('#modalPlaceHolder').html(data);
						$('#modalPlaceHolder').modal('show');
					}
				}
			);

}

</script>
