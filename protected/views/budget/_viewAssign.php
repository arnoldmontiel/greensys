<?php

Yii::app()->clientScript->registerScript(__CLASS__.'view-assign-', "

");
?>

<?php 

if(isset($model->stock)){
echo "From Stock";
$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model->stock,
	'attributes'=>array(
		'username',
		'creation_date',
		'description',
	),
));
echo CHtml::button("Un Assing from stock",array('class'=>'btn-un-assign-stock','idProduct'=>$model->Id_product, 'idBudgetItem'=>$model->Id_budget_item));
}
else{

	echo "Purchase Order";
	
	$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model->idPurchaseOrderItem->purchaseOrder,
	'attributes'=>array(
		'code',
		'date_creation',
	),
));
}
 ?>
