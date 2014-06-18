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
 
function setHideItem(idBudgetItem, obj)
{
	var value = 0;
	if($(obj).is(':checked'))
		value = 1;
	
	statusStartSaving();
	$.post("<?php echo BudgetController::createUrl('AjaxSetHideItem'); ?>",
			{
				idBudgetItem:idBudgetItem,
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

function updateToDefaultClause(id, version)
{
	statusStartSaving();
	$.post("<?php echo BudgetController::createUrl('AjaxUpdateToDefaultClause'); ?>",
			{
				id:id,
				version:version
			}
		).success(
			function(data){
				statusSaved();
				$("#budget-clause-description").html(data);
			}).error(function(){statusSavedError();});
		return false;
}

function changePrintChk(obj, id, version)
{
	var value = 0;
	if($(obj).is(':checked'))
		value = 1;
	
	statusStartSaving();
	$.post("<?php echo BudgetController::createUrl('AjaxChangePrintChk'); ?>",
			{
				id:id,
				version:version,
				value:value				
			}
		).success(
			function(data){
				statusSaved();
			}).error(function(){statusSavedError();});
		return false;
}

function changePrintNoteChk(obj, id, version)
{
	var value = 0;
	if($(obj).is(':checked'))
		value = 1;
	
	statusStartSaving();
	$.post("<?php echo BudgetController::createUrl('AjaxChangePrintNoteChk'); ?>",
			{
				id:id,
				version:version,
				value:value				
			}
		).success(
			function(data){
				statusSaved();
			}).error(function(){statusSavedError();});
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

function openUpdateClause(idBudget, version)
{
	$.post("<?php echo BudgetController::createUrl('AjaxOpenUpdateClause'); ?>",
			{
				idBudget:idBudget,
				version:version
			}
		).success(
			function(data){
				nicEditors.findEditor( "Budget_clause_description" ).setContent( data );
		   		$('#myModalChangeClause').modal('show');	  
			});
		return false;
}

function openUpdateNoteVersion(idBudget, version)
{
	$.post("<?php echo BudgetController::createUrl('AjaxOpenUpdateNoteVersion'); ?>",
			{
				idBudget:idBudget,
				version:version
			}
		).success(
			function(data){
				nicEditors.findEditor( "Budget_note_version" ).setContent( data );
		   		$('#myModalChangeNoteVersion').modal('show');	  
			});
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
function changeTree(idArea,idAreaProject, hideArea)
{	
	if(hideArea==0)
		$('#chk-hide-area').attr('checked',false);
	else
		$('#chk-hide-area').attr('checked',true);				
	
	
	if(idArea != 0 &&idAreaProject!=0)
	{
		$.fn.yiiGridView.update('budget-item-grid_' + idAreaProject + '_' + idArea);
		$("#warningEmpty").addClass("hide");
		$(".sideMenuBotones .isdisable").removeClass("disabled");
		$(".areas .tab-pane").removeClass("active");
		$("#itemArea_"+idAreaProject+"_"+idArea).addClass("active");
		$('#idTabArea').val(idArea);
		$('#idTabAreaProject').val(idAreaProject);
		$('.tituloAreaPresu').html($('#areaProjectDescription_'+idAreaProject).html());
		$('#addProduct').removeAttr("disabled");

		$('#chk-hide-area').attr("disabled","disabled");
		
		$.post(
	 			'<?php echo BudgetController::createUrl('budget/AjaxGetHideAreaChk')?>',
	 			 {
	 				idAreaProject: idAreaProject
	 			 },'json').success(
	 				function(data) 
	 				{ 
	 					if(data==0)
	 						$('#chk-hide-area').attr('checked',false);
	 					else
	 						$('#chk-hide-area').attr('checked',true);

	 					$('#chk-hide-area').removeAttr("disabled");						 		
	 				}
	 			).error(function(){});		
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
		$('#chk-hide-area').attr("disabled","disabled");
	}

	
	
}

function addQty(idProduct,object)
{
	//$(object).addClass('disabled', {duration:500});
	var chkAdd = $("#chk-add-"+idProduct);
	var btn = $("#btn-qty-field-"+idProduct);
	var input = $("#qty-field-"+idProduct);
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
				btn.hide();				
				input.hide();
				
				chkAdd.animate({opacity: 'show'},240);
				chkAdd.animate({opacity: 'hide'},3000, function(){
					btn.show();
					input.show();
					});

				
				//$(object).removeClass('disabled', {duration:500});
				
// 				$.fn.yiiGridView.update('product-grid-add', {
// 					data: $(this).serialize() + '&idArea=' + $('#idTabArea').val()+'&idAreaProject=' + $('#idTabAreaProject').val()
// 				});			
				
// 				$('#total-qty').children().text(data); 
			}).error(function(data){$(object).removeClass('disabled', {duration:500});});
		return false;
}

function addProduct(id,version)
{
// 	$.fn.yiiGridView.update('product-grid-add', {
// 		data: $(this).serialize() + '&idArea=' + $('#idTabArea').val()+'&idAreaProject=' + $('#idTabAreaProject').val()
// 	});
	
	$('#myModalAddProduct').append($('#container-modal-addProduct'));
	$('#container-modal-addProduct').show();

	var idArea = $('#idTabArea').val();
	var idAreaProject = $('#idTabAreaProject').val();
	var idBudget = $('#idBudget').val();
	var version = $('#version').val();
	
//	$.post("<?php echo BudgetController::createUrl('AjaxGetTotalQty'); ?>",
// 			{
// 				idBudget:idBudget,
// 				version:version,
// 				idArea:idArea,
// 				idAreaProject:idAreaProject
// 			}
// 		).success(
// 			function(data){
// 				$('#total-qty').children().text(data);
// 			});
		
	$('#myModalAddProduct').modal('show');
	
	return false;
}

function hideArea(idBudget, version, obj)
{
	var value = 0;
	if($(obj).is(':checked'))
		value = 1;
	statusStartSaving();
	$.post("<?php echo BudgetController::createUrl('AjaxHideArea'); ?>",
			{
				idBudget:idBudget,
				version:version,
				idAreaProject: $('#idTabAreaProject').val(),
				value:value				
			}
		).success(
			function(data){
				statusSaved();
			}).error(function(){statusSavedError();});
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
 
function editProjectService(idProject,idService,idBudget,versionNumber)
{
	$.post(
			'<?php echo BudgetController::createUrl('project/AjaxShowUpdateModalProjectService')?>',
			 {
			 	Id_project: idProject,
			 	Id_service: idService,
			 	Id_budget: idBudget,
			 	version_number: versionNumber,
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

function editProjectServiceNote(idProject,idService,idBudget,versionNumber)
{
	$.post(
			'<?php echo BudgetController::createUrl('project/AjaxShowUpdateModalProjectServiceNote')?>',
			 {
			 	Id_project: idProject,
			 	Id_service: idService,
			 	Id_budget: idBudget,
			 	version_number: versionNumber,
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