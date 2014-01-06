<?php 
$settings = new Settings();
?>

   <div class="row contenedorPresu">
    <div class="col-sm-12">
      <div class="tituloFinalPresu">Productos</div>
    
      <ul class="nav nav-tabs navTabsPencil">
        <?php 
        $first = true;
        $idArea = null;
        $idAreaProject = null;
        foreach($areaProjects as $item)	{ ?>
        <li class="<?php echo ($first?'active':'');?>"><a onclick="changeTab(<?php echo $item->Id_area;?>,<?php echo $item->Id;?>)" href="#itemArea_<?php echo $item->Id.'_'.$item->Id_area;?>" data-toggle="tab"><span id="areaProjectDescription_<?php echo $item->Id?>"><?php echo ($item->description==""?$item->area->description:$item->description);?></span> </a><a onclick="editAreaProject(<?php echo $item->Id;?>);" class="tabEdit"><i class="fa fa-pencil"></i></a></li>
		<?php if($first)
	        {
	        	$idArea = $item->Id_area;
	        	$idAreaProject = $item->Id;
	        	$first= false;
	        }
		}
		echo CHtml::hiddenField("idTabArea",$idArea, array('id'=>'idTabArea'));
		echo CHtml::hiddenField("idTabAreaProject",$idAreaProject, array('id'=>'idTabAreaProject'));
		?>
      
        <li class="pull-right">
        <button <?php echo !isset($idArea)?'disabled="disabled"':'';?> onclick="addProduct(<?php echo $model->Id .', '. $model->version_number;?>);" type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModalAgregarProductos"><i class="fa fa-plus"></i> Agregar Productos</button>
          <div class="btn-group btnAlternateView">
  <button type="button" class="btn btn-default active">Áreas</button>
  <button type="button" class="btn btn-default">Servicios</button>
</div>
        </li>
       <li id="addAreaToProject" class="liButtonAdd"><button type="button" class="btn btn-primary btn-sm" data-toggle="modal" ><i class="fa fa-plus"></i> Agregar Area</button></li>
      </ul>
      <div class="tab-content">
        <?php
        $first = true;
        foreach($areaProjects as $item)	{ ?>
        <div class="tab-pane <?php echo $first?'active':'';?>" id="itemArea_<?php echo $item->Id.'_'.$item->Id_area;?>">
        <?php 
	        
        	if($first)
        		$first = false;
	        $modelBudgetItem->Id_area = $item->Id_area;
	        $modelBudgetItem->Id_area_project = $item->Id;
	        
	        echo $this->renderPartial('_tabEditBudgetByArea',array(
						'model'=>$model,
						'modelProduct'=>$modelProduct,
						'modelBudgetItem'=>$modelBudgetItem,
						'priceListItemSale'=>$priceListItemSale,
						'areaProject'=>$item,
						'modelBudgetItemGeneric'=>$modelBudgetItemGeneric,
			));
		?>

   </div>
  		<?php } ?>   
   </div>
    </div>
    </div>
    <?php echo $this->renderPartial('_tabEditBudgetExtras',array(
						'model'=>$model,
						'modelProduct'=>$modelProduct,
						'modelBudgetItem'=>$modelBudgetItem,
						'priceListItemSale'=>$priceListItemSale,
						'modelBudgetItemGeneric'=>$modelBudgetItemGeneric,));
    ?>
    
  <div class="row navbar-fixed-bottom">
    <div class="col-sm-12">
      <div id="statusSaving" class="statusFloatSaving" style="display:none">
        <i class="fa fa-spinner fa-spin fa-fw"></i> Guardando
      </div>
      <div id="statusSaved" class="statusFloatSaved" style="display:none">
        <i class="fa fa-check fa-fw"></i> Guardado
        </div>
    </div>
    <!-- /.col-sm-12 --> 
  </div>
  <!-- /.row --> 
  
  
  <div class="modal fade in" id="myModalEditarDesc" aria-hidden="false">
  <div class="modal-dialog">
  <div class="modal-content">
  <div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h4 class="modal-title">Editar Descripci&oacute;n de Servicio</h4>
      </div>
      <div class="modal-body">

