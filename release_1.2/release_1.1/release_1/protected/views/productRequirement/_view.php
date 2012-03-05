<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('description_short')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->description_short), array('view', 'id'=>$data->Id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('internal')); ?>:</b>
	<?php echo CHtml::checkBox('internal',$data->internal,array('disabled'=>'disabled')); ?>	
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Id_guild')); ?>:</b>
	<?php echo CHtml::encode($data->guild->description); ?>
	<br />

</div>