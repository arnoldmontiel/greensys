<?php
/* @var $this InitCustomerController */
/* @var $data InitCustomer */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('Id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->Id), array('view', 'id'=>$data->Id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('username')); ?>:</b>
	<?php echo CHtml::encode($data->username); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Id_person')); ?>:</b>
	<?php echo CHtml::encode($data->Id_person); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Id_contact')); ?>:</b>
	<?php echo CHtml::encode($data->Id_contact); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Id_user_group')); ?>:</b>
	<?php echo CHtml::encode($data->Id_user_group); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Id_customer_type')); ?>:</b>
	<?php echo CHtml::encode($data->Id_customer_type); ?>
	<br />


</div>