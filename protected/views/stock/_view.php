<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('Id_movement_type')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->movementType->description), array('view', 'id'=>$data->Id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Id_project')); ?>:</b>
	<?php echo CHtml::encode(isset($data->project)?$data->project->description:""); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('username')); ?>:</b>
	<?php echo CHtml::encode($data->username); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('creation_date')); ?>:</b>
	<?php echo CHtml::encode($data->creation_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />


</div>