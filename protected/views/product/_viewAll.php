<div class="view">
	
		<b><?php echo CHtml::encode($data->getAttributeLabel('Id')); ?>:</b>
		<?php echo CHtml::link(CHtml::encode($data->Id), array('view', 'id'=>$data->Id)); ?>
		<br />
	
		<b><?php echo CHtml::encode($data->getAttributeLabel('id_brand')); ?>:</b>
		<?php echo CHtml::encode($data->brand->description); ?>
		<br />

		<b><?php echo CHtml::encode($data->getAttributeLabel('Id_supplier')); ?>:</b>
		<?php echo CHtml::encode($data->supplier->business_name); ?>
		<br />
	
		<b><?php echo CHtml::encode($data->getAttributeLabel('Id_category')); ?>:</b>
		<?php echo CHtml::encode($data->category->description); ?>
		<br />
	
		<b><?php echo CHtml::encode($data->getAttributeLabel('Id_nomenclator')); ?>:</b>
		<?php echo CHtml::encode($data->nomenclator->description); ?>
		<br />
	
		<b><?php echo CHtml::encode($data->getAttributeLabel('description_customer')); ?>:</b>
		<?php echo CHtml::encode($data->description_customer); ?>
		<br />
	
		<b><?php echo CHtml::encode($data->getAttributeLabel('description_supplier')); ?>:</b>
		<?php echo CHtml::encode($data->description_supplier); ?>
		<br />
	
		<b><?php echo CHtml::encode($data->getAttributeLabel('code')); ?>:</b>
		<?php echo CHtml::encode($data->code); ?>
		<br />
	
		<b><?php echo CHtml::encode($data->getAttributeLabel('code_supplier')); ?>:</b>
		<?php echo CHtml::encode($data->code_supplier); ?>
		<br />
	
		<b><?php echo CHtml::encode($data->getAttributeLabel('discontinued')); ?>:</b>
		<?php echo CHtml::encode($data->discontinued); ?>
		<br />
	
		<b><?php echo CHtml::encode($data->getAttributeLabel('length')); ?>:</b>
		<?php echo CHtml::encode($data->length); ?>
		<br />
	
		<b><?php echo CHtml::encode($data->getAttributeLabel('width')); ?>:</b>
		<?php echo CHtml::encode($data->width); ?>
		<br />
	
		<b><?php echo CHtml::encode($data->getAttributeLabel('height')); ?>:</b>
		<?php echo CHtml::encode($data->height); ?>
		<br />
	
		
</div>