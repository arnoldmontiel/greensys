<?php

$cs = Yii::app()->getClientScript();
$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/highslide-with-gallery.js',CClientScript::POS_HEAD);
$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/highslide-exe.js',CClientScript::POS_HEAD);
$cs->registerCssFile(Yii::app()->request->baseUrl.'/js/highslide.css');

$this->breadcrumbs=array(
	'Products'=>array('index'),
	$model->code,
);

$this->menu=array(
	array('label'=>'List Product', 'url'=>array('index')),
	array('label'=>'Create Product', 'url'=>array('create')),
	array('label'=>'Update Product', 'url'=>array('update', 'id'=>$model->Id)),
	array('label'=>'Update Resources', 'url'=>array('updateMultimedia', 'id'=>$model->Id)),
	array('label'=>'Delete Product', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->Id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Product', 'url'=>array('admin')),
	array('label'=>'Assign Groups', 'url'=>array('productGroup','Product'=>array('Id'=>$model->Id))),
	array('label'=>'Assign Requirements', 'url'=>array('productRequirement','Product'=>array('Id'=>$model->Id))),
	array('label'=>'Import From Excel', 'url'=>array('importFromExcel')),
);
?>
<h1>View Product <?php
if(isset($model->multimedia)) 
	echo CHtml::image('images/'.$model->multimedia->file_name,'',array('style'=>'width:30px;height:30px') ); 
?>
</h1> 

<div class="left">

<?php
$settings = new Settings();
$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'cssFile'=>Yii::app()->baseUrl . '/css/detail-view-blue.css',	
	'attributes'=>array(
		'code',
		'model',
		'code_supplier',
		array('label'=>$model->getAttributeLabel('Id_supplier'),
					'type'=>'raw',
					'value'=>$model->supplier->business_name
		),
		array('label'=>$model->getAttributeLabel('Id_brand'),
			'type'=>'raw',
			'value'=>$model->brand->description
		),
		array('label'=>$model->getAttributeLabel('Id_category'),
			'type'=>'raw',
			'value'=>$model->category->description
		),
		array('label'=>$model->getAttributeLabel('Id_sub_category'),
			'type'=>'raw',
			'value'=>$model->subCategory->description
		),
		array('label'=>$model->getAttributeLabel('Id_product_type'),
			'type'=>'raw',
			'value'=>$model->productType->description
		),
		array('label'=>$model->getAttributeLabel('Id_nomenclator'),
			'type'=>'raw',
			'value'=>$model->nomenclator->description
		),
		'model',
		'vendor',
		'description_customer',
		'description_supplier',
		array('label'=>$model->getAttributeLabel('discontinued'),
			'type'=>'raw',
			'value'=>CHtml::checkBox("discontinued",$model->discontinued,array("disabled"=>"disabled"))
		),
		array('label'=>$model->getAttributeLabel('length'),
			'type'=>'raw',
			'value'=>$model->length.' '.$model->measurementUnitLinear->short_description
		),
		array('label'=>$model->getAttributeLabel('width'),
			'type'=>'raw',
			'value'=>$model->width.' '.$model->measurementUnitLinear->short_description
		),
		array('label'=>$model->getAttributeLabel('height'),
			'type'=>'raw',
			'value'=>$model->height.' '.$model->measurementUnitLinear->short_description
		),
		array('label'=>$model->getAttributeLabel('volume'),
			'type'=>'raw',
			'value'=>$model->getVolume().' '.$settings->getMUShortDescription(Settings::MT_VOLUME)
		),
		array('label'=>$model->getAttributeLabel('weight'),
			'type'=>'raw',
			'value'=>$model->weight.' '.$model->measurementUnitWeight->short_description
		),
		array('label'=>$model->getAttributeLabel('dealer_cost'),
			'type'=>'raw',
			'value'=>$model->dealer_cost.' '.$settings->getCurrencyShortDescription(),
		),
		array('label'=>$model->getAttributeLabel('msrp'),
			'type'=>'raw',
			'value'=>$model->msrp.' '.$settings->getCurrencyShortDescription(),
		),
		array('label'=>$model->getAttributeLabel('profit_rate'),
			'type'=>'raw',
			'value'=>$model->profit_rate.' %'
		),
		'time_instalation',
		'color',
		'other',
		array('label'=>$model->getAttributeLabel('Id_volts'),
			'type'=>'raw',
			'value'=>isset($model->volts)?$model->volts->volts:'none'
		),
		array('label'=>$model->getAttributeLabel('need_rack'),
			'type'=>'raw',
			'value'=>CHtml::checkBox("need_rack",$model->need_rack,array("disabled"=>"disabled"))
		),
		'unit_rack',
		'unit_fan',
		array('label'=>$model->getAttributeLabel('hide'),
			'type'=>'raw',
			'value'=>CHtml::checkBox("hide",$model->hide,array("disabled"=>"disabled"))
		),
		'short_description',
		array('label'=>$model->getAttributeLabel('long_description'),	
			'type'=>'raw',
			'value'=>CHtml::textArea('long_description',$model->long_description,array(																				
																						'style'=>'height:100%;overflow: hidden;',
																						'readonly'=>true)),			
		),
		'part_number',
		'url',
		'tags',
		'phase',
		'accounting_item_name',
		'unit_cost_A',
		'unit_price_A',
		'unit_cost_B',
		'unit_price_B',
		'unit_cost_C',
		'unit_price_C',
		'taxable',
		'btu',
		'summarize',
		'sales_tax',
		'labor_sales_tax',
		'dispersion',
		'bulk_wire',
		array('label'=>$model->getAttributeLabel('input_terminals'),
			'type'=>'raw',
			'value'=>CHtml::textArea('input_terminals',$model->input_terminals,array(
																						'style'=>'height:100%;overflow: hidden;',
																						'readonly'=>true)),
		),
		array('label'=>$model->getAttributeLabel('input_signals'),
			'type'=>'raw',
			'value'=>CHtml::textArea('input_signals',$model->input_signals,array(
																						'style'=>'height:100%;overflow: hidden;',
																						'readonly'=>true)),
		),
		array('label'=>$model->getAttributeLabel('input_labels'),
			'type'=>'raw',
			'value'=>CHtml::textArea('input_labels',$model->input_labels,array(
																						'style'=>'height:100%;overflow: hidden;',
																						'readonly'=>true)),
		),
		
		array('label'=>$model->getAttributeLabel('output_terminals'),
			'type'=>'raw',
			'value'=>CHtml::textArea('output_terminals',$model->output_terminals,array(
																						'style'=>'height:100%;overflow: hidden;',
																						'readonly'=>true)),
		),
		array('label'=>$model->getAttributeLabel('output_signals'),
			'type'=>'raw',
			'value'=>CHtml::textArea('output_signals',$model->output_signals,array(
																						'style'=>'height:100%;overflow: hidden;',
																						'readonly'=>true)),
		),
		array('label'=>$model->getAttributeLabel('output_labels'),
			'type'=>'raw',
			'value'=>CHtml::textArea('output_labels',$model->output_labels,array(
																						'style'=>'height:100%;overflow: hidden;',
																						'readonly'=>true)),
		),
		'default_broker',
		'default_send_format',
		'shipping_box_lenght',
		'shipping_box_width',
		'shipping_box_height',
		'shipping_box_volume',
		'shipping_box_weight',
		'dimensional_weight_IATA',
		'dimensional_weight_FEDEX',
		'dimensional_weight_DHL',
		'dimensional_weight_UPS',
		'dimensional_weight_custom1',
		'dimensional_weight_custom2',
		'dimensional_weight_custom3',
		'off',
		'off_category_a',
		'off_cateogry_b',
		'off_category_c',
		'off_category_d',
		'deale_distributor_price',
		array('label'=>$model->getAttributeLabel('need_ups'),
			'type'=>'raw',
			'value'=>CHtml::checkBox("need_ups",$model->need_ups,array("disabled"=>"disabled"))
		),
		'commercial_name',
		'commercial_description',
		'accessory_a',
		'accessory_b',
		'accessory_c',
		'accessory_d',
		'attached',
	),
)); 

