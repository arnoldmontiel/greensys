<?php
$this->breadcrumbs=array(
	'Budgets'=>array('index'),
	$model->project->description,
);
$settings = new Settings();

$this->menu=array(
	array('label'=>'List Budget', 'url'=>array('index')),
	array('label'=>'Create Budget', 'url'=>array('create')),
	array('label'=>'Update Budget', 'url'=>array('update', 'id'=>$model->Id, 'version'=>$model->version_number)),
	array('label'=>'Delete Budget', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->Id, 'version'=>$model->version_number),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Add Items Budget', 'url'=>array('addItem', 'id'=>$model->Id, 'version'=>$model->version_number)),
	array('label'=>'Manage Budget', 'url'=>array('admin')),
	array('label'=>'View by services', 'url'=>array('viewService', 'id'=>$model->Id, 'version'=>$model->version_number)),
);
Yii::app()->clientScript->registerScript(__CLASS__.'view-budget', "


$('.areaTitle').click(function(){
	var idArea = $(this).attr('idArea');	
	var idAreaProject = $(this).attr('idAreaProject');	
	if($( '#itemArea_' +idAreaProject + '_'+ idArea ).is(':visible')){
		$('#expandCollapse_'+ idAreaProject +'_'+ idArea).text('+');
	}
	else{
		$('#expandCollapse_'+ idAreaProject +'_' + idArea).text('-');
	}
	$('#itemArea_'+ idAreaProject +'_' + idArea ).toggle('blind',{},1000);
	
});

function fillParentData(data)
{
	$('#IdItemBudgetParent').val(data.id);
	$('#parent_code').text(data.parent_code);
	$('#parent_model').text(data.parent_model);
	$('#parent_part_number').text(data.parent_part_number);
	$('#parent_customer_desc').text(data.parent_customer_desc);
	$('#parent_brand_desc').text(data.parent_brand_desc);
	$('#parent_supplier_name').text(data.parent_supplier_name);
	$('#parent_price').text(data.parent_price);
	
}

$('.link-popup').click(function(){
	var idArea = $(this).attr('idArea');
	var idAreaProject = $(this).attr('idAreaProject');
	var idBudgetItem = $(this).attr('id');
	var idProduct = $(this).attr('idProduct');
		
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

$('.btn-View-Assign').click(function(){
	var idProduct = $(this).attr('idProduct');
	var idBudgetItem = $(this).attr('idBudgetItem');
	var idArea = $(this).attr('idArea');
	var idAreaProject = $(this).attr('idAreaProject');
					
	$('#ViewStockAssign').attr('idArea',idArea);	
	$('#ViewStockAssign').attr('idAreaProject',idAreaProject);	
					
	$.post(
			'".BudgetController::createUrl('AjaxViewAssign')."',
			{
				IdProduct: idProduct,																 	
				IdBudgetItem: idBudgetItem
			}).success(
				function(data) 
				{ 
					$('#popup-stock-assign-place-holder').html(data);
					$('.btn-un-assign-stock').attr('disabled','disabled');
					$('#ViewStockAssign').dialog('open');
					
				});
			
 	return false; 	
});

$('#btn-export').click(function(){
	window.location = '".BudgetController::createUrl('ExportToExcel',array('id'=>$model->Id,'versionNumber'=>$model->version_number)) ."';
	return false;
});
");
?>

<h1>View Budget
<?php echo CHtml::link( ' (Create new version)','#',array('onclick'=>'jQuery("#CreateBudgetNewVersion").dialog("open"); return false;'));?>
&nbsp;-&nbsp;
<?php echo CHtml::link( 'Export','#',array('id'=>'btn-export'));?>
</h1>
<div id="left" style="width: 49% ;float: left">

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
			array('label'=>$model->getAttributeLabel('Id_project'),
			'type'=>'raw',
			'value'=>$model->project->description
		),
		array('label'=>$model->getAttributeLabel('Id_budget_state'),
			'type'=>'raw',
			'value'=>$model->budgetState->description
		),
		'date_estimated_inicialization',
	),
)); ?>
</div>
<div id="left" style="width: 49%;float: left;">

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'version_number',
		'description',
		'date_estimated_finalization',
	),
)); ?>
</div>
<div id="left" style="width: 98%;float: left;">
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'note',
	),
)); ?>
</div>
<br>


<?php 
	$areaProjects = AreaProject::model()->findAllByAttributes(array('Id_project'=>$model->Id_project));		

	foreach($areaProjects as $item)
	{ 
	?>
		<div class="gridTitle-decoration1" style="display: inline-block; width: 98%;height: 35px;">
			<div class="areaTitle" idArea="<?php echo $item->Id_area; ?>" idAreaProject="<?php echo $item->Id; ?>" style="display: inline-block;position: relative; width: 90%;vertical-align: top; margin-top: 4px;">
				<span id="expandCollapse_<?php echo $item->Id_area; ?>">+</span>&nbsp;<?php echo $item->area->description." ( ".$item->description." )";?>
			</div>
		</div>
		<br>&nbsp;
		<div id="itemArea_<?php echo $item->Id."_".$item->Id_area; ?>" style="display: none">
		<?php		
		$modelBudgetItem->Id_area = $item->Id_area;		
		$modelBudgetItem->Id_area_project = $item->Id;
		
		echo $this->renderPartial('_budgetItem', array('idArea'=>$item->Id_area,
													   'idAreaProject'=>$item->Id,
													   'modelBudgetItem'=>$modelBudgetItem,
													   'canEdit'=>false,));
		?>		
		</div><!-- close itemArea -->
	<?php				
	}
	?>
		<div>
