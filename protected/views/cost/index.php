<?php
$this->breadcrumbs=array(
	'Cost',
);

$this->showSideBar = true;


Yii::app()->clientScript->registerScript('priceListItem', "
$('#PriceList_Id').change(function(){
	if($(this).val()!=''&& $('#Importer_Id').val()!=''){
		$.fn.yiiGridView.update('cost-item-grid', {
			data: $('#PriceList_Id').serialize()+'&'+$('#Importer_Id').serialize()
		});
		$('#display').animate({opacity: 'show'},240);
		$.post('".CostController::createUrl('AjaxFillSidebar')."',
			$('#PriceList_Id').serialize()+'&'+$('#Importer_Id').serialize()
		).success(
			function(data) 
			{
				$('#sidebar').html(data);
				$( '#sidebar' ).show();	
			}
		);
	}
	else{
		$('#display').animate({opacity: 'hide'},240);
		$( '#sidebar' ).hide();	
	}
	return false;
}
);
$('#Importer_Id').change(function(){
	
	if($(this).val()!= '' && $('#PriceList_Id').val()!= ''){
		$.fn.yiiGridView.update('cost-item-grid', {
			data: $('#PriceList_Id').serialize()+'&'+$('#Importer_Id').serialize()
		});
		$('#display').animate({opacity: 'show'},240);
		$.post('".CostController::createUrl('AjaxFillSidebar')."',
			$('#PriceList_Id').serialize()+'&'+$('#Importer_Id').serialize()
		).success(
			function(data) 
			{
				$('#sidebar').html(data);
				$( '#sidebar' ).show();	
			}
		);
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
		'id'=>'cost-form',
		'enableAjaxValidation'=>true,
));
?>

<h1>Product Cost</h1>
<div id="priceList" style="margin-bottom: 5px; display: inline-block">
	
	<?php $priceLists = CHtml::listData($modelPriceList->findAll(), 'Id', 'PriceListDesc');?>

	<?php $form->labelEx($modelPriceList,'Price List');?>

		<?php echo $form->dropDownList($modelPriceList, 'Id', $priceLists,		
			array(
				'prompt'=>'Select a Price List'
			)		
		);
		?>
</div>

<div id="importer" style="margin-bottom: 5px; display: inline-block">
	
	<?php $importerLists = CHtml::listData($modelImporter->findAll(), 'Id', 'ContactDescription');?>

	<?php $form->labelEx($modelImporter,'Importer');?>

		<?php echo $form->dropDownList($modelImporter, 'Id', $importerLists,		
			array(
				'prompt'=>'Select an Importer'
			)		
		);
		?>
</div>

<div id="display" style="display:none;">
	<?php $this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'cost-item-grid',
		'dataProvider'=>$model->search(),
		'filter'=>$model,
		'columns'=>array(
	 			'code',
				array('name'=>'msrp','type'=>'raw',
	 				'value'=>'number_format(round($data->msrp,4),2)',
					'htmlOptions'=>array('style'=>'text-align: right;')
				),
				array('name'=>'dealer_cost','type'=>'raw',
					'value'=>'number_format(round($data->dealer_cost,4),2)',
					'htmlOptions'=>array('style'=>'text-align: right;')
				),
				array('name'=>'profit_rate','type'=>'raw',
					'value'=>'number_format(round($data->profit_rate,4),2)',
					'htmlOptions'=>array('style'=>'text-align: right;')
				),
	 			array('name'=>'weight','type'=>'raw',
	 				'value'=>'number_format(round($data->weight,4),2)',
					'htmlOptions'=>array('style'=>'text-align: right;')
	 			),
				array('name'=>'cost_air','type'=>'raw',
					'value'=>'number_format(round($data->cost_air,4),2)',
					'htmlOptions'=>array('style'=>'text-align: right;')
				),
	 			array('name'=>'cost_air_final','type'=>'raw',
	 				'value'=>'number_format(round($data->cost_air_final,4),2)',
					'htmlOptions'=>array('style'=>'text-align: right;')
				),
				array('name'=>'volume','type'=>'raw',
	 				'value'=>'number_format(round($data->volume,4),4)',
					'htmlOptions'=>array('style'=>'text-align: right;')
				),
	 			array('name'=>'cost_maritime','type'=>'raw',
	 				'value'=>'number_format(round($data->cost_maritime,4),2)',
					'htmlOptions'=>array('style'=>'text-align: right;')
				),
	 			array('name'=>'cost_maritime_final','type'=>'raw',
	 				'value'=>'number_format(round($data->cost_maritime_final,4),2)',
					'htmlOptions'=>array('style'=>'text-align: right;')
				),
			),
	)
	); ?>
</div>

	<?php $this->endWidget(); ?>
</div> <!-- form-->
