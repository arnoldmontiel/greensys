<a onclick="openExcelLoader();" class="btn btn-primary superBoton" data-toggle="modal" ><i class="fa fa-upload"></i>  Cargar Nuevo Excel</a>
<?php 
$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'product-grid_brand',
		'dataProvider'=>$modelProductImportLogs->search(),
		'selectableRows' => 0,
		'filter'=>$modelProductImportLogs,
		'summaryText'=>'',	
		'itemsCssClass' => 'table table-striped table-bordered tablaIndividual',
		'columns'=>array(	
				array(
		 			'name'=>'brand_description',
					'value'=>'$data->brand->description',
				),
				array(
						'header'=>'Productos',
						'value'=>function($data){
							$uncompleteProducts = $data->getUncompleteProducts();
							$value = $data->getCompleteProducts();
							if($uncompleteProducts > 0)
								$value .= "<span class='text-danger'> (".$uncompleteProducts .")</span>";
								
							return $value;
						},
						'type'=>'html',
					'htmlOptions'=>array("class"=>"align-right"),
					'headerHtmlOptions'=>array("class"=>"align-right"),
				),
				'last_import_date',
				array(
						'header'=>'Estado',
						'value'=>function($data){
							$uncompleteProducts = $data->getUncompleteProducts();
							$value = "<span class='label label-success'>Procesado</span>";
							if($uncompleteProducts > 0)
								$value = "<span class='label label-danger'>Datos Incompletos</span>";
							
							return $value;
						},
						'type'=>'html',
				),
				array(
						'header'=>'Acciones',
						'value'=>function($data){
							return "<button type='button' onclick='downloadExcel(".$data->Id.");' class='btn btn-default btn-sm'><i class='fa fa-download'></i> Descargar Excel</button>	<button type='button' onclick='updateExcel(".$data->Id_brand.");' class='btn btn-default btn-sm'><i class='fa fa-upload'></i> Cargar Actualizaci&oacute;n</button>";
						},
						'type'=>'raw',
						'htmlOptions'=>array("style"=>"text-align:right;"),
						'headerHtmlOptions'=>array("style"=>"text-align:right;"),
				),
			),
		));	
?>