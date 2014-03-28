<div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Agregar Productos</h4>
      </div>
      <div class="modal-body">
  <?php		
	$dataProvider = $modelProducts->search();
	$dataProvider->pagination=array(
	'route'=>'budget/AjaxUpdateSelectProductGrid'
	);
	$dataProvider->sort=array(
		'route'=>'budget/AjaxUpdateSelectProductGrid'
	);
	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'product-grid-add',
		'dataProvider'=>$dataProvider,
		'selectableRows' => 0,
		'filter'=>$modelProducts,
		'ajaxUrl'=>BudgetController::createUrl('AjaxUpdateSelectProductGrid'),			
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
							$value = 1;						
							return '<div class="groupAgregar"><input onkeyup="validateNumber(this);" type="text" id="qty-field-'.$data->Id.'" class="form-control inputSmall align-right" value="'.round($value).'"><button id="btn-qty-field-'.$data->Id.'" onclick="addQty('.$data->Id.',this)" type="button" class="btn btn-default btn-sm"><i class="fa fa-save"></i> Agregar</button> <span class="checkAgregado" id="chk-add-'.$data->Id.'"><i class="fa fa-check"></i> Agregado</span></div>';						
						},
						'type'=>'raw',
						'htmlOptions'=>array("style"=>"text-align:center;"),
						'headerHtmlOptions'=>array("style"=>"text-align:center;"),
				),
// 				array(
// 						'header'=>'Agregados',
// 						'value'=>function($data){
// 							$value = "<span class='label label-default'>0</span>";
// 							if($data->qty_per_prod > 0 )
// 								$value = '<span class="label label-success">'.round($data->qty_per_prod).'</span>';
// 							return $value;
// 						},
// 						'type'=>'raw',
// 						'htmlOptions'=>array("style"=>"text-align:center;"),
// 						'headerHtmlOptions'=>array("style"=>"text-align:center;"),
// 				),
			),
		));		
?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary btn-lg" data-dismiss="modal"><i class="fa fa-check"></i> Cerrar</button>
      </div>
    </div><!-- /.modal-content -->
<script type="text/javascript">

	$('#myModalAddProduct').on('hidden.bs.modal', function () 
	{
		var idAreaProject = $('#idTabAreaProject').val();
		var idArea = $('#idTabArea').val();
	  	$.fn.yiiGridView.update("budget-item-grid_"+idAreaProject+"_"+idArea); 
// 	  	updateGridExtras(); 
// 	  	setTotals();	
	});
</script>
</div><!-- /.modal-dialog -->