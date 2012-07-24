<div class="view">
	<div class="view-left">

		<b><?php echo CHtml::encode($data->getAttributeLabel('project')); ?>:</b>
		<?php echo CHtml::encode($data->budget->project->description); ?>
		<br />
		<b><?php echo CHtml::encode($data->product->getAttributeLabel('code')); ?>:</b>
		<?php echo CHtml::encode($data->product->code); ?>
		<br />
		<b><?php echo CHtml::encode('Description'); ?>:</b>
		<?php echo CHtml::encode($data->product->description_customer); ?>
		<br />
	</div>
	<div class="view-right">
		<b><?php echo CHtml::encode($data->getAttributeLabel('version_number')); ?>:</b>
		<?php echo CHtml::encode($data->version_number); ?>
		<br />
		<b><?php echo CHtml::encode($data->budget->getAttributeLabel('Id_budget_state')); ?>:</b>
		<?php echo CHtml::encode($data->budget->budgetState->description); ?>
		<br />
	</div>
	
</div>