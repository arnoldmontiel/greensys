<div class="view">
	<div class="left">

		<b><?php echo CHtml::encode($model->getAttributeLabel('name')); ?>:</b>
		<?php echo CHtml::encode($model->person->name); ?>
		<br />
		<b><?php echo CHtml::encode($model->getAttributeLabel('last_name')); ?>:</b>
		<?php echo CHtml::encode($model->person->last_name); ?>
		<br />
		<b><?php echo CHtml::encode($model->getAttributeLabel('date_birth')); ?>:</b>
		<?php echo CHtml::encode($model->person->date_birth); ?>
		<br />
		<b><?php echo CHtml::encode($model->getAttributeLabel('uid')); ?>:</b>
		<?php echo CHtml::encode($model->person->uid); ?>
		<br />
	</div>
	<div class="right">
		<b><?php echo CHtml::encode($model->getAttributeLabel('description')); ?>:</b>
		<?php echo CHtml::encode($model->contact->description); ?>
		<br />
		<b><?php echo CHtml::encode($model->getAttributeLabel('telephone_1')); ?>:</b>
		<?php echo CHtml::encode($model->contact->telephone_1); ?>
		<br />
		<b><?php echo CHtml::encode($model->getAttributeLabel('telephone_2')); ?>:</b>
		<?php echo CHtml::encode($model->contact->telephone_2); ?>
		<br />
		<b><?php echo CHtml::encode($model->getAttributeLabel('telephone_3')); ?>:</b>
		<?php echo CHtml::encode($model->contact->telephone_3); ?>
		<br />
		<b><?php echo CHtml::encode($model->getAttributeLabel('email')); ?>:</b>
		<?php echo CHtml::encode($model->contact->email); ?>
		<br />
		<b><?php echo CHtml::encode($model->getAttributeLabel('address')); ?>:</b>
		<?php echo CHtml::encode($model->contact->address); ?>
		<br />
		<br />
		<b><?php echo CHtml::encode($model->getAttributeLabel('link')); ?>:</b>
		<?php
		$entity = EntityType::model()->findByAttributes(array('name'=>get_class($model)));
		$hyperLinks = CHtml::listData(Hyperlink::model()->findAllByAttributes(array('Id_contact'=>$model->contact->Id,'Id_entity_type'=>$entity->Id)), 'Id','description');
		
		$this->widget('ext.linkcontainer.linkcontainer', array(
			'id'=>'linkContainer',	// default is class="ui-sortable" id="yw0"
			'items'=>$hyperLinks,
			'mode'=>'show'
		));
		?>
	</div>
	<div class="footer">
		
	</div>		
</div>