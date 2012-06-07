<div class="view">
	<div class="view-left">
		<?php 
			$settings= new Settings();
			$um = $settings->getMUShortDescription(Settings::MT_LINEAR);
			$cu = $settings->getCurrencyShortDescription();
			?>
		<?php $formatter= new CFormatter;?>
	
		<b><?php echo CHtml::encode($data->getAttributeLabel('code')); ?>:</b>
		<?php echo CHtml::link(CHtml::encode($data->code), array('view', 'id'=>$data->Id)); ?>
		<br />
	
		<b><?php echo CHtml::encode($data->getAttributeLabel('code_supplier')); ?>:</b>
		<?php echo CHtml::encode($data->code_supplier); ?>
		<br />
	
		<b><?php echo CHtml::encode($data->getAttributeLabel('Id_brand')); ?>:</b>
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
		
		<b><?php echo CHtml::encode($data->getAttributeLabel('discontinued')); ?>:</b>
		<?php echo CHtml::encode($formatter->formatBoolean($data->discontinued)); ?>
		<br />
	
	</div>
	<div class="view-right">
		<b><?php echo CHtml::encode($data->getAttributeLabel('length')); ?>:</b>
		<?php echo CHtml::encode($data->length).' '.$um; ?>
		<br />
	
		<b><?php echo CHtml::encode($data->getAttributeLabel('width')); ?>:</b>
		<?php echo CHtml::encode($data->width).' '.$um; ?>
		<br />
	
		<b><?php echo CHtml::encode($data->getAttributeLabel('height')); ?>:</b>
		<?php echo CHtml::encode($data->height).' '.$um; ?>
		<br />	
		
		<b><?php echo CHtml::encode($data->getAttributeLabel('dealer_cost')); ?>:</b>
		<?php echo CHtml::encode($data->dealer_cost).' '.$cu; ?>
		<br />	
		
		<b><?php echo CHtml::encode($data->getAttributeLabel('msrp')); ?>:</b>
		<?php echo CHtml::encode($data->msrp).' '.$cu; ?>
		<br />	
		
		<b><?php echo CHtml::encode($data->getAttributeLabel('profit_rate')); ?>:</b>
		<?php echo CHtml::encode($data->profit_rate).' %'; ?>
		<br />	
		</div>		
</div>