<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('Id_project')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->project->description), array('view', 'id'=>$data->Id, 'version'=>$data->version_number)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('version_number')); ?>:</b>
	<?php echo CHtml::encode($data->version_number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Id_budget_state')); ?>:</b>
	<?php echo CHtml::encode($data->budgetState->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('date_creation')); ?>:</b>
	<?php echo CHtml::encode($data->date_creation); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('date_inicialization')); ?>:</b>
	<?php echo CHtml::encode($data->date_inicialization); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_finalization')); ?>:</b>
	<?php echo CHtml::encode($data->date_finalization); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('date_estimated_inicialization')); ?>:</b>
	<?php echo CHtml::encode($data->date_estimated_inicialization); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_estimated_finalization')); ?>:</b>
	<?php echo CHtml::encode($data->date_estimated_finalization); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('version_number')); ?>:</b>
	<?php echo CHtml::encode($data->version_number); ?>
	<br />

	*/ ?>

</div>