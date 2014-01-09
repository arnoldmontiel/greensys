<div class="container" id="screenCurrency">
  <div class="row">
    <div class="col-sm-6">
  <h1 class="pageTitle">Monedas</h1>
  </div>
    <div class="col-sm-6 align-right">
  <a onclick="createCurrency()" id="createService" class="btn btn-primary superBoton" data-toggle="modal" data-target="#myModalCrearService"><i class="fa fa-plus"></i> Agregar Moneda</a>
  </div>
  </div>
  <div class="row">
    <div class="col-sm-12">
    <?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'currency-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'selectableRows' => 0,
	'summaryText'=>'',		
	'itemsCssClass' => 'table table-striped table-bordered tablaIndividual',
		'columns'=>array(
		'description',
		'short_description',
		array(
				'header'=>'Acciones',
				'value'=>function($data){				
					return '<button onclick="updateCurrency('.$data->Id.');" type="button" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar</button>
    						<button onclick="deleteCurrency('.$data->Id.');" type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button>';
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
function createCurrency()
{
	$.post(
			'<?php echo CurrencyController::createUrl('currency/AjaxShowCreateModal')?>',{field_caller:'currency-grid'}).success(
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
function deleteCurrency(id)
{
	if(confirm("¿Seguro desea eliminar la moneda?"))
	{
		$.post(
				'<?php echo CurrencyController::createUrl('currency/AjaxDelete')?>',{id:id}).success(
						function(data)
						{
							$.fn.yiiGridView.update('service-grid');
						}
				);
		}
}
function updateCurrency(id)
{
	$.post(
			'<?php echo CurrencyController::createUrl('currency/AjaxShowUpdateModal')?>',{id:id,field_caller:'currency-grid'}).success(
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