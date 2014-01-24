<div class="container" id="screenlistaPrecio">
<h1 class="pageTitle pull-left">Listas de Precios</h1>
         <button type="button" class="btn btn-default marginLeft pull-right" onclick="window.location = '<?php echo PriceListController::createUrl('admin')?>'"><i class="fa fa-arrow-left fa-fw"></i> Volver</button>
<div class="clear"></div>
<div class="row panelPresu">
    <div class="col-sm-12">
    
          <h2 class="pull-left">Venta - <?php echo $model->importer->contact->description;?></h2>
<button type="button" class="btn btn-primary marginLeft pull-right"><i class="fa fa-download fa-fw"></i> Descargar</button>
<div class="clear"></div>
          <div>Creacion: <?php echo $model->date_creation;?> - Validez: <?php echo $model->date_validity;?></div>
          <div>Procentaje sobre valor de los productos en envios mar&iacute;timos: <?php echo $model->importer->shippingParameters[0]->shippingParameterMaritime->percent_over_dealer_cost;?> %</div>
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
				'header'=>'Marca',
				'name'=>'brand_description',
				'value'=>'$data->product->brand->description',
		),
				array(
				'header'=>'Dealer Cost',
				'name'=>'dealer_cost',
				'value'=>
				function($data){
					return '<span class="label label-primary labelPrecio"><div class="usd">'.$data->priceList->currency->short_description.'</div> '.$data->dealer_cost.' </span>';
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
				'value'=>'$data->priceList->currency->short_description." ".$data->msrp',
				'htmlOptions'=>array('class'=>'align-right')
		),
		array(
				'header'=>'Costo Aereo',
				'name'=>'air_cost',
				'value'=>
				function($data){
					return '<span class="label label-primary labelPrecio"><i class="fa fa-plane fa-fw"></i><div class="usd">'.$data->priceList->importer->shippingParameters[0]->currency->short_description.'</div> '.$data->air_cost.'</span>';
				},
				'type'=>'raw',
				'htmlOptions'=>array('style'=>'text-align: right;'),
		),
		array(
				'header'=>'Costo Maritimo',
				'name'=>'maritime_cost',
				'value'=>
				function($data){
					return '<span class="label label-primary labelPrecio"><i class="fa fa-anchor fa-fw"></i><div class="usd">'.$data->priceList->importer->shippingParameters[0]->currency->short_description.'</div> '.$data->maritime_cost.' </span>';
				},
				'type'=>'raw',
				'htmlOptions'=>array('style'=>'text-align: right;'),
		),

	),
	));
 ?>
      
</div><!-- /.col-sm-12 --> 
</div><!-- /.row --> 
</div><!-- /.container --> 

