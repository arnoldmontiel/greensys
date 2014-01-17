<?php		
	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'product-grid-images',
		'dataProvider'=>$modelProducts->search(),
		'selectableRows' => 0,
		'filter'=>$modelProducts,
		'summaryText'=>'',	
		'itemsCssClass' => 'table table-striped table-bordered tablaIndividual tablaUploadImagenes',
		'columns'=>array(					
				array(
						'header'=>'Imagen',
						'value'=>function($data){
							$criteria = new CDbCriteria();
							$criteria->join = "INNER JOIN product_multimedia pm on (pm.Id_multimedia = t.Id)";
							$criteria->addCondition('pm.Id_product = '. $data->Id);
							$modelMultimedia = Multimedia::model()->find($criteria);
							
							$value = '';
							if(isset($modelMultimedia))
								$value = '<img  src="images/'.$modelMultimedia->file_name_small.'" />';
							
							return $value;
						},
						'type'=>'raw',
						'htmlOptions'=>array("class"=>"imageUploadCont"),
				),
				array(
						'name'=>'brand_description',
						'value'=>'$data->brand->description'
				),
				array(
						'header'=>'Producto',
						'name'=>'model',
						'value'=>function($data){
								
							return $data->model;
						},
						'type'=>'raw',
				),
				array(
						'header'=>'Acciones',
						'value'=>function($data){
							
							$criteria = new CDbCriteria();
							$criteria->join = "INNER JOIN product_multimedia pm on (pm.Id_multimedia = t.Id)";
							$criteria->addCondition('pm.Id_product = '. $data->Id);
							$modelMultimedia = Multimedia::model()->find($criteria);
								
							$value = '';
							if(isset($modelMultimedia))
								$value = '<button onclick="removeImage('.$modelMultimedia->Id.');" type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button>';
							
							return $value;
						},
						'type'=>'raw',
						'htmlOptions'=>array("class"=>"align-right file_upload_cancel"),
				),
			),
		));		
?>