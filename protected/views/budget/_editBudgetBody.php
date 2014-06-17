
<script>	

$(document).ready(function() {
	  $('#toggleArea.toggle-menu').jPushMenu({
			closeOnClickOutside:false,
			menu: '#pushArea'});
		$( "#pushArea .pushMenuSuperGroup a" ).click(function() {
			 //$(this).addClass('pushMenuActive').siblings().removeClass('pushMenuActive');
			  //Para marcar mas de uno:
			  $( this ).toggleClass( "pushMenuActive" );
			  var selector = $(this).attr("data-filter");

			  //Desmarco todo el menu comun
			  $("#filtroArea li").removeClass('active');
			  //Marco el item correspondiente en menu comun
			  $("#filtroArea li a[data-filter='" + selector + "']").parent('li').addClass('active');
			  //Cerrar menu			
			 // $('.jPushMenuBtn,body,.cbp-spmenu').removeClass('disabled active cbp-spmenu-open cbp-spmenu-push-toleft cbp-spmenu-push-toright');
			  //$(".modal-backdrop").remove();
			   
			  return false;
			  		});

		$('#jstree').jstree({"plugins" : [
		                                  "contextmenu", "dnd", "search",
		                                  "state", "types", "wholerow"
		                                ]
		                              });
		$('#jstree').jstree('open_all');
		});
		
</script>
<nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-right" id="pushArea">
		<div class="cbp-title">Elegir Area </div>
		<div class="sideMenuBotones"> 
		<button onclick="editAreaProject();" class="btn btn-default isdisable disabled"><i class="fa fa-pencil"></i> Editar </button>
		<button onclick="deleteAreaProject();" class="btn btn-default isdisable disabled"><i class="fa fa-trash-o"></i> Borrar </button>
		<button id="addAreaToProject" class="btn btn-primary"><i class="fa fa-plus"></i> Agregar</button>
		</div>
		<a class="toggle-menuMarketplace close-menu"><i class="fa fa-times-circle"></i></a>
		
				<div id="jstree" class="treeMenu">
  <ul>
  	<li data-jstree='{"icon":"images/areaIcon/area.ico"}' >
  		<a onclick="changeTree(0,0)">
        	<span id="areaProjectDescription_0">
        		<?php echo $model->project->description;?>
        	</span>        		        		
        </a>  	
      <ul>
  	<?php 
  	$first = true;
  	$idArea = 0;
  	$idAreaProject = 0;  	 
  	$areaDescription="";
  foreach($areaProjects as $item)	{ ?>
        <li data-jstree='{"icon":"images/areaIcon/entry.ico"}'>
        	<a onclick="changeTree(<?php echo $item->Id_area;?>,<?php echo $item->Id;?>)">
        		<span id="areaProjectDescription_<?php echo $item->Id?>">
        			<?php echo ($item->description==""?$item->area->description:$item->description);?>&nbsp;(<?php echo $item->getProductQty($model->Id, $model->version_number);?>)
        		</span>        		        		
        	</a>
        	<?php $childAreaProjects = AreaProject::model()->findAllByAttributes(array('Id_parent'=>$item->Id));?>
        	<?php if(!empty($childAreaProjects)):?>
        	<ul>
        		<?php foreach ($childAreaProjects as $child){?>
		        <li data-jstree='{"icon":"images/areaIcon/entry.ico"}'>
		        	<a onclick="changeTree(<?php echo $child->Id_area;?>,<?php echo $child->Id;?>)">
		        		<span id="areaProjectDescription_<?php echo $child->Id?>">
		        			<?php echo ($child->description==""?$child->area->description:$child->description);?>&nbsp;(<?php echo $child->getProductQty($model->Id, $model->version_number);?>)
		        		</span>        		        		
		        	</a>
        	        	<?php $childAreaProjects2 = AreaProject::model()->findAllByAttributes(array('Id_parent'=>$child->Id));?>
			        	<?php if(!empty($childAreaProjects2)):?>
			        	<ul>
			        	<?php foreach ($childAreaProjects2 as $child2){?>
					        <li data-jstree='{"icon":"images/areaIcon/entry.ico"}'>
					        	<a onclick="changeTree(<?php echo $child2->Id_area;?>,<?php echo $child2->Id;?>)">
					        		<span id="areaProjectDescription_<?php echo $child2->Id?>">
					        			<?php echo ($child2->description==""?$child2->area->description:$child2->description);?>&nbsp;(<?php echo $child2->getProductQty($model->Id, $model->version_number);?>)
					        		</span>        		        		
					        	</a>
					        	
									<?php $childAreaProjects3 = AreaProject::model()->findAllByAttributes(array('Id_parent'=>$child2->Id));?>
						        	<?php if(!empty($childAreaProjects3)):?>
						        	<ul>
						        	<?php foreach ($childAreaProjects3 as $child3){?>
								        <li data-jstree='{"icon":"images/areaIcon/entry.ico"}'>
								        	<a onclick="changeTree(<?php echo $child3->Id_area;?>,<?php echo $child3->Id;?>)">
								        		<span id="areaProjectDescription_<?php echo $child3->Id?>">
								        			<?php echo ($child3->description==""?$child3->area->description:$child3->description);?>&nbsp;(<?php echo $child3->getProductQty($model->Id, $model->version_number);?>)
								        		</span>        		        		
								        	</a>
								        </li>
						        		<?php }?>
								    </ul>
						        	<?php endif?>
					        	
					        	
					        </li>
			        		<?php }?>
					    </ul>
			        	<?php endif?>
		        </li>
        		<?php }?>
		    </ul>
        	<?php endif?>        	      
        </li>
        <?php 
        if($first&&false)
	        {
	        	$idArea = $item->Id_area;
	        	$idAreaProject = $item->Id;
	        	$areaDescription = $item->description==""?$item->area->description:$item->description;
	        	$first= false;
	        }
		}		
		?>
      </ul>
  </ul> 		
