<div class="view">
	<b><?php echo CHtml::encode($data->getAttributeLabel('Id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->Id), array('view', 'id'=>$data->Id)); ?>
	<br />
	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->person->name); ?>
	<br />
	<b><?php echo CHtml::encode($data->getAttributeLabel('last_name')); ?>:</b>
	<?php echo CHtml::encode($data->person->last_name); ?>
	<br />
	<b><?php echo CHtml::encode($data->getAttributeLabel('date_birth')); ?>:</b>
	<?php echo CHtml::encode($data->person->date_birth); ?>
	<br />
	<b><?php echo CHtml::encode($data->getAttributeLabel('uid')); ?>:</b>
	<?php echo CHtml::encode($data->person->uid); ?>
	<br />
	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->contact->description); ?>
	<br />
	<b><?php echo CHtml::encode($data->getAttributeLabel('telephone_1')); ?>:</b>
	<?php echo CHtml::encode($data->contact->telephone_1); ?>
	<br />
	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->contact->email); ?>
	<br />
</div>