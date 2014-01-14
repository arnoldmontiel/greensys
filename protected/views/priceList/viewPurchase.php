<div class="container" id="screenlistaPrecio">
<h1 class="pageTitle pull-left">Listas de Precios</h1>
         <button type="button" class="btn btn-default marginLeft pull-right""><i class="fa fa-arrow-left fa-fw"></i> Volver</button>
<div class="clear"></div>
<div class="row panelPresu">
    <div class="col-sm-12">
    
          <h2 class="pull-left">Compra - <?php echo $model->supplier->business_name;?></h2>
<button type="button" class="btn btn-primary marginLeft pull-right"><i class="fa fa-download fa-fw"></i> Descargar</button>
<div class="clear"></div>
          <div>Creacion: <?php echo $model->date_creation;?> - Validez: <?php echo $model->date_validity;?></div>
</div></div>
<div class="row contenedorPresu">
    <div class="col-sm-12">
 <?php
    $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'price-list-item-grid',
	'dataProvider'=>$modelPriceListItem->searchPriceList(),
	'filter'=>$modelPriceListItem,
	'selectableRows' => 0,
	'summaryText'=>'',		
	'itemsCssClass' => 'table table-striped table-bordered tablaIndividual',
		'columns'=>array(
		array(
			'header'=>'Modelo',
			'name'=>'model',
			'value'=>'$data->product->model',
		),
		array(
				'header'=>'Part Number',
				'name'=>'part_number',
				'value'=>'$data->product->part_number',
		),
		array(
				'header'=>'Dealer Cost',
				'name'=>'dealer_cost',
				'value'=>
				function($data){
					return '<span class="label label-primary labelPrecio">'.$data->dealer_cost.' <div class="usd">'.$data->priceList->currency->short_description.'</div></span>';
				},
				'type'=>'raw',				
				'htmlOptions'=>array('class'=>'align-right')
		),
		array(
				'header'=>'Profit Rate',
				'name'=>'profit_rate',
				'value'=>'$data->profit_rate',
				'htmlOptions'=>array('class'=>'align-right')
		),
		array(
				'header'=>'MSRP',
				'name'=>'msrp',
				'value'=>'$data->msrp." ".$data->priceList->currency->short_description',
				'htmlOptions'=>array('class'=>'align-right')
		),
	),
	));
 ?>
      
</div><!-- /.col-sm-12 --> 
</div><!-- /.row --> 
</div><!-- /.container --> 
