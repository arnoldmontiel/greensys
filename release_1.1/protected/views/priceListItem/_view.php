<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('Id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->Id), array('view', 'id'=>$data->Id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Id_product')); ?>:</b>
	<?php echo CHtml::encode($data->Id_product); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Id_price_list')); ?>:</b>
	<?php echo CHtml::encode($data->Id_price_list); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cost')); ?>:</b>
	<?php echo CHtml::encode($data->cost); ?>
	<br />


</div>