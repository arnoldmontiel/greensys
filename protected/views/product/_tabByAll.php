<a href="<?php echo ProductController::createUrl('create'); ?>" class="btn btn-primary superBoton"><i class="fa fa-plus"></i>  Agregar Producto</a>
      
      <?php		
	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'product-grid_all',
		'dataProvider'=>$modelProducts->search(),
		'selectableRows' => 0,
		'filter'=>$modelProducts,
		'summaryText'=>'',	
		'itemsCssClass' => 'table table-striped table-bordered tablaIndividual',
		'columns'=>array(	
				'model',
				'part_number',				 
				array(
		 			'name'=>'brand_description',
					'value'=>'$data->brand->description'
				),
				array(
		 			'name'=>'height',
					'value'=>'$data->showVolume($data->height)',
				),
				array(
						'name'=>'width',
						'value'=>'$data->showVolume($data->width)',
				),
				array(
						'name'=>'length',
						'value'=>'$data->showVolume($data->length)',
				),
				array(
						'name'=>'weight',
						'value'=>'$data->showWeight($data->weight)',
				),
				'profit_rate',
				array(
						'name'=>'dealer_cost',
						'value'=>'$data->showPrice($data->dealer_cost)',
				),
				array(
						'name'=>'msrp',
						'value'=>'$data->showPrice($data->msrp)',
				),
				array(
						'name'=>'short_description',
						'value'=>'GreenHelper::cutString($data->short_description,40)',
						'htmlOptions'=>array("style"=>"width:20%;"),
				),
				array(
						'header'=>'Acciones',
						'value'=>function($data){
						$grid = "'product-grid_all'";
							return '<a href="'.Yii::app()->createUrl("product/update",array('id'=>$data->Id)).'"> <div class="buttonsTableProd"><button type="button" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar</button></a>
									<button type="button" onclick="removeProduct('.$data->Id.', '.$grid.');" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button></div>';
						},
						'type'=>'raw',
						'htmlOptions'=>array("style"=>"text-align:right;"),
						'headerHtmlOptions'=>array("style"=>"text-align:right;"),
				),
			),
		));		
		?>