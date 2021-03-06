<?php 
Yii::app()->clientScript->registerScript(__CLASS__.'#review-view-pending-data'.$data->Id, "
$('#linkAttachImages').click(
		function(){
			$('#optionsAttachImages').toggle('blind');
		return false;	
		}		
		);
$('#attch-left-note').click(
	function(){
		$('.review-multimedia-conteiner').toggle('blind');
	return false;	
	}		
);
		
");
?>

<div class="review-single-view" id="<?php echo $data->Id?>" >	
	<div class="view-text-date"><?php echo $data->change_date;?></div>
	<?php
	 echo CHtml::image('images/remove.png','',
			array('id'=>'delete_'.$data->Id, 'class'=>'wall-action-remove', 'title'=>'Eliminar'));
	?>
	<div class="review-text-simple-note" style="height:280px;">
		<div id='edit_main_note_<?php echo $data->Id?>' class="review-create-note-btn review-create-note-btn-main div-hidden" style="top:265px">
			Grabar
		</div>
		<div id='edit_main_note_cancel_<?php echo $data->Id?>' class="review-create-note-btn review-create-note-btn-main-cancel div-hidden" style="top:265px">
			Cancelar
		</div>
	
	<textarea id='main_note<?php echo $data->Id?>' class="wall-action-edit-main-note" placeholder='Escriba una nota...'><?php echo $data->note;?></textarea>
	<textarea id='main_original_note<?php echo $data->Id?>' class="wall-action-edit-main-note" style="display: none;" placeholder='Escriba una nota...'><?php echo $data->note;?></textarea>
	</div>		
	<?php
	echo CHtml::openTag('div',array('class'=>'view-pending-note-actions-attch'));
	echo CHtml::image('images/attch.png','',
	array('id'=>'attch-left-note', 'class'=>'view-pending-note-show-attcha', 'title'=>'Adjunto', 'style'=>'width:20px;'));				
	echo CHtml::closeTag('div');
	?>
	<div class="review-multimedia-conteiner" style="display: inline-block">
		<div id='review_image<?php echo $data->Id?>' class="review-text-images">
				
		<?php
		
		$images = array();
		$height=0;
		foreach($data->multimedias as $item)
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
													'Id'=>$data->Id,
													'height'=>$height,
			));
		}
		?>
		</div>
		<div class="review-text-docs">
			<?php 
				if(true)
				{
					echo CHtml::openTag('div', array('class'=>'review-add-images-container'));
						echo CHtml::link('Adjuntar Imagenes',"#",
								array('class'=>'review-text-docs','id'=>'linkAttachImages')
						);
						echo CHtml::openTag('div',array('id'=>'optionsAttachImages','style'=>'margin-left:10px;display:none; margin-bottom:10px;'));
						echo CHtml::openTag('br');
						echo CHtml::link('Subir nuevas imagenes',
								ReviewController::createUrl('uploadImages',array('id'=>$data->review->Id, 'idNote'=>$data->Id)),
								array('class'=>'review-text-docs')
						);
						echo CHtml::openTag('br');
						echo CHtml::link('Imagenes existentes',
								ReviewController::createUrl('AjaxattachImage',array('id'=>$data->review->Id, 'idNote'=>$data->Id)),
								array('class'=>'review-text-docs')
						);
					echo CHtml::closeTag('div');
				}
				foreach($data->multimedias as $item)
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
				echo CHtml::openTag('div', array('class'=>'review-add-docs-container'));				
				echo CHtml::link('Adjuntar Documentos',
					ReviewController::createUrl('AjaxAttachDoc',array('id'=>$data->review->Id, 'idNote'=>$data->Id)),
					array('class'=>'review-text-docs'));
				echo CHtml::closeTag('div');
					
			?>
		</div>
		<?php if (User::useTechnicalDocs()):?>
		<div class="review-text-docs">
		<?php
		
			foreach($data->multimedias as $item)
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
			
				echo CHtml::link(
				CHtml::encode($item->documentType->name),
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
			echo CHtml::openTag('div', array('class'=>'review-add-docs-container'));
			echo CHtml::link('Adjuntar Documentos Tecnicos',
					ReviewController::createUrl('AjaxAttachTechDoc',array('id'=>$data->review->Id, 'idNote'=>$data->Id)),
						array('class'=>'review-text-docs'));			
			echo CHtml::closeTag('div');
		?>
		</div>
		<?php endif;?>		
	</div>
	</div>
		<?php
			echo CHtml::openTag('div', array('id'=>'publicArea_'.$data->Id, 'class'=>'review-public-permission-area'));
			
			echo CHtml::openTag('div', array('class'=>'review-action-permissions-box-btn'));
			echo CHtml::openTag('div', array('id'=>'public_'.$data->Id,'class'=>'review-action-btn'));
			echo "Publicar";
			echo CHtml::closeTag('div');
			echo CHtml::closeTag('div');
			echo CHtml::closeTag('div');
				
		?>


