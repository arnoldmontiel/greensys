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
	array('label'=>'Assign Groups', 'url'=>array('productGroup')),
	array('label'=>'Assign Requirements', 'url'=>array('productRequirement')),
);
?>
<h1>View Product</h1>

<div class="left">

<?php
$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'cssFile'=>Yii::app()->baseUrl . '/css/detail-view-blue.css',
	'attributes'=>array(
		'code',
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
		array('label'=>$model->getAttributeLabel('Id_nomenclator'),
			'type'=>'raw',
			'value'=>$model->nomenclator->description
		),
		'description_customer',
		'description_supplier',
		array('label'=>$model->getAttributeLabel('discontinued'),
			'type'=>'raw',
			'value'=>CHtml::checkBox("discontinued",$model->discontinued,array("disabled"=>"disabled"))
		),
		'length',
		'width',
		'height',
		array('label'=>$model->getAttributeLabel('Id_measurement_unit_linear'),
			'type'=>'raw',
			'value'=>$model->measurementUnitLinear->short_description
		),
		array('label'=>$model->getAttributeLabel('volume'),
			'type'=>'raw',
			'value'=>$model->getVolume()
		),
		'weight',
		array('label'=>$model->getAttributeLabel('Id_measurement_unit_weight'),
			'type'=>'raw',
			'value'=>$model->measurementUnitWeight->short_description
		),
		'profit_rate',
		'dealer_cost',
		'msrp',
		'time_instalation',
		array('label'=>$model->getAttributeLabel('hide'),
			'type'=>'raw',
			'value'=>CHtml::checkBox("hide",$model->hide,array("disabled"=>"disabled"))
		),
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
	$note = Note::model()->findByAttributes(array('Id_product'=>$model->Id));
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

