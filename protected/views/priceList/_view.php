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
	<?php echo CHtml::encode($data->supplier->business_name); ?>
	<br />


</div>