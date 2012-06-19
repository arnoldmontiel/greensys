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
		'id'=>'cost-item-grid',
		'dataProvider'=>$model->search(),
		'filter'=>$model,
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


	<?php $this->endWidget(); ?>
</div> <!-- form-->
