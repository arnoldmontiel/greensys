<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->name), array('view', 'id'=>$data->Id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('content')); ?>:</b>
	<?php echo CHtml::encode($data->content); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('type')); ?>:</b>
	<?php echo CHtml::encode($data->type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('size')); ?>:</b>
	<?php echo CHtml::encode($data->size); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('content_small')); ?>:</b>
	<?php echo CHtml::encode($data->content_small); ?>
	<br />

	<b><?php $this->widget('ext.videojs.videojs',array('model'=>$data));?></b>

	<?php $this->widget('ext.highslide.highslide', array(
						'id'=>$data->Id,
	)); ?>
	
<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('type_small')); ?>:</b>
	<?php echo CHtml::encode($data->type_small); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('size_small')); ?>:</b>
	<?php echo CHtml::encode($data->size_small); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Id_entity_type')); ?>:</b>
	<?php echo CHtml::encode($data->Id_entity_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Id_product')); ?>:</b>
	<?php echo CHtml::encode($data->Id_product); ?>
	<br />

	*/ ?>

</div>