<?php
	$this->widget('zii.widgets.grid.CGridView', array(
					'id'=>'budget-item-generic',
					'dataProvider'=>$modelBudgetItem->searchGenericItem(),
					'summaryText'=>'',
					'columns'=>array(
							'description',
							array(
								'name'=>'quantity',
								'value'=>
                                    	'CHtml::textField("txtQuantityGenericItem",
												$data->quantity,
												array(
														"id"=>$data->Id,
														"class"=>"txtQuantityGenericItem",
														"style"=>"width:50px;text-align:right;",
														"disabled"=>"disabled",
													)
											)',
			
								'type'=>'raw',
								'htmlOptions'=>array("style"=>"text-align:right;"),
							),
							array(
									'name'=>'price',
									'value'=>
                                    	'CHtml::textField("txtPriceGenericItem",
												"'.$settings->getEscapedCurrencyShortDescription().' ".$data->price,
												array(
														"id"=>$data->Id,
														"class"=>"txtPriceGenericItem",
														"disabled"=>"disabled",
														"style"=>"width:90px;text-align:right;",
													)
											)',

									'type'=>'raw',
									'htmlOptions'=>array("style"=>"text-align:right;"),
							),
							array(
									'name'=>'discount',
									'value'=>
									'CHtml::textField("txtDiscount",
											$data->discount,
											array(
													"id"=>$data->Id,
													"class"=>"txtGenericDiscount",
													"disabled"=>"disabled",
													"style"=>"width:50px;text-align:right;",
												)
										)',
							
									'type'=>'raw',
							
									'htmlOptions'=>array('width'=>5),
							),
							
							array(
									'name'=>'discount_type',
									'value'=>'($data->discount_type==0)?"%":"'.$settings->getEscapedCurrencyShortDescription().'";',
									'type'=>'html',
									'htmlOptions'=>array('style'=>"width:20px"),
							),

							array(									
									'name'=>'total_price',
									'value'=>
                                    	'CHtml::textField("txtTotalPriceGenericItem",
												"'.$settings->getEscapedCurrencyShortDescription().' ". $data->totalPrice,
												array(
														"id"=>$data->Id,
														"class"=>"txtTotalPriceGenericItem",
														"disabled"=>"disabled",
														"style"=>"width:90px;text-align:right;",
													)
											)',

									'type'=>'raw',
									'htmlOptions'=>array("style"=>"text-align:right;"),
								),
							),
					));

$this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'attributes'=>array(
			array('label'=>$model->getAttributeLabel('subTotalPrice'),
					'type'=>'raw',
					'htmlOptions'=>array('style' => 'text-align: right;'),
					'value'=>
					CHtml::textField("totalPrice",
							$settings->getCurrencyShortDescription()." ".$model->totalPrice,
							array(
									'id'=>"totals_total_price",
									"disabled"=>"disabled",
									"style"=>"width:100px;float:right;text-align:right;",
							)
					),
			),

		array('label'=>$model->getAttributeLabel('percent_discount'),
			'type'=>'raw',
			'htmlOptions'=>array('style' => 'text-align: right;'),
			'value'=>
			CHtml::textField("percen_discount",
				$model->percent_discount." %",
				array(
					'id'=>"totals_percent_discount",
					"disabled"=>"disabled",
					"style"=>"width:50px;display:inline-block;text-align:right;",
					)
				).
			CHtml::textField("TotalPriceWithDiscount",
				$settings->getCurrencyShortDescription()." ".$model->TotalDiscount,
				array(
					'id'=>"totals_discount",
					"disabled"=>"disabled",
					"style"=>"width:100px;float:right;text-align:right;display:inline-block;",
					)
			),
		),
		array('label'=>$model->getAttributeLabel('totalPrice'),
				'type'=>'raw',
				'htmlOptions'=>array('style' => 'text-align: right;'),
				'value'=>
				CHtml::textField("TotalPriceWithDiscount",
						$settings->getCurrencyShortDescription()." ".$model->TotalPriceWithDiscount,
						array(
								'id'=>"totals_price_w_discount",
								"disabled"=>"disabled",
								"style"=>"width:100px;float:right;text-align:right;",
						)
				),
		),
	),
));
	?>
</div>
	
	<?php 


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
		
	$priceListItemSale = new PriceListItem();
	$priceListItemSale->unsetAttributes();
		
		
	echo $this->renderPartial('_budgetItemChildrenView', array(	'modelBudgetItem'=>$modelBudgetItem,
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