<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->description), array('view', 'id'=>$data->Id)); ?>
	<br />



</div>