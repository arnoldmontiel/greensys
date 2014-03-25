<script type="text/javascript">

function setAccessory(idProduct, obj)
{
	var value = 0;
	if($(obj).is(':checked'))
		value = 1;
	
	statusStartSaving();
	$.post("<?php echo BudgetController::createUrl('AjaxSetAccessoryProduct'); ?>",
			{
				idProduct:idProduct,
				value:value				
			}
		).success(
			function(data){
				statusSaved();
			}).error(function(){statusSavedError();});
		return false;
}

function downloadPDF(id, version)
{
	var params = "&id="+id+"&version="+version;
	window.open("<?php echo BudgetController::createUrl('DownloadPDF'); ?>" + params, "_blank");
	return false;	
}

function changeCurrencyView(obj, id, version)
{
	statusStartSaving();	
	$.post("<?php echo BudgetController::createUrl('AjaxChangeCurrencyView'); ?>",
			{
				id:id,
				version:version,
				idCurrencyView:obj.value				
			}
		).success(
			function(data){
				statusSaved();
			}).error(function(){statusSavedError();});
		return false;
}

function closeVersion(id, version)
{
	if (confirm('¿Desea cerrar esta versión y enviarla a "Esperando Respuesta"?')) 
	{
		$.post("<?php echo BudgetController::createUrl('AjaxCloseVersion'); ?>",
			{
				id:id,
				version:version
			}
		).success(
			function(data){
				window.location = "<?php echo BudgetController::createUrl("index")?>";
				return false;
			});
		return false;
	}
	return false;	
}

function openUpdateBudget(idBudget, version)
{
	$.post("<?php echo BudgetController::createUrl('AjaxOpenUpdateBudget'); ?>",
			{
				idBudget:idBudget,
				version:version
			}
		).success(
			function(data){
				$('#myModalFormBudget').html(data);
		   		$('#myModalFormBudget').modal('show');	  
			});
		return false;
}

function changeTabByService(idService, serviceDesc)
{
	$.fn.yiiGridView.update('budget-item-grid_' + idService);
	$.fn.yiiGridView.update('budget-item-additional-grid_' + idService);
	$("#additional-toggle").attr("href", "#additional_" + idService);
	$("#additional-toggle").click();
	$("#additional-description").text(serviceDesc);
	$('#idTabService').val(idService);
	return true;	
}
function changeTab(idArea,idAreaProject)
{
	$('#idTabArea').val(idArea);
	$('#idTabAreaProject').val(idAreaProject);

	$.fn.yiiGridView.update('budget-item-grid_' + idAreaProject + '_' + idArea);
}
function changeTree(idArea,idAreaProject)
{
	if(idArea != 0 &&idAreaProject!=0)
	{
		$("#warningEmpty").addClass("hide");
		$(".sideMenuBotones .isdisable").removeClass("disabled");
		$(".areas .tab-pane").removeClass("active");
		$("#itemArea_"+idAreaProject+"_"+idArea).addClass("active");
		$('#idTabArea').val(idArea);
		$('#idTabAreaProject').val(idAreaProject);
		$('.tituloAreaPresu').html($('#areaProjectDescription_'+idAreaProject).html());
		$('#addProduct').removeAttr("disabled");
		//$.fn.yiiGridView.update('budget-item-grid_' + idAreaProject + '_' + idArea);
	}
	else
	{
		$("#warningEmpty").removeClass("hide");	
		$(".sideMenuBotones .isdisable").addClass("disabled");
		$(".areas .tab-pane").removeClass("active");
		$('#idTabArea').val(idArea);
		$('#idTabAreaProject').val(idAreaProject);
		$('.tituloAreaPresu').html("");
		$('#addProduct').attr("disabled","disabled");
		
	}
}

function addQty(idProduct)
{
	var qty = $("#qty-field-"+idProduct).val();
	var idAreaProject = $('#idTabAreaProject').val();
	var idArea = $('#idTabArea').val();
	var idBudget = $('#idBudget').val();
	var version = $('#version').val();
	$.post("<?php echo BudgetController::createUrl('AjaxAddProduct'); ?>",
			{
				idBudget:idBudget,
				version:version,
				idProduct:idProduct,
				idArea:idArea,
				idAreaProject:idAreaProject,
				qty: qty
			}
		).success(
			function(data){
				$.fn.yiiGridView.update('product-grid-add', {
					data: $(this).serialize() + '&idArea=' + $('#idTabArea').val()+'&idAreaProject=' + $('#idTabAreaProject').val()
				});			
				
				$('#total-qty').children().text(data); 
			});
		return false;
}

function addProduct(id,version)
{
	$.fn.yiiGridView.update('product-grid-add', {
		data: $(this).serialize() + '&idArea=' + $('#idTabArea').val()+'&idAreaProject=' + $('#idTabAreaProject').val()
	});
	
	$('#myModalAddProduct').append($('#container-modal-addProduct'));
	$('#container-modal-addProduct').show();

	var idArea = $('#idTabArea').val();
	var idAreaProject = $('#idTabAreaProject').val();
	var idBudget = $('#idBudget').val();
	var version = $('#version').val();
	
	$.post("<?php echo BudgetController::createUrl('AjaxGetTotalQty'); ?>",
			{
				idBudget:idBudget,
				version:version,
				idArea:idArea,
				idAreaProject:idAreaProject
			}
		).success(
			function(data){
				$('#total-qty').children().text(data);
			});
		
	$('#myModalAddProduct').modal('show');
	
	return false;
}

