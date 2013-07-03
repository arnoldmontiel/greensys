<?php
$browser = get_browser(null, true);

Yii::app()->clientScript->registerScript('viewImageResource', "
$('#btnBack').click(function(){
		window.location = '".ReviewController::createUrl('index',array('Id_customer'=>$Id_customer,'Id_project'=>$Id_project))."';		
		return false;
});

");
?>
	<div class="review-resources-title">
		&nbsp&nbspRecursos Multimedia - Imagenes
	</div>

<div id="resources-view" class="review-single-view">
	<?php
	echo CHtml::openTag('div',array('class'=>'review-container-album'));
		foreach($modelAlbum as $item)
		{
				
			echo CHtml::openTag('div',array('class'=>'review-container-single-album'));	
			echo CHtml::openTag('div',array('id'=>'edit_image'.$item->Id,'class'=>"review-edit-image review-edit-image-album"));
			$urlUpdateAlbum = 'updateAlbum';
			if($browser['browser']=='IE')
			{
				$urlUpdateAlbum .= 'IE';				
			}
						
			echo CHtml::link('Editar Album',
			ReviewController::createUrl($urlUpdateAlbum,array('id'=>$item->Id)),
			array('class'=>'review-edit-image')
			);
			echo CHtml::closeTag('div');
			$images = array();
			$height=0;
			foreach($item->multimedias as $multi_item)
			{
				$image= array();
				$image['image'] = "images/".$multi_item->file_name;
				$image['small_image'] = "images/".$multi_item->file_name_small;
				$image['caption'] = $multi_item->description;
				$images[]=$image;
			}
			$this->widget('ext.photoswipe.photoswipe', array(
											'images'=>$images,
											'Id'=>$item->Id
			));
						
			echo CHtml::openTag('div',array('style'=>'margin-top:10px;font-weight:bold;'));
			echo $item->title;	
			echo CHtml::closeTag('div');
			echo CHtml::openTag('p',array('class'=>'single-formated-text'));
			echo $item->description;	
			echo CHtml::closeTag('p');
			echo CHtml::closeTag('div');
		}
		echo CHtml::closeTag('div');
		?>
</div>

<div class="row" style="text-align: center;">	
	<?php echo CHtml::button('Volver',array('class'=>'wall-action-submit-btn','id'=>'btnBack',));?>
</div>

