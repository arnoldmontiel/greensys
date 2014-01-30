
<script>$(function(){
    $('#hola').tooltip({
        placement: 'right'
    });
});</script>
<a href="<?php echo ProductController::createUrl('create'); ?>" class="btn btn-primary superBoton"><i class="fa fa-plus"></i>  Agregar Producto</a>

<a href="<?php echo ProductController::createUrl('uploadImages'); ?>" class="btn btn-primary superBoton2"><i class="fa fa-picture-o"></i>  Administrador de Im&aacute;genes</a>

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
						'header'=>'Imagen',
						'value'=>function($data){
						
						$criteria = new CDbCriteria();
						$criteria->join = "INNER JOIN product_multimedia pm on (pm.Id_multimedia = t.Id)";
						$criteria->addCondition('pm.Id_product = '. $data->Id);
						$modelMultimedia = Multimedia::model()->find($criteria);
						
						$value = '';
						if(isset($modelMultimedia))
							$value = '<div class="dropdown"><a class="dropdown-toggle dropdownEditImagen" data-toggle="dropdown" ><i class="fa fa-picture-o"></i>Mostrar</a>
									  <ul class="dropdown-menu ulEditImagen" role="menu">
									    <li class="align-center"><img  src="images/'.$modelMultimedia->file_name_small.'"/></li>
								    	<li class="align-center"><button onclick="removeImage('.$modelMultimedia->Id.', this)" type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button></li>
									  </ul>
													</div>';
							
						return $value;
							
						},
						'type'=>'raw',
						'htmlOptions'=>array("class"=>"align-center"),
						'headerHtmlOptions'=>array("class"=>"align-center"),
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
							return '<div class="buttonsTable buttonsTableProd"><a href="'.Yii::app()->createUrl("product/update",array('id'=>$data->Id)).'" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar</a>
									<button type="button" onclick="removeProduct('.$data->Id.', '.$grid.');" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button></div>';
						},
						'type'=>'raw',
						'htmlOptions'=>array("style"=>"text-align:right;"),
						'headerHtmlOptions'=>array("style"=>"text-align:right;"),
				),
			),
		));		
		?>