<form role="form">
  <div class="form-group">
    <label for="campoDealerCost">Home Theater</label>
        <textarea class="form-control"  rows="6" id="Product_output_terminals">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed aliquet placerat volutpat. Vestibulum aliquet orci sed arcu imperdiet convallis. Vivamus iaculis et leo cursus ornare. Nullam tristique adipiscing volutpat. Nulla in purus eget felis aliquam vulputate. Nunc vitae egestas diam. 
 </textarea>
  </div>
</form>
</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary btn-lg"><i class="fa fa-save"></i> Guardar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>

<script type="text/javascript">
function editAreaProject(idAreaProject)
{
	$.post(
			'<?php echo BudgetController::createUrl('area/AjaxShowUpdateModalAreaProject')?>',
			 {
			 	id: idAreaProject,
			 	field_caller:'areaProjectDescription_'+idAreaProject
			 },'json').success(
				function(data) 
				{ 
					if(data!='')
					{
						$('#modalPlaceHolder').html(data);
						$('#modalPlaceHolder').modal('show');					
					}
				}
			).error(function(){});			
}
    
function updateGridExtras()
{
	$.fn.yiiGridView.update('budget-item-generic');	
}
    
    function statusStartSaving()
        {
        	$("#statusSaved").hide();
        	$("#statusSaving").fadeIn();				        	
		}
        function statusSaved()
        {
			$("#statusSaving").fadeOut(function(){$("#statusSaved").fadeIn();});							
        }
		function statusSavedError()
		{
			$("#statusSaving").fadeOut();				
		}
function setTotals()
{
	$.post(
		'<?php echo BudgetController::createUrl('AjaxGetTotals');?>',
		 {
		 	Id: <?php echo $model->Id;?>,
			version_number:<?php echo $model->version_number;?>,
		 },'json').success(
			function(data) 
			{ 
				if(data!='')
				{
					var response = jQuery.parseJSON(data);							
					$('#totals_price_w_discount').html(response.total_price_with_discount);					
					$('#totals_discount').html(response.total_discount);
					$('#totals_total_price').html(response.total_price);
				}
			}
		);		
}

$('#totals_percent_discount').keyup(function(){
	validateNumberInteger($('#totals_percent_discount'));
	if($('#totals_percent_discount').val()>100)	$('#totals_percent_discount').val(100);
});							
$('#totals_percent_discount').change(
	function(){
		statusStartSaving();
		$.post(
			'<?php echo BudgetController::createUrl('AjaxUpdatePercentDiscount')?>',
			 {
			 	Id: <?php echo $model->Id?>,
				version_number:<?php echo $model->version_number?>,
				percent_discount: $(this).val(),
			 },'json').success(
				 	function(data) 
				 		{ 
						statusSaved();
				 		if(data!='')
							{
								var response = jQuery.parseJSON(data);							
								$('#totals_price_w_discount').html(response.total_price_with_discount);					
								$('#totals_discount').html(response.total_discount);
								$('#totals_total_price').html(response.total_price);
							}
						}).error(function(){statusSavedError();});
	
	}
	);
    
function changeService(id, object)
	{
	statusStartSaving();
	$.post(
			"<?php echo BudgetController::createUrl('AjaxSaveService')?>",
			{
				Id_budget_item: id,Id_service:$(object).val()
			}
			).success(function(data)					
			{
				statusSaved();
			}).error(function(data)
			{
				statusSavedError();
			},"json");	
}

