<?php
$multimediasCount = count($modelMiniNote->multimedias);
$isOwner = User::isOwnerOf($modelMiniNote);

echo CHtml::openTag('div',array('class'=>'view-text-note'));
	echo CHtml::openTag('div',array('class'=>'view-text-user'));
		echo $modelMiniNote->creation_date . ' - ' . CHtml::encode($modelMiniNote->user->name.' '.$modelMiniNote->user->last_name);
	echo CHtml::closeTag('div');
	echo CHtml::openTag('div',array('class'=>'view-text-date'));
		if($multimediasCount > 0 || $isOwner)
		{
			echo CHtml::image('images/attch.png','',
			array('id'=>'attch-left-note_'.$modelMiniNote->Id.'_'.$modelMainNote->Id, 'class'=>'action-show-hide-attch', 'title'=>'Adjunto', 'style'=>'width:25px;'));
		}					
	echo CHtml::closeTag('div');
	if($isOwner)
	{
		echo CHtml::image('images/remove.png','',
		array('id'=>'left-note_'.$modelMiniNote->Id.'_'.$modelMainNote->Id, 'class'=>'wall-action-remove-small','title'=>'Eliminar'));						
	}
	echo CHtml::openTag('div',array('class'=>'mini-note-attch-zone'));
		
		if($isOwner)
		{
			echo CHtml::openTag('div',array('class'=>'mini-note-attch-link'));
			echo CHtml::link('Adjuntar Documentos',
				ReviewController::createUrl('AjaxAttachDoc',array('id'=>$modelMainNote->review->Id, 'idNote'=>$modelMiniNote->Id)),
				array('class'=>'review-text-docs'));
			echo " - ";
			echo CHtml::link('Adjuntar Imagenes',
				ReviewController::createUrl('AjaxAttachImage',array('id'=>$modelMainNote->review->Id, 'idNote'=>$modelMiniNote->Id)),
				array('class'=>'review-text-docs'));
			if(User::useTechnicalDocs()){
				echo " - ";
				echo CHtml::link('Adjuntar Documentos Tecnicos',
				ReviewController::createUrl('AjaxAttachTechDoc',array('id'=>$modelMainNote->review->Id, 'idNote'=>$modelMiniNote->Id)),
				array('class'=>'review-text-docs'));
			}
			echo CHtml::closeTag('div');
		}
		
		/***************************IMAGEN*********************************************/
		echo CHtml::openTag('div',array('class'=>'mini-note-images'));
		$images = array();
		$height=0;
		foreach($modelMiniNote->multimedias as $item)
		{
			if($item->Id_multimedia_type!=1) continue;
			$image= array();
			$image['image'] = "images/".$item->file_name;
			$image['small_image'] = "images/".$item->file_name_small;
			$image['caption'] = $item->description;
			if($item->height_small>$height)
			{
				$height = $item->height_small;
			}
			$images[]=$image;
		}
		if(sizeof($images)>0)
		{
			$this->widget('ext.highslide.highslide', array(
														'images'=>$images,
														'Id'=>$modelMiniNote->Id,
														'height'=>$height,
			));
		}
		echo CHtml::closeTag('div');
		/***************************DOCUMENT*********************************************/
		echo CHtml::openTag('div',array('class'=>'mini-note-docs'));
		foreach($modelMiniNote->multimedias as $item)
		{
			if($item->Id_multimedia_type < 3 || $item->Id_document_type != null) continue;
			echo CHtml::openTag('div');
			
			echo CHtml::openTag('div',array('class'=>'index-review-single-resource'));
			switch ( $item->Id_multimedia_type) {
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
				CHtml::encode($item->file_name),
				Yii::app()->baseUrl.'/docs/'.$item->file_name,
				array('target'=>'_blank','class'=>'review-text-docs')
			);
			echo CHtml::encode(' '.round(($item->size / 1024), 2));
			echo CHtml::encode(' (Kb) ');
			
			echo CHtml::openTag('div',array('class'=>'review-area-single-files-description'));
			echo CHtml::encode($item->description);
			echo CHtml::closeTag('div');
			
			echo CHtml::closeTag('div');
				
		}
		foreach($modelMiniNote->multimedias as $item)
		{
			if($item->Id_multimedia_type < 3 || $item->Id_document_type == null) continue;
			echo CHtml::openTag('div');
		
			echo CHtml::openTag('div',array('class'=>'index-review-single-resource'));
			switch ( $item->Id_multimedia_type) {
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
				
			echo CHtml::openTag('p',array('class'=>'review-text-docs check-last-doc',
																'url'=>Yii::app()->baseUrl.'/docs/'.$item->file_name,
																'idcustomer'=>$item->Id_customer,
																'idproject'=>$item->Id_project,
																'idmultimedia'=>$item->Id, 
																'iddocType'=>$item->Id_document_type));
			echo CHtml::encode($item->documentType->name);
			echo CHtml::encode(' '.round(($item->size / 1024), 2));
			echo CHtml::encode(' (Kb) ');
			echo CHtml::closeTag('p');
				
		
			echo CHtml::openTag('div',array('class'=>'review-area-single-files-description'));
			echo CHtml::encode($item->description);
			echo CHtml::closeTag('div');
				
			echo CHtml::closeTag('div');
		
		}
		echo CHtml::closeTag('div');
	echo CHtml::closeTag('div');
	echo CHtml::openTag('p',array('class'=>'single-formated-text'));
		echo $modelMiniNote->note;
	echo CHtml::closeTag('p');
echo CHtml::closeTag('div');
?>


