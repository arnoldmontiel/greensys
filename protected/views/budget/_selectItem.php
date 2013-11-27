
<div id="display">

<div id="selectProducts_<?php echo $idAreaProject."_".$idArea; ?>" style="display: none;">
 <?php	
$this->widget('zii.widgets.jui.CJuiTabs', array(
    'tabs'=>array(
		'All Products' => array('content' => $this->renderPartial("_filteredGrid",
		array("modelProduct"=>$modelProduct,
				"priceListItemSale"=>$priceListItemSale,
				"model"=>$model,
				"idArea"=>$idArea,
				"idAreaProject"=>$idAreaProject, 
				"type"=>'byAll'),true)),
        'Filtered by Category' => array('content' => $this->renderPartial("_filteredGrid",
		array("modelProduct"=>$modelProduct,
				"priceListItemSale"=>$priceListItemSale,
				"model"=>$model,
				"idArea"=>$idArea, 
				"idAreaProject"=>$idAreaProject,
				"type"=>'byCat'),true)),
		'Filtered by Group' => array('content' => $this->renderPartial("_filteredGrid",
		array("modelProduct"=>$modelProduct,
				"priceListItemSale"=>$priceListItemSale,
				"model"=>$model,
				"idArea"=>$idArea, 
				"idAreaProject"=>$idAreaProject,
				"type"=>'byProd'),true)),
),
// additional javascript options for the tabs plugin
    'options'=>array(
        'collapsible'=>true,
),
));
 ?>
<br>
</div>
<?php
echo $this->renderPartial('_budgetItem', array('idArea'=>$idArea,
											   'idAreaProject'=>$idAreaProject,
											   'modelBudgetItem'=>$modelBudgetItem,
											   'canEdit'=>true,));
?>
 <br>
</div>