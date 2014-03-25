<div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Agregar Productos</h4>
      </div>
      <div class="modal-body">
       <ul class="nav nav-tabs">
        <li class="active"><a href="#tabTodos" data-toggle="tab">Todos</a></li>        
      </ul>
      <div class="tab-content">
  <div class="tab-pane active" id="tabTodos">
  <?php		
  $modelProducts->product_group_id_parent = $model->Id;
	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'product-grid-add',
		'dataProvider'=>$modelProducts->search(),
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
							$group = ProductGroup::model()->findByPk(array('Id_product_parent'=>$data->product_group_id_parent,'Id_product_child'=>$data->Id));		
							if(isset($group))
							{
								return '<span class="label label-success pull"><i class="fa fa-check fa-fw"></i> Agregado</span>';								
							}
							else 
							{				
								return '<button onclick="addProductChild('.$data->Id.',this)" type="button" class="btn btn-default btn-sm"><i class="fa fa-save"></i> Agregar</button>';
							}						
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
<script type="text/javascript">
function addProductChild(id,object)
{
	$.post("<?php echo ProductController::createUrl('AjaxAddChild'); ?>",
			{
			idProductParent:<?php echo $model->Id?>,
			idProductChild:id
			}
		).success(
			function(data){
				if(data=="1")
					{
						$.fn.yiiGridView.update("product-grid-group");
						$(object).parent().html('<span class="label label-success pull-center"><i class="fa fa-check fa-fw"></i> Agregado</span>');
					}
			});

}
	$('#myModalAddProduct').on('hidden.bs.modal', function () 
	{
	  	//$.fn.yiiGridView.update("product-grid-group"); 
	});
</script>
</div><!-- /.modal-dialog -->