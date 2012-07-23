<?php
$this->breadcrumbs=array(
	'Budgets'=>array('index'),
	$model->project->description,
);

$this->menu=array(
	array('label'=>'List Budget', 'url'=>array('index')),
	array('label'=>'Create Budget', 'url'=>array('create')),
	array('label'=>'Update Budget', 'url'=>array('update', 'id'=>$model->Id, 'version'=>$model->version_number)),
	array('label'=>'Delete Budget', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->Id, 'version'=>$model->version_number),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Add Items Budget', 'url'=>array('addItem', 'id'=>$model->Id, 'version'=>$model->version_number)),
	array('label'=>'Manage Budget', 'url'=>array('admin')),
);
Yii::app()->clientScript->registerScript(__CLASS__.'view-budget', "


$('.areaTitle').click(function(){
	var idArea = $(this).attr('idArea');	
	if($( '#itemArea_' + idArea ).is(':visible')){
		$('#expandCollapse_' + idArea).text('+');
	}
	else{
		$('#expandCollapse_' + idArea).text('-');
	}
	$('#itemArea_' + idArea ).toggle('blind',{},1000);
	
});

$('.link-popup').click(function(){
	var idArea = $(this).attr('idArea');
	var idBudgetItem = $(this).attr('id');
	var idProduct = $(this).attr('idProduct');
		
	$.fn.yiiGridView.update('budget-item-children-grid', {
 		data: 'BudgetItem[Id_budget_item]=' + idBudgetItem
 	});
	
	$('#ViewProductChild').dialog('open');
		
 	return false; 	
});

$('input:checkbox').live('click',function() {

	var idProduct = $(this).attr('idProduct');
	var idBudgetItem = $(this).attr('idBudgetItem');
	if($(this).is(':checked'))
	{
		selectSpecificRow('budget-item-children-grid', idBudgetItem);
	
		$('#displayChildrenPrices' ).toggle('blind',{},1000);
	
		$.fn.yiiGridView.update('price-list-item-child-grid', {
				data: 'ProductSale[Id]=' + idProduct
			});			
	}
	else
	{
		$.post(
			'".BudgetController::createUrl('AjaxQuitItem')."',
			{
				IdBudgetItem: idBudgetItem
			}).success(
				function(data) 
					{ 
				
			});
	}
});

");
?>

<h1>View Budget
<?php echo CHtml::link( ' (Create new version)','#',array('onclick'=>'jQuery("#CreateBudgetNewVersion").dialog("open"); return false;'));?>
</h1>

<?php 

$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		array('label'=>$model->getAttributeLabel('Id_project'),
			'type'=>'raw',
			'value'=>$model->project->description
		),
		array('label'=>$model->getAttributeLabel('version_number'),
						'type'=>'raw',
						'value'=>$model->version_number . ' ( ' . CHtml::link('view all versions', BudgetController::createUrl('adminAllVersion',array('id'=>$model->Id, 'version'=>$model->version_number))) . ' )'
		),
		array('label'=>$model->getAttributeLabel('Id_budget_state'),
			'type'=>'raw',
			'value'=>$model->budgetState->description
		),
		'description',
		'percent_discount',
		'date_creation',
		'date_inicialization',
		'date_finalization',
		'date_estimated_inicialization',
		'date_estimated_finalization',
		'note',
		'totalPrice',
	),
)); ?>
<br>
<?php 
	$areaProjects = AreaProject::model()->findAllByAttributes(array('Id_project'=>$model->Id_project));		

	foreach($areaProjects as $item)
	{ 
	?>
		<div class="gridTitle-decoration1" style="display: inline-block; width: 98%;height: 35px;">
			<div class="areaTitle" idArea="<?php echo $item->Id_area; ?>" style="display: inline-block;position: relative; width: 90%;vertical-align: top; margin-top: 4px;">
				<span id="expandCollapse_<?php echo $item->Id_area; ?>">+</span>&nbsp;<?php echo $item->area->description;?>
			</div>
		</div>
		<br>&nbsp;
		<div id="itemArea_<?php echo $item->Id_area; ?>" style="display: none">
		<?php		
		$modelBudgetItem->Id_area = $item->Id_area;		
		
		echo $this->renderPartial('_budgetItem', array('idArea'=>$item->Id_area,
													   'modelBudgetItem'=>$modelBudgetItem,
													   'canEdit'=>false,));
		?>		
		</div><!-- close itemArea -->
<?php				
	}


//New Budget Version
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
			'id'=>'CreateBudgetNewVersion',
// additional javascript options for the dialog plugin
			'options'=>array(
					'title'=>'Generate new budget version',
					'autoOpen'=>false,
					'modal'=>true,
					'width'=> '500',
					'buttons'=>	array(
							'Cancelar'=>'js:function(){jQuery("#CreateBudgetNewVersion").dialog( "close" );}',
							'Grabar'=>'js:function()
							{
							jQuery("#wating").dialog("open");
							debugger;
							jQuery.post("'.Yii::app()->createUrl("budget/AjaxNewVersion").'", 
								{
									id: "'. $model->Id . '",
									version: "'. $model->version_number . '",
									note: $("#Budget_note").val()
								},
							function(data) {
								jQuery("#CreateBudgetNewVersion").dialog( "close" );
								window.location = "'.BudgetController::createUrl('index') .'";
							}
					);
	
			}'),
),
));

echo $this->renderPartial('../budget/_formNewVersion', array('id'=>$model->Id, 'version'=>$model->version_number));

$this->endWidget('zii.widgets.jui.CJuiDialog');


//Product View Childe
	$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
			'id'=>'ViewProductChild',
			// additional javascript options for the dialog plugin
			'options'=>array(
					'title'=>'Children Product',
					'autoOpen'=>false,
					'modal'=>true,
					'width'=> '700',
					'buttons'=>	array(
							'cerrar'=>'js:function(){jQuery("#ViewProductChild").dialog( "close" );}',
					),
			),
	));
	echo CHtml::openTag('div',array('id'=>'popup-place-holder','style'=>'position:relative;display:inline-block;width:97%'));
	
	$modelBudgetItem = new BudgetItem('search');
	$modelBudgetItem->unsetAttributes();  // clear any default values
	
	$modelBudgetItem2 = new BudgetItem('search');
	$modelBudgetItem2->unsetAttributes();  // clear any default values
	
	//$modelBudgetItem->Id_budget_item = $_POST['Id_budget_item'];
	
	//$modelBudgetItemParent = BudgetItem::model()->findByPk($_POST['Id_budget_item']);
		
	$priceListItemSale = new PriceListItem();
	$priceListItemSale->unsetAttributes();
		
		
	echo $this->renderPartial('_budgetItemChildren', array('idArea'=>$_POST['Id_area'],
																	   'modelBudgetItem'=>$modelBudgetItem,
																	   'canEdit'=>false,
																	   'priceListItemSale'=>$priceListItemSale,
																	   'modelBudgetItemParent'=>$modelBudgetItem2,
																	));
	
	echo CHtml::closeTag('div');
		
	$this->endWidget('zii.widgets.jui.CJuiDialog');
?>