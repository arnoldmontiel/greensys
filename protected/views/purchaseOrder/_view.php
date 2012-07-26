<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('code')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->code), array('view', 'id'=>$data->Id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Id_supplier')); ?>:</b>
	<?php echo CHtml::encode($data->supplier->business_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_creation')); ?>:</b>
	<?php echo CHtml::encode($data->date_creation); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Id_purchase_order_state')); ?>:</b>
	<?php echo CHtml::encode($data->purchaseOrderState->description); ?>
	<br />

</div>