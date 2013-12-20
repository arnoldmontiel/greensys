<a href="<?php echo ProductController::createUrl('create'); ?>" class="btn btn-primary superBoton"><i class="fa fa-plus"></i>  Agregar Producto</a>
      
      <?php		
	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'product-grid_',
		'dataProvider'=>$modelProducts->search(),
		'selectableRows' => 0,
		'filter'=>$modelProducts,
		'summaryText'=>'',	
		'columns'=>array(	
				'model',
				'part_number',				 
				array(
		 			'name'=>'brand_description',
					'value'=>'$data->brand->description',
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
				'short_description',
				array(
					'value'=>'CHtml::button("Editar",array("class"=>"btn btn-default btn-sm"))',
					'type'=>'raw',
				),
				array(
					'value'=>'CHtml::button("Borrar",array("class"=>"btn btn-default btn-sm"))',
					'type'=>'raw',
				),
			),
		));		
		?>