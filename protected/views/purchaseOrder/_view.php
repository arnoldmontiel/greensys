<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('Id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->Id), array('view', 'id'=>$data->Id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Id_supplier')); ?>:</b>
	<?php echo CHtml::encode($data->supplier->business_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Id_shipping_parameter')); ?>:</b>
	<?php echo CHtml::encode($data->shippingParameter->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_creation')); ?>:</b>
	<?php echo CHtml::encode($data->date_creation); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Id_purchase_order_state')); ?>:</b>
	<?php echo CHtml::encode($data->purchaseOrderState->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Id_importer')); ?>:</b>
	<?php echo CHtml::encode($data->importer->contact->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Id_shipping_type')); ?>:</b>
	<?php echo CHtml::encode($data->Id_shipping_type); ?>
	<br />


</div>