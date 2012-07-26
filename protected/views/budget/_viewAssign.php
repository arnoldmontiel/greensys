<?php

Yii::app()->clientScript->registerScript(__CLASS__.'view-assign', "


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
//CHtml::button("UnAssing from stock",array('id'))
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
