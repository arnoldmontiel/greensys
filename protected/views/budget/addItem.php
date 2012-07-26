<?php
$this->breadcrumbs=array(
	'Stocks'=>array('index'),
	$model->project->description=>array('view','id'=>$model->Id, 'version'=>$model->version_number),
	'Add Products',
);

$this->menu=array(
	array('label'=>'List Budget', 'url'=>array('index')),
	array('label'=>'Create Budget', 'url'=>array('create')),
	array('label'=>'Update Budget', 'url'=>array('update', 'id'=>$model->Id, 'version'=>$model->version_number)),
	array('label'=>'Delete Budget', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->Id, 'version'=>$model->version_number),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Budget', 'url'=>array('admin')),
);
Yii::app()->clientScript->registerScript(__CLASS__.'add-item-budget', "

function updateGridViews()
{
	$('div.grid-view').each(
		function(index){
			if($(this).attr('id').indexOf('budget-item-grid') != -1)
				$.fn.yiiGridView.update($(this).attr('id'));
		}
	)
}
		

$('.aareaTitle').click(function(){
	var idArea = $(this).attr('idArea');	
	
	if($( '#itemArea_' + idArea ).is(':visible')){
		$('#expandCollapse_' + idArea).text('+');
	}
	else{
		$('#expandCollapse_' + idArea).text('-');
	}
	$('#itemArea_' + idArea ).toggle('blind',{},1000);
	
});


function fillParentData(data)
{
	$('#IdItemBudgetParent').val(data.id);
	$('#parent_code').text(data.parent_code);
	$('#parent_customer_desc').text(data.parent_customer_desc);
	$('#parent_brand_desc').text(data.parent_brand_desc);
	$('#parent_supplier_name').text(data.parent_supplier_name);
	$('#parent_price').text(data.parent_price);
	
}

$('.link-popup').click(function(){
	var idArea = $(this).attr('idArea');
	var idBudgetItem = $(this).attr('id');
	var idProduct = $(this).attr('idProduct');
	$('#ViewProductChild').attr('area',idArea);	
	$.post(
			'".BudgetController::createUrl('AjaxGetParentInfo')."',
			{
				IdBudgetItem: idBudgetItem
			},
			function(data)
			{
				fillParentData(data);				
		},'json');	
		
	$('#ViewProductChild').dialog('open');
	
	$.fn.yiiGridView.update('budget-item-children-grid', {
 		data: 'BudgetItem[Id_budget_item]=' + idBudgetItem
 	});
			
 	return false; 	
});

$('input:checkbox').live('click',function() {

	var idProduct = $(this).attr('idProduct');
	var idBudgetItem = $(this).attr('idBudgetItem');
	var idBudgetItemParent = $(this).attr('idBudgetItemParent');
	$('#displayChildrenPrices' ).toggle('blind',{},1000);
	
	if($(this).is(':checked'))
	{
		selectSpecificRow('budget-item-children-grid', idBudgetItem);
	
		$.fn.yiiGridView.update('price-list-item-child-grid', {
				data: 'ProductSale[Id]=' + idProduct
			});			
	}
	else
	{
		unselectRow('budget-item-children-grid');
		$.post(
			'".BudgetController::createUrl('AjaxQuitItem')."',
			{
				IdBudgetItem: idBudgetItem
			}).success(
				function(data) 
					{ 
				$.fn.yiiGridView.update('budget-item-children-grid', {
 					data: 'BudgetItem[Id_budget_item]=' + idBudgetItemParent
 				});
			});
	}
});

$('.btn-Assign-From-Stock').click(function(){
	if(!confirm('Are you sure you want to assign from stock?')) 
	{			
		return false;
	}
	var idProduct = $(this).attr('idProduct');
	var idBudgetItem = $(this).attr('idBudgetItem');
	var idArea = $(this).attr('idArea');
	$.post(
			'".BudgetController::createUrl('AjaxAssignFromStock')."',
			{
				IdProduct: idProduct,																 	
				IdBudgetItem: idBudgetItem
			}).success(
				function(data) 
				{ 
					$.fn.yiiGridView.update('budget-item-grid_' + idArea);
					
				});
});

$('.btn-View-Assign').click(function(){
	var idProduct = $(this).attr('idProduct');
	var idBudgetItem = $(this).attr('idBudgetItem');
	var idArea = $(this).attr('idArea');
	
	$('#ViewStockAssign').attr('area',idArea);	

	$.post(
			'".BudgetController::createUrl('AjaxViewAssign')."',
			{
				IdProduct: idProduct,																 	
				IdBudgetItem: idBudgetItem
			}).success(
				function(data) 
				{ 
					$('#popup-stock-assign-place-holder').html(data);
					$('#ViewStockAssign').dialog('open');
					
				});
			
 	return false; 	
});

");

?>

<h1>Add product</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
			array('label'=>$model->getAttributeLabel('Id_project'),
			'type'=>'raw',
			'value'=>$model->project->description
		),
		'version_number',
		array('label'=>$model->getAttributeLabel('Id_budget_state'),
			'type'=>'raw',
			'value'=>$model->budgetState->description
		),
		'description',
		'percent_discount',
		'date_estimated_inicialization',
		'date_estimated_finalization',
	),
)); ?>

