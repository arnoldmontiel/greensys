<div class="budget-selector-view-pop">
	<div class="view-left">
		<b><?php echo CHtml::encode($data->budget->project->getAttributeLabel('customer')); ?>:</b>
		<?php echo CHtml::encode($data->budget->project->customer->person->last_name." ".$data->budget->project->customer->person->name); ?>
		<br />
		<b><?php echo CHtml::encode($data->getAttributeLabel('project')); ?>:</b>
		<?php echo CHtml::encode($data->budget->project->description); ?>
		<br />
		<b><?php echo CHtml::encode($data->getAttributeLabel('area')); ?>:</b>
		<?php echo CHtml::encode($data->area->description); ?>
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
	<div class="view-end">
		<b><?php echo CHtml::textField('BudgetItem[quantity]',$data->quantity,array('id'=>'BudgetItem_quantity','class'=>'txt-quantity','style'=>'width:30px;text-align:right;','disabled'=>'disabled')); ?></b>
		<br />
	</div>
	
</div>