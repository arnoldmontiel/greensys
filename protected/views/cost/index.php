<?php
$this->breadcrumbs=array(
	'Cost',
);
Yii::app()->clientScript->registerScript('priceListItem', "
$('#PriceList_Id').change(function(){
	
	if($(this).val()!= ''){
		$.fn.yiiGridView.update('cost-item-grid', {
			data: $(this).serialize()
		});
		$('#display').animate({opacity: 'show'},240);
// 		$.post('".PriceListController::createUrl('AjaxFillSidebar')."',
// 					$(this).serialize()
// 				).success(
// 					function(data) 
// 					{
// 						$('#sidebar').html(data);
// 						$( '#sidebar' ).show();	
// 					}
// 				);
	}
	else{
		$('#display').animate({opacity: 'hide'},240);
		$( '#sidebar' ).hide();	

	}
	return false;
}
);
");
?>
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'priceList-form',
		'enableAjaxValidation'=>true,
));
?>

<h1>Product Cost</h1>
<div id="priceList" style="margin-bottom: 5px">
	
	<?php	$priceLists = CHtml::listData($modelPriceList->findAll(), 'Id', 'PriceListDesc');?>

	<?php echo $form->label($modelPriceList,'Price List', 'ddlPriceList');?>

	<?php echo CHtml::dropDownList($modelPriceList,'PriceList_Id',"", $priceLists,		
		array(
			'prompt'=>'Select a Price List'
		)		
	);
	?>
</div>

<div id="display">
	<?php $this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'cost-item-grid',
		'dataProvider'=>$modelPriceListItem->search(),
		'filter'=>$modelPriceListItem,
		'columns'=>array(
			array(
	 			'name'=>'code',
				'value'=>'$data->product->code',
			),
			array(
	 			'name'=>'code',
				'value'=>'$data->product->code',
			),
	),
	)); ?>
</div>

	<?php $this->endWidget(); ?>
</div> <!-- form-->
