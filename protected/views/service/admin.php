
	<div class="container" id="screenServices">
  <div class="row">
    <div class="col-sm-6">
  <h1 class="pageTitle">Servicios</h1>
  </div>
    <div class="col-sm-6 align-right">
  <a id="createService" class="btn btn-primary superBoton" data-toggle="modal" data-target="#myModalCrearService"><i class="fa fa-plus"></i> Agregar Servicio</a>
  </div>
  </div>
  <div class="row">
    <div class="col-sm-12">
    <?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'service-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'selectableRows' => 0,
	'summaryText'=>'',		
	'itemsCssClass' => 'table table-striped table-bordered tablaIndividual',
		'columns'=>array(
		'description',				
		array(
			'header'=>'Descripci&oacute;n',
			'value'=>'GreenHelper::cutString($data->long_description==""?$data->service->long_description:$data->long_description,250)',
			'type'=>'raw',
			'htmlOptions'=>array("width"=>"70%;"),
			'headerHtmlOptions'=>array("width"=>"70%;"),
		),
		array(
				'header'=>'Acciones',
				'value'=>'"<div class=\"buttonsTableProd\"><button type=\"button\" class=\"btn btn-default btn-sm\" onclick=\"updateService(".$data->Id.");\" ><i class=\"fa fa-pencil\"></i> Editar</button>".'.
				'"<button type=\"button\" class=\"btn btn-default btn-sm\" onclick=\"deleteServices(".$data->Id.");\" ><i class=\"fa fa-trash-o\"></i> Borrar</button></div>"',
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
$('#createService').click(
		function(){
			$.post(
			'<?php echo ServiceController::createUrl('service/AjaxShowCreateModal')?>',{field_caller:'service-grid'}).success(
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
function deleteService(id)
{
	if(confirm("¿Seguro desea eliminar el servicio?"))
	{
		$.post(
				'<?php echo ServiceController::createUrl('service/AjaxDelete')?>',{id:id}).success(
						function(data)
						{
							$.fn.yiiGridView.update('service-grid');
						}
				);
		}
}
function updateService(id)
{
	$.post(
			'<?php echo ServiceController::createUrl('service/AjaxShowUpdateModal')?>',{id:id,field_caller:'service-grid'}).success(
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