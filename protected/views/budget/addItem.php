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
	
	$.post(
			'".BudgetController::createUrl('AjaxDinamicViewPopUp')."',
			{
			 	Id_budget_item:idBudgetItem,
				Id_area : idArea
			 }).success(
					function(data) 
					{ 
						$('#popup-place-holder').html(data);
 						$('#ViewProductChild').dialog('open');						
					}
			);

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
			<div class="areaTitle" idArea="<?php echo $item->Id_area; ?>" style="display: inline-block;position: relative; width: 90%;vertical-align: top; margin-top: 4px;">
				<span id="expandCollapse_<?php echo $item->Id_area; ?>">+</span>&nbsp;<?php echo $item->area->description;?>
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
	echo CHtml::closeTag('div');
		
	$this->endWidget('zii.widgets.jui.CJuiDialog');
?>