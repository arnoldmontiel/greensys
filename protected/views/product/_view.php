<div class="view">
	<div class="left">

		<b><?php echo CHtml::encode($model->getAttributeLabel('Id_brand')); ?>:</b>
		<?php echo CHtml::encode($model->brand->description); ?>
		<br />
	
		<b><?php echo CHtml::encode($model->getAttributeLabel('Id_supplier')); ?>:</b>
		<?php echo CHtml::encode($model->supplier->business_name); ?>
		<br />

		<b><?php echo CHtml::encode($model->getAttributeLabel('Id_category')); ?>:</b>
		<?php echo CHtml::encode($model->category->description); ?>
		<br />
	
		<b><?php echo CHtml::encode($model->getAttributeLabel('Id_nomenclator')); ?>:</b>
		<?php echo CHtml::encode($model->nomenclator->description); ?>
		<br />
	
		<b><?php echo CHtml::encode($model->getAttributeLabel('description_customer')); ?>:</b>
		<?php echo CHtml::encode($model->description_customer); ?>
		<br />
	
		<b><?php echo CHtml::encode($model->getAttributeLabel('description_supplier')); ?>:</b>
		<?php echo CHtml::encode($model->description_supplier); ?>
		<br />
	
		<b><?php echo CHtml::encode($model->getAttributeLabel('code')); ?>:</b>
		<?php echo CHtml::encode($model->code); ?>
		<br />
	
		<b><?php echo CHtml::encode($model->getAttributeLabel('code_supplier')); ?>:</b>
		<?php echo CHtml::encode($model->code_supplier); ?>
		<br />
	
		<b><?php echo CHtml::encode($model->getAttributeLabel('discontinued')); ?>:</b>
		<?php echo CHtml::checkBox('discontinued',$model->discontinued,array('disabled'=>'disabled')); ?>		
		<br />
	
		<b><?php echo CHtml::encode($model->getAttributeLabel('length')); ?>:</b>
		<?php echo CHtml::encode($model->length); ?>
		<br />
	
		<b><?php echo CHtml::encode($model->getAttributeLabel('width')); ?>:</b>
		<?php echo CHtml::encode($model->width); ?>
		<br />
	
		<b><?php echo CHtml::encode($model->getAttributeLabel('height')); ?>:</b>
		<?php echo CHtml::encode($model->height); ?>
		<br />

		<b><?php echo CHtml::encode($model->getAttributeLabel('weight')); ?>:</b>
		<?php echo CHtml::encode($model->weight); ?>
		<br />
	
		<b><?php echo CHtml::encode($model->getAttributeLabel('profit_rate')); ?>:</b>
		<?php echo CHtml::encode($model->profit_rate); ?>
		<br />
	
		<b><?php echo CHtml::encode($model->getAttributeLabel('msrp')); ?>:</b>
		<?php echo CHtml::encode($model->msrp); ?>
		<br />

		<b><?php echo CHtml::encode($model->getAttributeLabel('dealer_cost')); ?>:</b>
		<?php echo CHtml::encode($model->dealer_cost); ?>
		<br />
	
		<b><?php echo CHtml::encode($model->getAttributeLabel('time_instalation')); ?>:</b>
		<?php echo CHtml::encode($model->time_instalation); ?>
		<br />
	
		<b><?php echo CHtml::encode($model->getAttributeLabel('hide')); ?>:</b>
		<?php echo CHtml::checkBox('hide',$model->hide,array('disabled'=>'disabled')); ?>		
				<br />
		
	</div>
	<div class="right">
		<b><?php echo CHtml::encode($model->getAttributeLabel('link')); ?>:</b>
		<?php
		$hyperLinks = CHtml::listData(Hyperlink::model()->findAllByAttributes(array('Id_product'=>$model->Id)), 'Id','description');
		
		$this->widget('ext.linkcontainer.linkcontainer', array(
			'id'=>'linkContainer',	// default is class="ui-sortable" id="yw0"
			'items'=>$hyperLinks,
			'mode'=>'show'
		));
		?>
		<br />
		<b><?php echo CHtml::encode($model->getAttributeLabel('image')); ?>:</b>
	<?php 
		$multimedia = Multimedia::model()->findByAttributes(array('Id_product'=>$model->Id));
		$this->widget('ext.highslide.highslide', array(
								'id'=>$multimedia->Id,
		)); ?>
		
	</div>
	<br />
	<div class="footer">
		<div style="height:5%;background-color: #B7D6E7">
		<b><?php echo CHtml::encode($model->getAttributeLabel('note')); ?>:</b>
		</div>
		<?php
		$note = Note::model()->findByAttributes(array('Id_product'=>$model->Id));
	
		 $this->widget('ext.richtext.jwysiwyg', array(
	 		'id'=>'noteContainer',	// default is class="ui-sortable" id="yw0"	
	 		'notes'=> $note->note,
	 		'mode'=>'show'
	 			));
		?>
	</div>		
</div>