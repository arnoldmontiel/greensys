<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('Id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->Id), array('view', 'id'=>$data->Id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Id_volts')); ?>:</b>
	<?php echo CHtml::encode($data->volts->volts); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Id_currency')); ?>:</b>
	<?php echo CHtml::encode($data->currency->short_description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Id_measurement')); ?>:</b>
	<?php echo CHtml::encode($data->measurement->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('time_instalation_price')); ?>:</b>
	<?php echo CHtml::encode($data->time_instalation_price); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('time_programation_price')); ?>:</b>
	<?php echo CHtml::encode($data->time_programation_price); ?>
	<br />

</div>