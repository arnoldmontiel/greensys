<a href="<?php echo ProductController::createUrl('create'); ?>" class="btn btn-primary superBoton"><i class="fa fa-plus"></i>  Agregar Producto</a>

<a href="<?php echo ProductController::createUrl('uploadImages'); ?>" class="btn btn-primary superBoton2"><i class="fa fa-picture-o"></i>  Agregar Im&aacute;genes</a>

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
					'htmlOptions'=>array("class"=>"align-right"),
					'headerHtmlOptions'=>array("class"=>"align-right"),
				),
				array(
						'name'=>'width',
						'value'=>'$data->showVolume($data->width)',
					'htmlOptions'=>array("class"=>"align-right"),
					'headerHtmlOptions'=>array("class"=>"align-right"),
				),
				array(
						'name'=>'length',
						'value'=>'$data->showVolume($data->length)',
					'htmlOptions'=>array("class"=>"align-right"),
					'headerHtmlOptions'=>array("class"=>"align-right"),
				),
				array(
						'name'=>'weight',
						'value'=>'$data->showWeight($data->weight)',
					'htmlOptions'=>array("class"=>"align-right"),
					'headerHtmlOptions'=>array("class"=>"align-right"),
				),
				array(
						'name'=>'profit_rate',
						'value'=>'$data->profit_rate',
						'htmlOptions'=>array("style"=>"text-align:right"),
				),				
				array(
						'name'=>'dealer_cost',
						'value'=>'$data->showPrice($data->dealer_cost)',
					'htmlOptions'=>array("class"=>"align-right"),
					'headerHtmlOptions'=>array("class"=>"align-right"),
				),
				array(
						'name'=>'msrp',
						'value'=>'$data->showPrice($data->msrp)',
					'htmlOptions'=>array("class"=>"align-right"),
					'headerHtmlOptions'=>array("class"=>"align-right"),
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
							return '<div class="buttonsTableProd"><a href="'.Yii::app()->createUrl("product/update",array('id'=>$data->Id)).'" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar</a>
									<button type="button" onclick="removeProduct('.$data->Id.', '.$grid.');" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button></div>';
						},
						'type'=>'raw',
						'htmlOptions'=>array("style"=>"text-align:right;"),
						'headerHtmlOptions'=>array("style"=>"text-align:right;"),
				),
			),
		));		
		?>