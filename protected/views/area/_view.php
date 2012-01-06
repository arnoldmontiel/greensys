<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->description), array('view', 'id'=>$data->Id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('main')); ?>:</b>
	<?php echo CHtml::checkBox("main",CHtml::encode($data->main),array('disabled'=>'disabled')); ?>
	<br />


</div>