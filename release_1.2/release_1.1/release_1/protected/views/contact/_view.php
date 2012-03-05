<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('Id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->Id), array('view', 'id'=>$data->Id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('telephone_1')); ?>:</b>
	<?php echo CHtml::encode($data->telephone_1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('telephone_2')); ?>:</b>
	<?php echo CHtml::encode($data->telephone_2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('telephone_3')); ?>:</b>
	<?php echo CHtml::encode($data->telephone_3); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('address')); ?>:</b>
	<?php echo CHtml::encode($data->address); ?>
	<br />


</div>