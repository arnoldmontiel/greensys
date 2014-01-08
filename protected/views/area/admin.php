<div class="container" id="screenAreas">
  <div class="row">
    <div class="col-sm-6">
  <h1 class="pageTitle">&Aacute;reas</h1>
  </div>
    <div class="col-sm-6 align-right">
  <a id="createArea" class="btn btn-primary superBoton" data-toggle="modal" data-target="#myModalCrearArea"><i class="fa fa-plus"></i> Agregar &Aacute;rea</a>
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
					array('id'=>'1','value'=>'Si')
					)
					,'id','value'
			),
		),		array(
				'header'=>'Acciones',
				'value'=>'"<button type=\"button\" class=\"btn btn-default btn-sm\" onclick=\"updateArea(".$data->Id.");\" ><i class=\"fa fa-pencil\"></i> Editar</button>".'.
				'"<button type=\"button\" class=\"btn btn-default btn-sm\" onclick=\"deleteArea(".$data->Id.");\" ><i class=\"fa fa-trash-o\"></i> Borrar</button>"',
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
$('#createArea').click(
		function(){
			$.post(
			'<?php echo AreaController::createUrl('area/AjaxShowCreateModal')?>',{field_caller:'area-grid'}).success(
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
function deleteArea(id)
{
	if(confirm("¿Seguro desea eliminar el área?"))
	{
		$.post(
				'<?php echo AreaController::createUrl('area/AjaxDelete')?>',{id:id}).success(
						function(data)
						{
							$.fn.yiiGridView.update('area-grid');
						}
				);
		}
}
function updateArea(id)
{
	$.post(
			'<?php echo AreaController::createUrl('area/AjaxShowUpdateModal')?>',{id:id,field_caller:'area-grid'}).success(
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