<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->contact->getAttributeLabel('telephone_1')); ?>:</b>
	<?php echo CHtml::encode($data->contact->telephone_1); ?>
	<br />

	<b><?php echo CHtml::encode($data->contact->getAttributeLabel('telephone_2')); ?>:</b>
	<?php echo CHtml::encode($data->contact->telephone_2); ?>
	<br />

	<b><?php echo CHtml::encode($data->contact->getAttributeLabel('telephone_3')); ?>:</b>
	<?php echo CHtml::encode($data->contact->telephone_3); ?>
	<br />

	<b><?php echo CHtml::encode($data->contact->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->contact->email); ?>
	<br />

	<b><?php echo CHtml::encode($data->contact->getAttributeLabel('address')); ?>:</b>
	<?php echo CHtml::encode($data->contact->address); ?>
	<br />

</div>