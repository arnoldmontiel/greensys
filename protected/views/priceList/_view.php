<div class="view">
	<b><?php echo CHtml::encode($data->getAttributeLabel('supplier')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->supplier->business_name), array('view', 'id'=>$data->Id)); ?>
	<br />
	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_creation')); ?>:</b>
	<?php echo CHtml::encode($data->date_creation); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_validity')); ?>:</b>
	<?php echo CHtml::encode($data->date_validity); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('validity')); ?>:</b>
	<?php echo CHtml::checkBox("validity",CHtml::encode($data->validity),array('disabled'=>'disabled')); ?>
	<br />

</div>