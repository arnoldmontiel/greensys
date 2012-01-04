<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('Id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->Id), array('view', 'id'=>$data->Id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Id_measurement_from')); ?>:</b>
	<?php echo CHtml::encode($data->Id_measurement_from); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Id_measurement_to')); ?>:</b>
	<?php echo CHtml::encode($data->Id_measurement_to); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('factor')); ?>:</b>
	<?php echo CHtml::encode($data->factor); ?>
	<br />


</div>