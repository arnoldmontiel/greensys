<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('Id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->Id), array('view', 'id'=>$data->Id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_creation')); ?>:</b>
	<?php echo CHtml::encode($data->date_creation); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_validity')); ?>:</b>
	<?php echo CHtml::encode($data->date_validity); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('validity')); ?>:</b>
	<?php echo CHtml::encode($data->validity); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Id_supplier')); ?>:</b>
	<?php echo CHtml::encode($data->Id_supplier); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_price_list_type')); ?>:</b>
	<?php echo CHtml::encode($data->id_price_list_type); ?>
	<br />


</div>