?>
</div>
<div class="right" style="margin-left:1px; width: 48%; ">
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
<?php 
	echo CHtml::openTag('div',array('class'=>'multimedia-container-images'));

	$images = array();
	$height=0;
	
	foreach($modelProductMultimedias as $item)
	{
		if($item->multimedia->Id_multimedia_type > 1) continue;
		
		$image= array();
		$image['image'] = "images/".$item->multimedia->file_name;
		$image['small_image'] = "images/".$item->multimedia->file_name_small;
		$image['caption'] = $item->multimedia->description;
		if($item->multimedia->height_small>$height)
		{
			$height = $item->multimedia->height_small;
		}
		$images[]=$image;
	
	}
	$this->widget('ext.highslide.highslide', array(
												'images'=>$images,
												'Id'=>$model->Id,
												'height'=>$height,
	));
	echo CHtml::closeTag('div');
 ?>
<div class="multimedia-text-docs">
		<?php
			
			foreach($modelProductMultimedias as $item)
			{
				if($item->multimedia->Id_multimedia_type < 3) continue;
				echo CHtml::openTag('div');
				
				echo CHtml::openTag('div');
				switch ( $item->multimedia->Id_multimedia_type) {
					case 4:
						echo CHtml::image('images/autocad_resource.png','',array('style'=>'width:25px;'));
						break;
					case 5:
						echo CHtml::image('images/word_resource.png','',array('style'=>'width:25px;'));
						break;
					case 6:
						echo CHtml::image('images/excel_resource.png','',array('style'=>'width:25px;'));
						break;
					case 3:
						echo CHtml::image('images/pdf_resource.png','',array('style'=>'width:25px;'));
						break;
				}
				echo CHtml::closeTag('div');

				echo CHtml::link(
					CHtml::encode($item->multimedia->file_name),
					Yii::app()->baseUrl.'/docs/'.$item->multimedia->file_name,
					array('target'=>'_blank','class'=>'multimedia-text-docs')
				);
				echo CHtml::encode(' '.round(($item->multimedia->size / 1024), 2));
				echo CHtml::encode(' (Kb) ');

				echo CHtml::openTag('div');
				echo CHtml::encode($item->multimedia->description);
				echo CHtml::closeTag('div');

				echo CHtml::closeTag('div');

			}
			
		?>
	</div>
	
</div>
<div class="footer">
	<div style="height:5%;background-color: #B7D6E7">
	<b><?php echo CHtml::encode($model->getAttributeLabel('note')); ?>:</b>
	</div>
	<?php
	$note = GNote::model()->findByAttributes(array('Id_product'=>$model->Id));
	$noteTxt = '';
	if(isset($note))
	{		
		$noteTxt = $note->note;
	}
	$this->widget('ext.richtext.jwysiwyg', array(
			'id'=>'noteContainer',	// default is class="ui-sortable" id="yw0"
			'notes'=> $noteTxt,
			'mode'=>'show'
	));
	
	?>
</div>		

