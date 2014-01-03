<div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Agregar Productos</h4>
      </div>
      <div class="modal-body">
       <ul class="nav nav-tabs">
        <li class="active"><a href="#tabTodos" data-toggle="tab">Todos</a></li>
        <li id="total-qty" class="pull-right">Total Agregados <span class="label label-success">20</span></li>
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
					'htmlOptions'=>array("width"=>"15%", "class"=>"align-right"),
					'headerHtmlOptions'=>array("class"=>"align-right"),
				),
				array(
					'name'=>'brand_description',
					'value'=>'$data->brand->description',
					'htmlOptions'=>array("style"=>"width:5%;"),
				),
				array(
					'name'=>'msrp',
					'value'=>'$data->msrp',
					'htmlOptions'=>array("width"=>"5%", "class"=>"align-right"),
					'headerHtmlOptions'=>array("class"=>"align-right"),
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
						$value = 1;
						if($data->qty_per_prod > 0)
							$value = $data->qty_per_prod;
							return '<input onkeyup="validateNumber(this);" type="text" id="qty-field-'.$data->Id.'" class="form-control inputSmall align-right" value="'.round($value).'"><button onclick="addQty('.$data->Id.')" type="button" class="btn btn-default btn-sm"><i class="fa fa-save"></i> Aplicar</button>';						
						},
						'type'=>'raw',
						'htmlOptions'=>array("style"=>"text-align:center;"),
						'headerHtmlOptions'=>array("style"=>"text-align:center;"),
				),
				array(
						'header'=>'Agregados',
						'value'=>function($data){
							$value = "<span class='label label-default'>0</span>";
							if($data->qty_per_prod > 0 )
								$value = '<span class="label label-success">'.round($data->qty_per_prod).'</span>';
							return $value;
						},
						'type'=>'raw',
						'htmlOptions'=>array("style"=>"text-align:center;"),
						'headerHtmlOptions'=>array("style"=>"text-align:center;"),
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