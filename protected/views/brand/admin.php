<div class="container" id="screenMarcas">
  <div class="row">
    <div class="col-sm-6">
  <h1 class="pageTitle">Marcas</h1>
  </div>
    <div class="col-sm-6 align-right">
  <a id="createBrand" class="btn btn-primary superBoton" data-toggle="modal" data-target="#myModalCrearMarca"><i class="fa fa-plus"></i> Agregar Marca</a>
  </div>
  </div>
  <div class="row">
    <div class="col-sm-12">

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'brand-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'selectableRows' => 0,
	'summaryText'=>'',		
	'itemsCssClass' => 'table table-striped table-bordered tablaIndividual',
	'columns'=>array(
		'description',
		array(
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

<script type="text/javascript">
$('#createBrand').click(
		function(){
			$.post(
			'<?php echo ProductController::createUrl('brand/AjaxShowCreateModal')?>',{field_caller:'brand-grid'}).success(
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
function deleteBrand(id)
{
	if(confirm("¿Seguro desea eliminar la marca?"))
	{
		$.post(
				'<?php echo ProductController::createUrl('brand/AjaxDelete')?>',{id:id}).success(
						function(data)
						{
							$.fn.yiiGridView.update('brand-grid');
						}
				);
		}
}
function updateBrand(id)
{
	$.post(
			'<?php echo ProductController::createUrl('brand/AjaxShowUpdateModal')?>',{id:id,field_caller:'brand-grid'}).success(
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
		