<br>

<div id="display">

<?php
	foreach($areaProjects as $item)
	{ 
	?>
		<div class="gridTitle-decoration1" style="display: inline-block; width: 98%;height: 35px;">
			<div class="gridTitle1" idArea="<?php echo $item->Id_area; ?>" style="display: inline-block;position: relative; width: 90%;vertical-align: top; margin-top: 4px;">
				<?php 
					echo CHtml::link('+ '.$item->area->description,
						'#',
						array(	'description'=>$item->area->description,
								'state'=>'+',
								'id'=>'expand-products',
								'onclick'=>'
									jQuery("#itemArea_'.$item->Id_area.'").toggle("blind",{},1000);
									jQuery("#expand-products'.$item->Id_area.'").toggle("blind",{},1000);
									if($(this).attr("state")=="+")
									{
										$(this).attr("state","-");
										$(this).html("- "+$(this).attr("description"));
									}
									else
									{
										if(jQuery("#expand-products'.$item->Id_area.'").html()=="- Products"){
											jQuery("#expand-products'.$item->Id_area.'").html("+ Products");
											jQuery("#selectProducts_'.$item->Id_area.'").toggle("blind",{},1000);
										}
										$(this).attr("state","+");
										$(this).html("+ "+$(this).attr("description"));
									}
									return false;
								'
								)
							)
				?><div style="float: right;margin-right:400px">
				<?php 
					echo CHtml::link('+ Products',
						'#',
						array(	'description'=>$item->area->description,
								'state'=>'+',
								'style'=>'display:none',
								'id'=>'expand-products'.$item->Id_area,
								'onclick'=>'
									jQuery("#selectProducts_'.$item->Id_area.'").toggle("blind",{},1000);
									if($(this).html()=="+ Products")
									{
										$(this).html("- Products");
									}
									else
									{
										$(this).html("+ Products");
									}
									return false;
								'
								)
							)
				?></div>
					</div>
		</div>
		<br>&nbsp;
		<div id="itemArea_<?php echo $item->Id_area; ?>" style="display: none">
		<?php		
		$modelBudgetItem->Id_area = $item->Id_area;		
		$modelProduct->product_area_id = $item->Id_area;
		
		echo $this->renderPartial('_selectItem', array('model'=>$model,
													   'idArea'=>$item->Id_area,
													   'modelProduct'=>$modelProduct,
													   'priceListItemSale'=>$priceListItemSale,
													   'modelBudgetItem'=>$modelBudgetItem));
		?>		
		</div><!-- close itemArea -->
<?php				
	}
?>
	 

</div>

<?php				

//Product View Child
	$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
				'id'=>'ViewProductChild',
	// additional javascript options for the dialog plugin
				'options'=>array(
						'title'=>'Children Product',
						'autoOpen'=>false,
						'modal'=>true,
						'width'=> '700',
						'buttons'=>	array(
								'cerrar'=>'js:function(){
									jQuery("#ViewProductChild").dialog( "close" );
									updateGridViews();
									//$.fn.yiiGridView.update("budget-item-grid_" + $("#ViewProductChild").attr("area"));
									}',
	),
	),
	));
	echo CHtml::openTag('div',array('id'=>'popup-child-view-place-holder','style'=>'position:relative;display:inline-block;width:97%'));
	
	$modelBudgetItem = new BudgetItem('search');
	$modelBudgetItem->unsetAttributes();  // clear any default values
	
	$priceListItemSale = new PriceListItem();
	$priceListItemSale->unsetAttributes();
	
	
	echo $this->renderPartial('_budgetItemChildren', array(	'modelBudgetItem'=>$modelBudgetItem,
																		   'priceListItemSale'=>$priceListItemSale,
	));
	
	echo CHtml::closeTag('div');
	
	$this->endWidget('zii.widgets.jui.CJuiDialog');

//View Stock Assign
	$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
					'id'=>'ViewStockAssign',
	// additional javascript options for the dialog plugin
					'options'=>array(
							'title'=>'Assign',
							'autoOpen'=>false,
							'modal'=>true,
							'width'=> '700',
							'buttons'=>	array(
									'cerrar'=>'js:function(){jQuery("#ViewStockAssign").dialog( "close" );
															//$.fn.yiiGridView.update("budget-item-grid_" + $("#ViewStockAssign").attr("area"));
															}',
	),
	),
	));
	echo CHtml::openTag('div',array('id'=>'popup-stock-assign-place-holder','style'=>'position:relative;display:inline-block;width:97%'));	
	echo CHtml::closeTag('div');
	
	$this->endWidget('zii.widgets.jui.CJuiDialog');
?>