</div>
</nav>

<?php 
	$settings = new Settings();
	echo CHtml::hiddenField("idTabArea",$idArea, array('id'=>'idTabArea'));
	echo CHtml::hiddenField("idTabAreaProject",$idAreaProject, array('id'=>'idTabAreaProject'));
?>
    <?php
    echo $this->renderPartial('_tabBudgetServiceConfig',array(
						'model'=>$model,));
    ?>
	<section id="PRODUCTS"></section>        
	<div class="row contenedorPresu">
    <div class="col-sm-12">
    
      <div class="tituloFinalPresu">Equipos por &Aacute;rea</div>
    <ul class="nav nav-tabs">
    <li><div id="titleAreaProject" class="tituloAreaPresu"><?php echo $areaDescription;?></div></li>
     
     <li class="buttonsAreaPresu">
     <button  id="addProduct" <?php echo ($idArea==0)?'disabled="disabled"':'';?> onclick="addProduct(<?php echo $model->Id .', '. $model->version_number;?>);" type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModalAgregarProductos"><i class="fa fa-plus"></i> Agregar Productos</button>
     </li>
     <li class="pull-right">
     <button class="toggle-menu menu-right btn btn-primary btnArea jPushMenuBtn menu-active" id="toggleArea"><i class="fa fa-cutlery"></i> Menu &Aacute;reas </button>
          <div class="btn-group btnAlternateView">
		  <button onclick="editBudget(<?php echo $model->Id?>,<?php echo $model->version_number?>)" type="button" class="btn btn-default active">&Aacute;reas</button>
		  <button onclick="editBudgetByService(<?php echo $model->Id?>,<?php echo $model->version_number?>)" type="button" class="btn btn-default">Servicios</button>
          </div>
        </li>
       <li id="addAreaToProject" class="liButtonAdd hidden"><button type="button" class="btn btn-primary btn-sm" data-toggle="modal" ><i class="fa fa-plus"></i> Agregar &Aacute;rea</button></li>
    </ul>
    
      
    <?php if(false):?>
      <ul class="nav nav-tabs navTabsPencil hidden">      
        <li class="pull-right">
        <button <?php echo ($idArea==0)?'disabled="disabled"':'';?> onclick="addProduct(<?php echo $model->Id .', '. $model->version_number;?>);" type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModalAgregarProductos"><i class="fa fa-plus"></i> Agregar Productos</button>
          <div class="btn-group btnAlternateView">
		  <button onclick="editBudget(<?php echo $model->Id?>,<?php echo $model->version_number?>)" type="button" class="btn btn-default active">&Aacute;reas</button>
		  <button onclick="editBudgetByService(<?php echo $model->Id?>,<?php echo $model->version_number?>)" type="button" class="btn btn-default">Servicios</button>
          </div>
        </li>
       <li id="addAreaToProject" class="liButtonAdd hidden"><button type="button" class="btn btn-primary btn-sm" data-toggle="modal" ><i class="fa fa-plus"></i> Agregar &Aacute;rea</button></li>
      </ul>
      <?php endif?>
      <div class="tab-content areas">
      <?php if(($idArea==0)):?>
       <div class="alert alert-warning fade in" id="warningEmpty">
        Para poder agregar productos, primero debes <span class="bold">agregar/seleccionar &aacute;reas</span> desde el <span class="bold">Menu &Aacute;reas</span>.
      </div>
      <?php endif;?>
        <?php
        foreach($allAreaProjects as $item)	{ ?>
        <div class="tab-pane" id="itemArea_<?php echo $item->Id.'_'.$item->Id_area;?>">
        <?php 
	        
	        $modelBudgetItem->Id_area = $item->Id_area;
	        $modelBudgetItem->Id_area_project = $item->Id;
	        echo $this->renderPartial('_tabEditBudgetByArea',array(
						'modelBudgetItem'=>$modelBudgetItem,
						'areaProject'=>$item,
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
function downService(idService, idProject, grid)
{
	statusStartSaving();
	
	$.post(
		'<?php echo BudgetController::createUrl('AjaxDownServiceItem')?>',
		 {
			idService: idService,
		 	idProject: idProject
		 },'json').success(
			function(data)				 
			{ 
				statusSaved();
				$.fn.yiiGridView.update(grid);											
			}
		).error(function(){statusSavedError();});
}

function downServiceToBottom(idService, idProject, grid)
{
	statusStartSaving();
	
	$.post(
		'<?php echo BudgetController::createUrl('AjaxDownToBottomService')?>',
		 {
			idService: idService,
		 	idProject: idProject
		 },'json').success(
			function(data)				 
			{ 
				statusSaved();
				$.fn.yiiGridView.update(grid);											
			}
		).error(function(){statusSavedError();});
}

function upService(idService, idProject, grid)
{
	statusStartSaving();
	
	$.post(
		'<?php echo BudgetController::createUrl('AjaxUpServiceItem')?>',
		 {
			idService: idService,
		 	idProject: idProject
		 },'json').success(
			function(data)				 
			{ 
				statusSaved();
				$.fn.yiiGridView.update(grid);											
			}
		).error(function(){statusSavedError();});
}

function upServiceToAbove(idService, idProject, grid)
{
	statusStartSaving();
	
	$.post(
		'<?php echo BudgetController::createUrl('AjaxUpToAboveService')?>',
		 {
			idService: idService,
		 	idProject: idProject
		 },'json').success(
			function(data)				 
			{ 
				statusSaved();
				$.fn.yiiGridView.update(grid);											
			}
		).error(function(){statusSavedError();});
}
function deleteAreaProject()
{
	idAreaProject = $("#idTabAreaProject").val();
	if(confirm("¿Esta seguro que desea eliminar el Area?"))
	{
		$.post(
				'<?php echo BudgetController::createUrl('AjaxDeleteAreaProject')?>',
				 {
				 	id: idAreaProject,
				 },'json').success(
					function(data) 
					{
						if(data=="1")
						{
							//if($('#areaProjectDescription_'+idAreaProject).parent().parent().parent().hasClass("jstree-children"))
							//	$('#areaProjectDescription_'+idAreaProject).parent().parent().parent().remove();
							//$('#jstree').jstree('delete_node', $('#areaProjectDescription_'+idAreaProject).parent().parent());
							//$('#areaProjectDescription_'+idAreaProject).parent().parent().remove();							
							changeTree(0,0);

// 							var ref = $('#jstree').jstree(true),
// 							sel = ref.get_selected();
// 							if(!sel.length) { return false; }
// 							ref.delete_node(sel);
							location.reload();
						}
						else
						{
							alert("Debe estar vacia para ser eliminada")
						}						 
					}
				).error(function(){});			
		}		
}
function editAreaProject()
{
	idAreaProject = $("#idTabAreaProject").val();		
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
					updateGridExtras();
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
	$.post(
			"<?php echo BudgetController::createUrl('AjaxSaveDiscountValue')?>",
			{
				Id_budget_item: id,discount:$(object).val()
			}
			).success(function(data)
			{
				statusSaved();
				var response = jQuery.parseJSON(data);
				$("#total_price_"+id).html("<div class=\"usd\"><?php echo $settings->getEscapedCurrencyShortDescription()?></div> "+response.total_price);				
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
				$("#total_price_"+id).html("<div class=\"usd\"><?php echo $settings->getEscapedCurrencyShortDescription()?></div> "+response.total_price);
				setTotals();
		}).error(function(data)
			{
			statusSavedError();				
		},"json");	
}
function deleteBudgetItem(id,idAreaProject,idArea)
{
	if(confirm("¿Esta seguro que desea eliminar este I­tem?"))
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
	idAreaProject = $("#idTabAreaProject").val();
	
	$.post(
			'<?php echo BudgetController::createUrl('ajaxFillAddAreaToProject')?>',
			 {
			 	Id_project: <?php echo $model->Id_project?>,Id_area_project: idAreaProject
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
