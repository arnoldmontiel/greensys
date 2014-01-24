<?php 
$settings = new Settings();
?>
    <?php
    echo $this->renderPartial('_tabBudgetServiceConfig',array(
						'model'=>$model,
						'modelProduct'=>$modelProduct,
						'modelBudgetItem'=>$modelBudgetItem,
						'priceListItemSale'=>$priceListItemSale,
						'modelBudgetItemGeneric'=>$modelBudgetItemGeneric,));
    ?>
	<section id="PRODUCTS"></section>        
	<div class="row contenedorPresu">
    <div class="col-sm-12">
      <div class="tituloFinalPresu">Equipos por &Aacute;rea</div>
    
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
		  <button onclick="editBudget(<?php echo $model->Id?>,<?php echo $model->version_number?>)" type="button" class="btn btn-default active">Áreas</button>
		  <button onclick="editBudgetByService(<?php echo $model->Id?>,<?php echo $model->version_number?>)" type="button" class="btn btn-default">Servicios</button>
          </div>
        </li>
       <li id="addAreaToProject" class="liButtonAdd"><button type="button" class="btn btn-primary btn-sm" data-toggle="modal" ><i class="fa fa-plus"></i> Agregar Area</button></li>
      </ul>
      <div class="tab-content">
      <?php if(!isset($idArea)):?>
       <div class="alert alert-warning fade in" id="warningEmpty">
        Para poder agregar productos, primero debes <strong>agregar &aacute;reas</strong>.
      </div>
      <?php endif;?>
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
  
    <?php 
    echo $this->renderPartial('_tabEditBudgetTotals',array(
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
	$.fn.yiiGridView.update('totals-services-grid');
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
					$.fn.yiiGridView.update('totals-services-grid');
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
				updateGridExtras();
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
	var discountType = $('#discount_type_'+id).val();
	$.post(
			"<?php echo BudgetController::createUrl('AjaxSaveDiscountValue')?>",
			{
				Id_budget_item: id,discount:$(object).val(),discountType:discountType
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
	if(confirm("¿Esta seguro que desea eliminar este ítem?"))
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

</script>