function changeDiscount(id, object)
{
	statusStartSaving();	
	validateNumber(object);
	$.post(
			"<?php echo BudgetController::createUrl('AjaxSaveDiscountValue')?>",
			{
				Id_budget_item: id,discount:$(object).val()
			}
			).success(function(data)
			{
				statusSaved();
				var response = jQuery.parseJSON(data);
				$("#total_price_"+id).html(response.total_price+" <div class=\"usd\"><?php echo $settings->getEscapedCurrencyShortDescription()?></div>");
				$(object).val(response.discount);
				setTotals();
		}).error(function(data)
			{
			statusSavedError();				
		},"json");	
}
function changeQuantity(id, object)
{
	statusStartSaving();	
	validateNumber(object);
	$.post(
			"<?php echo BudgetController::createUrl('AjaxSaveQuantity')?>",
			{
				Id_budget_item: id,quantity:$(object).val()
			}
			).success(function(data)
			{
				statusSaved();
				var response = jQuery.parseJSON(data);
				$("#total_price_"+id).html(response.total_price+" <div class=\"usd\"><?php echo $settings->getEscapedCurrencyShortDescription()?></div>");
				$(object).val(response.quantity);
				setTotals();
				updateGridExtras();
				//alert("success");				
		}).error(function(data)
			{
			statusSavedError();				
		},"json");	
}

function changeDiscountType(id, object)
{
	statusStartSaving();	
	$.post(
			"<?php echo BudgetController::createUrl('AjaxSaveDiscountType')?>",
			{
				Id_budget_item: id,discount_type:$(object).val()
			}
			).success(function(data)
			{
				statusSaved();
				var response = jQuery.parseJSON(data);
				$("#total_price_"+id).html(response.total_price+" <div class=\"usd\"><?php echo $settings->getEscapedCurrencyShortDescription()?></div>");
				setTotals();
		}).error(function(data)
			{
			statusSavedError();				
		},"json");	
}
function deleteBudgetItem(id,idAreaProject,idArea)
{
	if(confirm("¿Esta seguro que desea eliminar este item?"))
	{
		statusStartSaving();
			$.post(
				'<?php echo BudgetController::createUrl('AjaxDeleteBudgetItem')?>',
				 {
				 	id: id,
				 },'json').success(						 
					function(data) 
					{
						 statusSaved();
						 $.fn.yiiGridView.update('budget-item-grid_'+idAreaProject+"_"+idArea);
						 updateGridExtras(); 
					}
				).error(function(){statusSavedError();});		
	}	
 	return false;
}

function fillAndOpenDD(id)
{
	$(".precioTabla").removeClass("open");
	$.post(
			'<?php echo BudgetController::createUrl('ajaxFillDDPriceSelector')?>',
			 {
			 	Id: id,
			 },'json').success(
				function(data) 
				{ 
					if(data!='')
					{
						$("#btn_price_"+id).parent().addClass("open");
						$("#ul_price_"+id).html(data);
					}
				}
			).error(function(){});		
	
 	return false;
}
$("#addAreaToProject").click(function()
{	
	$.post(
			'<?php echo BudgetController::createUrl('ajaxFillAddAreaToProject')?>',
			 {
			 	Id_project: <?php echo $model->Id_project?>,
			 },'json').success(
				function(data) 
				{ 
					if(data!='')
					{
						$('#modalPlaceHolder').html(data);
						$('#modalPlaceHolder').modal('show');					
					}
				}
			).error(function(){});		
})
<!--

//-->
</script>

<div id="myModalAddArea" class="modal fade in" aria-hidden="false"><!--MODAL PEQUE-->
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h4 class="modal-title">Agregar Area</h4>
      </div>
      <div class="modal-body">

<form role="form">
  <div class="form-group">
  	    <label for="area">Area</label>    	
<select  class="form-control"name="area">
<option value="1">Dormitorio Principal</option>
<option value="2">Cocina</option>
<option value="3">Living</option>
</select>  </div>
</form>
</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Cancelar</button>
        <button type="button" id="btn-save-field" onclick="updateField(1066);" class="btn btn-primary btn-lg"><i class="fa fa-plus"></i> Agregar</button>
      </div>
    </div><!-- /.modal-content -->

</div><!-- /.modal-dialog -->

<!--END MODAL PEQUE-->

</div>
