<script type="text/javascript">
function addProduct(id,version)
{
	$.post("<?php echo BudgetController::createUrl('AjaxOpenAddProduct'); ?>",
			{
				id:id,
				version:version
			}
		).success(
			function(data){
				$('#myModalAddProduct').html(data);
		   		$('#myModalAddProduct').modal('show');	  
			});
		return false;
}

function editBudget(id,version)
{
	var params = "&id="+id+"&version="+version;
	window.location = "<?php echo BudgetController::createUrl("addItem")?>" + params; 
	return false;
}
</script>
<div class="container" id="screenCrearPresupuesto">
  <h1 class="pageTitle">Presupuesto</h1>
  
  
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
<!-- /container --> 