<div class="container" id="screenCustomers">
  <div class="row">
    <div class="col-sm-6">
  <h1 class="pageTitle">Clientes</h1>
  </div>
    <div class="col-sm-6 align-right">
    <a href="<?php echo Yii::app()->createUrl("customer/view");?>" class="btn btn-primary superBoton" ><i class="fa fa-plus"></i> AAAAAA</a>
  <a id="createCostomer" class="btn btn-primary superBoton" data-toggle="modal" data-target="#myModalCrearCustomer"><i class="fa fa-plus"></i> Agregar &Aacute;rea</a>
  </div>
  </div>
  <div class="row">
    <div class="col-sm-12">
    <?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'customer-grid',
	'dataProvider'=>$model->searchCustomer(),
	'filter'=>$model,
	'selectableRows' => 0,
	'summaryText'=>'',		
	'itemsCssClass' => 'table table-striped table-bordered tablaIndividual',
		'columns'=>array(
				array(
						'name'=>'description',
						'value'=>'$data->contact->description',
				),
				array(
						'name'=>'last_name',
						'value'=>'$data->person->last_name',
				),
				array(
						'name'=>'name',
						'value'=>'$data->person->name',
				),
				array(
						'name'=>'telephone_1',
						'value'=>'$data->contact->telephone_1',
				),
				array(
						'name'=>'email',
						'value'=>'$data->contact->email',
				),				
				array(
				'header'=>'Acciones',
				'value'=>'"<div class=\"buttonsTable\"><button type=\"button\" class=\"btn btn-default btn-sm\" onclick=\"updateCustomer(".$data->Id.");\" ><i class=\"fa fa-pencil\"></i> Editar</button></div>"',
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
$('#createCustomer').click(
		function(){
			$.post(
			'<?php echo CustomerController::createUrl('customer/AjaxShowCreateModal')?>',{field_caller:'custoemr-grid'}).success(
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
function deleteCustomer(id)
{
	if(confirm("¿Seguro desea eliminar el cliente?"))
	{
		$.post(
				'<?php echo CustomerController::createUrl('customer/AjaxDelete')?>',{id:id}).success(
						function(data)
						{
							$.fn.yiiGridView.update('customer-grid');
						}
				);
		}
}
function updateCustomer(id)
{
	$.post(
			'<?php echo CustomerController::createUrl('customer/AjaxShowUpdateModal')?>',{id:id,field_caller:'customer-grid'}).success(
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