<?php
$this->breadcrumbs=array(
	'Stock Summary',
);


?>
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'stock-summary-form',
		'enableAjaxValidation'=>true,
));
?>

<h1>Stock Summary</h1>

	<?php $this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'stock-summary-grid',
		'dataProvider'=>$model->search(),
		'filter'=>$model,
		'selectionChanged'=>'js:function(){
			$.fn.yiiGridView.update("stock-detail-grid", {
				data: "StockSummary[Id]="+$.fn.yiiGridView.getSelection("stock-summary-grid")
			});
			var idProduct = $.fn.yiiGridView.getSelection("stock-summary-grid");
			if(idProduct!="")
			{
				$( "#display" ).animate({opacity: "show"},"slow");
			}
			else
			{
				$( "#display" ).animate({opacity: "hide"},"slow");
			}
		}',
		'columns'=>array(
				'description_customer',
				'description_supplier',
				'code',
				'code_supplier',
				'brand_description',
				'supplier_description',
				'quantity',
	 			
			),
	)
	); ?>

<div id="display" style="display: none">
	<div class="gridTitle-decoration1">
		<div class="gridTitle1">
			Stock Detail
		</div>
	</div>
<?php $this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'stock-detail-grid',
		'dataProvider'=>$modelStockItem->searchDetail(),
		'filter'=>$modelStockItem,
		'summaryText'=>'',
		'columns'=>array(
			array(
 					'name'=>'movement_type_desc',
					'value'=>'$data->stock->movementType->description',
			),
			array(
 					'name'=>'project_desc',
					'value'=>'$data->stock->project->description',
			),
			array(
 					'name'=>'username',
					'value'=>'$data->stock->username',
			),
			array(
 					'name'=>'stock_desc',
					'value'=>'$data->stock->description',
			),
			'quantity',
			),
		)
	); ?>
</div>
	<?php $this->endWidget(); ?>
</div> <!-- form-->
