<div class="view">
	<div class="left">

		<b><?php echo CHtml::encode($model->getAttributeLabel('name')); ?>:</b>
		<?php echo CHtml::encode($model->person->name); ?>
		<br />
		<b><?php echo CHtml::encode($model->getAttributeLabel('last_name')); ?>:</b>
		<?php echo CHtml::encode($model->person->last_name); ?>
		<br />
		<b><?php echo CHtml::encode($model->getAttributeLabel('date_birth')); ?>:</b>
		<?php echo CHtml::encode($model->person->date_birth); ?>
		<br />
		<b><?php echo CHtml::encode($model->getAttributeLabel('uid')); ?>:</b>
		<?php echo CHtml::encode($model->person->uid); ?>
		<br />
	</div>
	<div class="right">
		<b><?php echo CHtml::encode($model->getAttributeLabel('description')); ?>:</b>
		<?php echo CHtml::encode($model->contact->description); ?>
		<br />
		<b><?php echo CHtml::encode($model->getAttributeLabel('telephone_1')); ?>:</b>
		<?php echo CHtml::encode($model->contact->telephone_1); ?>
		<br />
		<b><?php echo CHtml::encode($model->getAttributeLabel('telephone_2')); ?>:</b>
		<?php echo CHtml::encode($model->contact->telephone_2); ?>
		<br />
		<b><?php echo CHtml::encode($model->getAttributeLabel('telephone_3')); ?>:</b>
		<?php echo CHtml::encode($model->contact->telephone_3); ?>
		<br />
		<b><?php echo CHtml::encode($model->getAttributeLabel('email')); ?>:</b>
		<?php echo CHtml::encode($model->contact->email); ?>
		<br />
		<b><?php echo CHtml::encode($model->getAttributeLabel('address')); ?>:</b>
		<?php echo CHtml::encode($model->contact->address); ?>
		<br />
	</div>
</div>