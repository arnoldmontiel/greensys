<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('content')); ?>:</b>
	<?php echo CHtml::encode($data->content); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
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

	<b><?php $this->widget('ext.highslide.highslide', array(
					'image'=>Yii::app()->urlManager->createUrl('multimedia/previewImage',array('id'=>$data->id)),
					'smallImage'=>Yii::app()->urlManager->createUrl('multimedia/previewImageSmall',array('id'=>$data->id)),	
					
	)); ?>
	<b><?php $this->widget('ext.videojs.videojs',array('model'=>$data));?>
	<br />

	
<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('type_small')); ?>:</b>
	<?php echo CHtml::encode($data->type_small); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('size_small')); ?>:</b>
	<?php echo CHtml::encode($data->size_small); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_entity_type')); ?>:</b>
	<?php echo CHtml::encode($data->id_entity_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Id_product')); ?>:</b>
	<?php echo CHtml::encode($data->Id_product); ?>
	<br />

	*/ ?>

</div>