function editBudget(id,version)
{
	var params = "&id="+id+"&version="+version+"#PRODUCTS";;
	window.location = "<?php echo BudgetController::createUrl("addItem")?>" + params; 
	return false;
}
function editBudgetByService(id,version)
{
	var params = "&id="+id+"&version="+version+"&byService=true#PRODUCTS";
	window.location = "<?php echo BudgetController::createUrl("addItem")?>" + params; 
	return false;
}

function changeTimeProgramation(id, object,grid)
{
	statusStartSaving();	
	validateNumber(object);
	$.post(
			"<?php echo BudgetController::createUrl('AjaxSaveTimeProgramation')?>",
			{
				Id_budget_item: id,time_programation:$(object).val()
			}
			).success(function(data)
			{
				statusSaved();
				var response = jQuery.parseJSON(data);
				updateGridExtras();
				//alert("success");				
		}).error(function(data)
			{
			statusSavedError();				
		},"json");	
}
function changeTimeInstalation(id, object,grid)
{
	statusStartSaving();	
	validateNumber(object);
	$.post(
			"<?php echo BudgetController::createUrl('AjaxSaveTimeInstalation')?>",
			{
				Id_budget_item: id,time_instalation:$(object).val()
			}
			).success(function(data)
			{
				statusSaved();
				var response = jQuery.parseJSON(data);
				updateGridExtras();
				//alert("success");				
		}).error(function(data)
			{
			statusSavedError();				
		},"json");	
}
function removeBudgetItem(id)
{
	 if(confirm("¿Seguro desea eliminar este ítem?"))
	 {
		 
	 	$.post(
	 			'<?php echo BudgetController::createUrl('budget/AjaxRemoveBudgetItem')?>',
	 			 {
	 			 	id: id,
	 			 },'json').success(
	 				function(data) 
	 				{ 
						$.fn.yiiGridView.update('budget-item-additional-grid_'+$("#idTabService").val());		 		
	 				}
	 			).error(function(){});
	 }			
		 
}
function addExtraItem(idBudget,versionNumber)
{
	$.post(
			'<?php echo BudgetController::createUrl('budget/AjaxShowCreateModalBudgetItem')?>',
			 {
			 	id: idBudget,
			 	version_number: versionNumber,
			 	idService: $("#idTabService").val(),
	 			field_caller:'budget-item-additional-grid_'+$("#idTabService").val()
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
 
function editProjectService(idProject,idService)
{
	$.post(
			'<?php echo BudgetController::createUrl('project/AjaxShowUpdateModalProjectService')?>',
			 {
			 	Id_project: idProject,
			 	Id_service: idService,
			 	field_caller:'project-service-grid'
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

function editProjectServiceNote(idProject,idService)
{
	$.post(
			'<?php echo BudgetController::createUrl('project/AjaxShowUpdateModalProjectServiceNote')?>',
			 {
			 	Id_project: idProject,
			 	Id_service: idService,
			 	field_caller:'project-service-note-grid'
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

$("#tabServices").click(function()
{
	 $("#addExtraItem").hide();
});
$("#tabServicesNote").click(function()
{
	 $("#addExtraItem").hide();
});
$("#tabExtraItems").click(function()
{
	 $("#addExtraItem").show();
});
</script>
<div class="container" id="screenCrearPresupuesto">
  <div class"row">
  <div class="col-md-12">
   <h1 class="pageTitle">Presupuesto</h1>
  </div>
  </div>
  	<?php echo CHtml::hiddenField("idBudget",$model->Id,array("id"=>"idBudget"));?>
  	<?php echo CHtml::hiddenField("version",$model->version_number,array("id"=>"version"));?>
	<?php $this->renderPartial('_editBudgetHead',array('model'=>$model));?>
	<?php 
	if($byService)
	{
		$this->renderPartial('_editBudgetBodyByService',array(
					'model'=>$model,
					'modelProduct'=>$modelProduct,
					'modelBudgetItem'=>$modelBudgetItem,
					'priceListItemSale'=>$priceListItemSale,
					'areaProjects'=>$areaProjects,
					'modelBudgetItemGeneric'=>$modelBudgetItemGeneric,
		));
	}
	else 
	{
		$this->renderPartial('_editBudgetBody',array(
					'model'=>$model,
					'modelProduct'=>$modelProduct,
					'modelBudgetItem'=>$modelBudgetItem,
					'priceListItemSale'=>$priceListItemSale,
					'areaProjects'=>$areaProjects,
					'modelBudgetItemGeneric'=>$modelBudgetItemGeneric,
					'allAreaProjects'=>$allAreaProjects,
		));
	}
	?>
  
</div>

<div id="container-modal-addProduct" style="display: none">
<?php echo $this->renderPartial('_modalAddProduct', array( 'modelProducts'=>$modelProducts));?>
</div>
<!-- /container --> 