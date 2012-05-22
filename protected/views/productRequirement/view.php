<?php

$cs = Yii::app()->getClientScript();
$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/highslide-with-gallery.js',CClientScript::POS_HEAD);
$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/highslide-exe.js',CClientScript::POS_HEAD);
$cs->registerCssFile(Yii::app()->request->baseUrl.'/js/highslide.css');

$this->breadcrumbs=array(
	'Product Requirements'=>array('index'),
	$model->description_short,
);

$this->menu=array(
	array('label'=>'List ProductRequirement', 'url'=>array('index')),
	array('label'=>'Create ProductRequirement', 'url'=>array('create')),
	array('label'=>'Update ProductRequirement', 'url'=>array('update', 'id'=>$model->Id)),
	array('label'=>'Update Resources', 'url'=>array('updateMultimedia', 'id'=>$model->Id)),
	array('label'=>'Delete ProductRequirement', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->Id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ProductRequirement', 'url'=>array('admin')),
);
?>

<h1>View Product Requirement</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		array(
		 			'name'=>'internal',
					'value'=>CHtml::checkBox("internal",$model->internal,array("disabled"=>"disabled")),
					'type'=>'raw',
		),
		'description_short',
		array(
		 			'name'=>'guild_description',
					'value'=>$model->guild->description,
		),
	),
)); ?>
<br>
<?php

echo CHtml::openTag('div',array('class'=>'multimedia-container-images'));

$images = array();
$height=0;

foreach($modelProductReqMultimedias as $item)
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

echo CHtml::openTag('div',array('class'=>'multimedia-container-documents'));
?>
<div class="multimedia-text-docs">
		<?php
			
			foreach($modelProductReqMultimedias as $item)
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
			echo CHtml::closeTag('div');
		?>
	</div>
<br>
	<div class="footer">
		<div style="height:5%;background-color: #B7D6E7">
		<b><?php echo CHtml::encode($model->getAttributeLabel('note')); ?>:</b>
		</div>
		<?php
	
		 $this->widget('ext.richtext.jwysiwyg', array(
	 		'id'=>'noteContainer',	// default is class="ui-sortable" id="yw0"	
	 		'notes'=> $modelNote->note,
	 		'mode'=>'show'
	 			));
		?>
	</div>		
