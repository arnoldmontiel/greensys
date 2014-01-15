<!--  ACA EMPIEZA LA PANTALLA DE LISTADO DE LISTAS DE PRECIOS -->

<div class="container" id="screenListasPrecios">
<h1 class="pageTitle">Listas de Precios &raquo; Venta</h1>

<div class="row">
<div class="col-sm-12">
<?php
    $model->Id_price_list_type=2;
    $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'price-list-sales-grid',
	'dataProvider'=>$model->searchSummary(),
	'filter'=>$model,
	'selectableRows' => 0,
	'summaryText'=>'',		
	'itemsCssClass' => 'table table-striped table-bordered tablaIndividual',
		'columns'=>array(
		array(
			'name'=>'Id_importer',
			'value'=>'isset($data->importer)?$data->importer->contact->description:""',
		),
		'description',	
		'date_creation',
		'date_validity', 				
		array(
				'header'=>'Acciones',
				'value'=>function($data){
							return '<button onclick="viewSale('.$data->Id.');" type="button" class="btn btn-default btn-sm"><i class="fa fa-eye"></i> Ver</button>';
						},
				'type'=>'raw',
				'htmlOptions'=>array("style"=>"text-align:right;"),
				'headerHtmlOptions'=>array("style"=>"text-align:right;"),
		),
				
	),
)); ?>
</div><!-- /.col-sm-12 --> 
</div><!-- /.row --> 


<h1 class="pageTitle">Listas de Precios &raquo; Compra</h1>

<div class="row">
<div class="col-sm-12">
      
    <?php
    $model->Id_price_list_type=1;
    $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'price-list-purchase-grid',
	'dataProvider'=>$model->searchSummary(),
	'filter'=>$model,
	'selectableRows' => 0,
	'summaryText'=>'',		
	'itemsCssClass' => 'table table-striped table-bordered tablaIndividual',
		'columns'=>array(
		array(
			'header'=>'Marca',
			'name'=>'supplier_business_name',
			'value'=>'isset($data->supplier)?$data->supplier->business_name:""',
		),
		'description',	
		'date_creation',
		'date_validity',
		array(
				'header'=>'Acciones',
				'value'=>function($data){
					return '<button onclick="viewPruchase('.$data->Id.');" type="button" class="btn btn-default btn-sm"><i class="fa fa-eye"></i> Ver</button>';
				},
				'type'=>'raw',
				'htmlOptions'=>array("style"=>"text-align:right;"),
				'headerHtmlOptions'=>array("style"=>"text-align:right;"),
		),				
	),
)); ?>

</div><!-- /.col-sm-12 --> 
</div><!-- /.row --> 

</div><!-- /.container --> 


<!-- /.FIN LISTADO DE LISTAS DE PRECIOS -->


<script type="text/javascript">
function viewSale(id)
{
	window.location = "<?php echo PriceListController::createUrl("viewSale")?>&id="+id;
}
function viewPruchase(id)
{
	window.location = "<?php echo PriceListController::createUrl("viewPurchase")?>&id="+id;
}

</script>