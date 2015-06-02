<div class="container" id="screenCustomers">
	<div class="row">
		<div class="col-sm-6">
			<h1 class="pageTitle">Clientes</h1>
		</div>
		<div class="col-sm-6 align-right">
			<a onclick="openNewCustomer();" class="btn btn-primary superBoton" data-toggle="modal" data-target="myModalFormCustomer"><i class="fa fa-plus"></i> Crear Cliente</a>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12">
		    <?php 
		    $this->widget('zii.widgets.grid.CGridView', array(
			'id'=>'customer-grid',
			'dataProvider'=>$model->searchCustomer(),
			'filter'=>$model,
			'selectableRows' => 0,
			'summaryText'=>'',		
			'itemsCssClass' => 'table table-striped table-bordered tablaIndividual',
				'columns'=>array(
						array(
								'name'=>'name',
								'value'=>'$data->person->name',
								'htmlOptions'=>array("style"=>"width:10%;"),
						),
						array(
								'name'=>'last_name',
								'value'=>'$data->person->last_name',
								'htmlOptions'=>array("style"=>"width:15%;"),
						),
						array(
								'header'=>'Direcciones',
								'value'=>function($data){
									$alias ="";
									$first = true;
									foreach($data->projects as $project)
									{
										if($first)
										{
											$first = false;
											
										}else
										{
											$alias.="<br/>";
										}
										$alias .= '&bull; '.$project->description;										
									}
									return $alias;
								},
								'type'=>'html',
								'htmlOptions'=>array("style"=>"width:15%;"),
						),
						
						array(
								'header'=>'Telefono',
								'value'=>function($data){
									$phone = '';
									$type = 'Movil';
									if(!empty($data->contact->telephone_1))
									{
										if(!empty($data->contact->tel1_description))
											$type = $data->contact->tel1_description;
										
										$phone = '&bull; '.$type.': '.$data->contact->telephone_1;
									}
									if(!empty($data->contact->telephone_2))
									{
										if(!empty($data->contact->tel2_description))
											$type = $data->contact->tel2_description;
										
										$phone .= '<br/>&bull; '.$type.': '.$data->contact->telephone_2;
									}
									if(!empty($data->contact->telephone_3))
									{
										if(!empty($data->contact->tel3_description))
											$type = $data->contact->tel3_description;
										
										$phone .= '<br/>&bull; '.$type.': '.$data->contact->telephone_3;
									}
									return $phone;
								},
								'type'=>'html',
								'htmlOptions'=>array("style"=>"width:15%;"),
						),
						array(
								'header'=>'Correo',
								'value'=>function($data){
									$email = '';
									$alias = '';
									if(!empty($data->contact->email))
									{
										if(!empty($data->contact->email_description))
											$alias = ' ('.$data->contact->email_description.')';
						
										$email = '&bull; '.$data->contact->email.$alias;
									}
									if(!empty($data->contact->email_2))
									{
										if(!empty($data->contact->email_2_description))
											$alias = ' ('.$data->contact->email_2_description.')';
						
										$email .= '<br/>&bull; '.$data->contact->email_2.$alias;
									}
									if(!empty($data->contact->email_3))
									{
										if(!empty($data->contact->email_3_description))
											$alias = ' ('.$data->contact->email_._description.')';
						
										$email .= '<br/>&bull; '.$data->contact->email_3.$alias;
									}
									return $email;
								},
								'type'=>'html',
								'htmlOptions'=>array("style"=>"width:20%;"),
						),
						array(
								'header'=>'Acciones',
								'value'=>function($data){
									$grid = "'budget-grid-open'";
									return '<div class="buttonsTable">
												<button onclick="viewCustomer('.$data->Id.');" type="button" class="btn btn-default btn-sm"><i class="fa fa-eye"></i> Ver</button>
												<button onclick="updateCustomer('.$data->Id.');" type="button" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar</button>
												<button onclick="removeCustomer('.$data->Id.');" type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button>
											</div>';
								},
								'type'=>'raw',
								'htmlOptions'=>array("style"=>"width:20%;text-align:right;"),
								'headerHtmlOptions'=>array("style"=>"text-align:right;"),
						),
			),
		)); 
		?>
		</div>
    	<!-- /.col-sm-12 --> 
	</div>
	<!-- /.row --> 
</div>
<!-- /container --> 

<script type="text/javascript">
function openNewCustomer()
{
	$.post("<?php echo CustomerController::createUrl('AjaxOpenNewCustomer'); ?>"
	).success(
		function(data){
			$('#myModalFormCustomer').html(data);
	   		$('#myModalFormCustomer').modal('show');	  
		});
}

function removeCustomer(id)
{
	if(confirm("¿Seguro desea eliminar el cliente?"))
	{
		$.post(
				'<?php echo CustomerController::createUrl('AjaxDelete')?>',{id:id}).success(
						function(data)
						{
							if(data == 0)
							{
								alert("El cliente no pudo ser borrado ya que posee relaciones con presupuestos");
							}
							else
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
						$('#myModalFormCustomer').html(data);
						$('#myModalFormCustomer').modal('show');
					}
				}
			);

}
function viewCustomer(id)
{
	window.location = '<?php echo CustomerController::createUrl('customer/view')?>'+'&id='+id; 
}

</script>