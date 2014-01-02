<div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Agregar Productos</h4>
      </div>
      <div class="modal-body">
       <ul class="nav nav-tabs">
        <li class="active"><a href="#tabTodos" data-toggle="tab">Todos</a></li>
        <li class="pull-right">Total Agregados <span class="label label-success">20</span></li>
      </ul>
      <div class="tab-content">
  <div class="tab-pane active" id="tabTodos">
  <?php		
	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'product-grid-add',
		'dataProvider'=>$modelProducts->searchByBudgetItem(),
		'selectableRows' => 0,
		'filter'=>$modelProducts,
		'summaryText'=>'',	
		'itemsCssClass' => 'table table-striped table-bordered tablaIndividual',
		'columns'=>array(	
				array(
					'name'=>'model',
					'value'=>'$data->model',
					'htmlOptions'=>array("style"=>"width:10%;"),
				),
				array(
					'name'=>'part_number',
					'value'=>'$data->part_number',
					'htmlOptions'=>array("style"=>"width:10%;"),
				),
				array(
					'name'=>'brand_description',
					'value'=>'$data->brand->description',
					'htmlOptions'=>array("style"=>"width:5%;"),
				),
				array(
					'name'=>'msrp',
					'value'=>'$data->msrp',
					'htmlOptions'=>array("style"=>"width:5%;"),
				),
				array(
					'name'=>'Id_category',
					'value'=>'$data->category->description',
					'htmlOptions'=>array("style"=>"width:15%;"),
				),
				array(
					'name'=>'short_description',
					'value'=>'GreenHelper::cutString($data->short_description,40)',
					'htmlOptions'=>array("style"=>"width:20%;"),
				),
				array(
						'header'=>'Acciones',
						'value'=>function($data){
						$grid = "'budget-grid-waiting'";
							return '<input onkeyup="validateNumber(this);" type="text" id="qty-field-'.$data->Id.'" class="form-control inputSmall" value="1"><button onclick="addQty('.$data->Id.')" type="button" class="btn btn-default btn-sm"><i class="fa fa-save"></i> Aplicar</button>';						
						},
						'type'=>'raw',
						'htmlOptions'=>array("style"=>"text-align:right;"),
				),
				array(
						'header'=>'Agregados',
						'value'=>function($data){
							return '<span class="label label-success">'.round($data->qty_per_prod).'</span>';
						},
						'type'=>'raw',
						'htmlOptions'=>array("style"=>"text-align:center;"),
				),
			),
		));		
?>

      </div>
  </div>      
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary btn-lg" data-dismiss="modal"><i class="fa fa-check"></i> Listo</button>
      </div>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->