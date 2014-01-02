<script type="text/javascript">
function changeTab(idArea)
{
	$('#idTabArea').val(idArea);
}

function addQty(idProduct)
{
	var qty = $("#qty-field-"+idProduct).val();
	var idArea = $('#idTabArea').val();
	var idBudget = $('#idBudget').val();
	var version = $('#version').val();
	$.post("<?php echo BudgetController::createUrl('AjaxAddProduct'); ?>",
			{
				idBudget:idBudget,
				version:version,
				idProduct:idProduct,
				idArea:idArea,
				qty: qty
			}
		).success(
			function(data){
				$.fn.yiiGridView.update('product-grid-add', {
					data: $(this).serialize() + '&idArea=' + $('#idTabArea').val()
				});			  
			});
		return false;
}

function addProduct(id,version)
{
	$.fn.yiiGridView.update('product-grid-add', {
		data: $(this).serialize() + '&idArea=' + $('#idTabArea').val()
	});
	$('#myModalAddProduct').append($('#container-modal-addProduct'));
	$('#myModalAddProduct').modal('show');
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

<div id="container-modal-addProduct">
<?php echo $this->renderPartial('_modalAddProduct', array( 'modelProducts'=>$modelProducts));?>
</div>
<!-- /container --> 