<div class="container" id="screenListasPrecios">
<h1 class="pageTitle">Listas de Precios</h1>

<div class="row">
<div class="col-sm-12">
<ul class="nav nav-tabs">
        <li class="active"><a href="#tabTodas" data-toggle="tab">Todas</a></li>
        <li><a href="#tabVenta" data-toggle="tab">Venta</a></li>
        <li><a href="#tabCompra" data-toggle="tab">Compra</a></li>
      </ul>
      
<div class="tab-content">
<div class="tab-pane active" id="tabTodas">
<table class="table table-striped table-bordered tablaIndividual">
<thead>
<tr>
<th>Tipo</th>
<th>Proveedor</th>
<th>Importador</th>
<th>Fecha Creaci&oacute;n</th>
<th>Fecha de Valid&eacute;z</th>
<th style="text-align:right;">Acciones</th>
</tr>
</thead>
<tbody>
<tr>
<td>Compra</td>
<td>RTI</td>
<td>Luis - Muebles</td>
<td>20/12/2013</td>
<td>20/12/2014</td>
<td style="text-align:right;">
<button type="button" class="btn btn-default btn-sm"><i class="fa fa-eye"></i> Ver</button>
<button type="button" class="btn btn-default btn-sm"><i class="fa fa-download"></i> Descargar</button>
</td>
</tr>
</tbody>
</table>
</div><!-- /.tab1 --> 
</div><!-- /.tab-content -->     
      
</div><!-- /.col-sm-12 --> 
</div><!-- /.row --> 
</div><!-- /.container --> 

<div class="container" id="screenlistaPrecio">
<h1 class="pageTitle">Listas de Precios</h1>
<div class="row panelPresu">
    <div class="col-sm-12">
    
          <h2 class="pull-left">Compra - Luis Muebles</h2>
<button type="button" class="btn btn-primary marginLeft pull-right"><i class="fa fa-download fa-fw"></i> Descargar</button>
</div></div>
<div class="row panelPresu">
    <div class="col-sm-12">
<table class="table table-striped table-bordered tablaIndividual">
<thead>
<tr>
<th>Modelo</th>
<th>Part Number</th>
<th>Marca</th>
<th class="align-center">Profit Rate</th>
<th class="align-center">Dealer Cost</th>
<th class="align-center">MSRP</th>
<th class="align-right">Acciones</th>
</tr>
</thead>
<tbody>
<tr>
<td>PP-JJ</td>
<td>10-210341-12</td>
<td>RTI</td>
<td class="align-center"><input class="form-control inputMed align-right" type="text" value="0.00"></td>
<td class="align-center"><input class="form-control inputMed align-right" type="text" value="0.00"></td>
<td class="align-center"><input class="form-control inputMed align-right" type="text" value="0.00"></td>
<td class="align-right"><button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i> Reset</button></td>
</tr>
<tr>
<td>PP-JJ</td>
<td>10-210341-12</td>
<td>RTI</td>
<td class="align-center"><input class="form-control inputMed align-right" type="text" value="0.00"></td>
<td class="align-center"><input class="form-control inputMed align-right" type="text" value="0.00"></td>
<td class="align-center"><input class="form-control inputMed align-right" type="text" value="0.00"></td>
<td class="align-right"><button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i> Reset</button></td>
</tr>
<tr>
<td>PP-JJ</td>
<td>10-210341-12</td>
<td>RTI</td>
<td class="align-center"><input class="form-control inputMed align-right" type="text" value="0.00"></td>
<td class="align-center"><input class="form-control inputMed align-right" type="text" value="0.00"></td>
<td class="align-center"><input class="form-control inputMed align-right" type="text" value="0.00"></td>
<td class="align-right"><button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i> Reset</button></td>
</tr>
<tr>
<td>PP-JJ</td>
<td>10-210341-12</td>
<td>RTI</td>
<td class="align-center"><input class="form-control inputMed align-right" type="text" value="0.00"></td>
<td class="align-center"><input class="form-control inputMed align-right" type="text" value="0.00"></td>
<td class="align-center"><input class="form-control inputMed align-right" type="text" value="0.00"></td>
<td class="align-right"><button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i> Reset</button></td>
</tr>
<tr>
<td>PP-JJ</td>
<td>10-210341-12</td>
<td>RTI</td>
<td class="align-center"><input class="form-control inputMed align-right" type="text" value="0.00"></td>
<td class="align-center"><input class="form-control inputMed align-right" type="text" value="0.00"></td>
<td class="align-center"><input class="form-control inputMed align-right" type="text" value="0.00"></td>
<td class="align-right"><button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i> Reset</button></td>
</tr>
</tbody>
</table> 
      
</div><!-- /.col-sm-12 --> 
</div><!-- /.row --> 
</div><!-- /.container --> 

<div class="container" id="screenCustomers">
  <div class="row">
    <div class="col-sm-6">
  <h1 class="pageTitle">Clientes</h1>
  </div>
    <div class="col-sm-6 align-right">
  <a id="createCostomer" class="btn btn-primary superBoton" data-toggle="modal" data-target="#myModalCrearCustomer"><i class="fa fa-plus"></i> Agregar &Aacute;rea</a>
  </div>
  </div>
  <div class="row">
    <div class="col-sm-12">
    <?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'price-list-grid',
	'dataProvider'=>$model->searchSummary(),
	'filter'=>$model,
	'selectableRows' => 0,
	'summaryText'=>'',		
	'itemsCssClass' => 'table table-striped table-bordered tablaIndividual',
		'columns'=>array(
 		array(
  			'name'=>"Id_price_list_type",//$model->getAttributeLabel('validity'),
  			'type'=>'raw',
  			'value'=>'isset($data->priceListType)?$data->priceListType->name:""',
  			'filter'=>CHtml::listData(
 				array(
 					array('id'=>'1','value'=>'Compra'),
 					array('id'=>'2','value'=>'Venta')
 				)
 				,'id','value'
 			),
 		),
		array(
			'name'=>'supplier_business_name',
			'value'=>'isset($data->supplier)?$data->supplier->business_name:""',
		),
		array(
			'name'=>'Id_importer',
			'value'=>'isset($data->importer)?$data->importer->contact->description:""',
		),
		'description',	
		'date_creation',
		'date_validity',
 		array(
 			'name'=>"validity",//$model->getAttributeLabel('validity'),
 			'type'=>'raw',
 			'value'=>'CHtml::checkBox("validity",$data->validity,array("disabled"=>"disabled"))',
 			'filter'=>CHtml::listData(
 				array(
 					array('id'=>'0','value'=>'No'),
 					array('id'=>'1','value'=>'Yes')
 				)
 				,'id','value'
 			),
 		),		
		array(
				'header'=>'Acciones',
				'value'=>'"<button type=\"button\" class=\"btn btn-default btn-sm\" onclick=\"updateCustomer(".$data->Id.");\" ><i class=\"fa fa-pencil\"></i> Editar</button>"',
				'type'=>'raw',
				'htmlOptions'=>array("style"=>"text-align:right;"),
				'headerHtmlOptions'=>array("style"=>"text-align:right;"),
		),
array(
		'class'=>'CButtonColumn',
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