<script type="text/javascript">
function openUpdateBudget(idBudget, version)
{
	$.post("<?php echo BudgetController::createUrl('AjaxOpenUpdateBudget'); ?>",
			{
				idBudget:idBudget,
				version:version
			}
		).success(
			function(data){
				$('#myModalUpdateBudget').html(data);
		   		$('#myModalUpdateBudget').modal('show');	  
			});
		return false;
}

function changeTab(idArea,idAreaProject)
{
	$('#idTabArea').val(idArea);
	$('#idTabAreaProject').val(idAreaProject);
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
				$.fn.yiiGridView.update("budget-item-grid_"+idAreaProject+"_"+idArea); 
				updateGridExtras(); 
				setTotals();	
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
	var params = "&id="+id+"&version="+version;
	window.location = "<?php echo BudgetController::createUrl("addItem")?>" + params; 
	return false;
}

function exportBudget(id, version)
{
	var params = "&id="+id+"&version="+version;
	window.location = "<?php echo BudgetController::createUrl("exportToExcel")?>" + params; 
	return false;
}
</script>
<div class="container" id="screenCrearPresupuesto">
  <h1 class="pageTitle">Presupuesto</h1>
  	<?php echo CHtml::hiddenField("idBudget",$model->Id,array("id"=>"idBudget"));?>
  	<?php echo CHtml::hiddenField("version",$model->version_number,array("id"=>"version"));?>
	<?php $this->renderPartial('_editBudgetHead',array('model'=>$model));?>
	<?php $this->renderPartial('_editBudgetBody',array(
					'model'=>$model,
					'modelProduct'=>$modelProduct,
					'modelBudgetItem'=>$modelBudgetItem,
					'priceListItemSale'=>$priceListItemSale,
					'areaProjects'=>$areaProjects,
					'modelBudgetItemGeneric'=>$modelBudgetItemGeneric,
		));?>
  
</div>

<div id="container-modal-addProduct" style="display: none">
<?php echo $this->renderPartial('_modalAddProduct', array( 'modelProducts'=>$modelProducts));?>
</div>
<!-- /container --> 