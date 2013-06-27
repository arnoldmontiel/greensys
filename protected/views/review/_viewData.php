<?php
Yii::app()->clientScript->registerScript(__CLASS__.'#review-view-data'.$data->Id, "
$('#linkAttachImages').click(
		function(){
			$('#optionsAttachImages').toggle('blind');
		return false;	
		}		
		)
$('#attch-left-note').click(
	function(){
		$('.review-multimedia-conteiner').toggle('blind');
	return false;	
	}		
)		
		");
$canDoFeeback = $dataUserGroupNote->can_feedback;
$needConfirmation = $dataUserGroupNote->need_confirmation;
$confirmed = $dataUserGroupNote->confirmed;
$declined = $dataUserGroupNote->declined;
$isAdministrator = User::isAdministartor();
$isOwner = User::isOwnerOf($data);
$editable = $isAdministrator||$isOwner;


?>

<div class="review-single-view" id="<?php echo $data->Id?>" >
	<div class="view-text-date" style="display:none;"><?php echo $data->change_date;?></div>
	<?php if($isOwner):?>
	<div id='edit_image<?php echo $data->Id?>' class="review-edit-image div-hidden" style="display:none;">	
	<?php
		echo CHtml::link('Editar Imagenes',
			ReviewController::createUrl('selectAttach',array('id'=>$data->review->Id, 'idNote'=>$data->Id)),
			array('class'=>'review-edit-image')
		);
	?>
	</div>
	<?php
	 echo CHtml::image('images/remove.png','',
			array('id'=>'delete_'.$data->Id, 'class'=>'wall-action-remove',"style"=>"display:none;", 'title'=>'Eliminar'));
	?>
	<?php endif;?>
	<div class="review-simple-note-container" style="display:none;">
	<div class="review-text-simple-note">
		<div class="review-single-view-actions">
			<div class="review-single-view-autor">
				<?php
				echo CHtml::encode($data->user->name.' '.$data->user->last_name);								
				?>
			</div>
			<?php
			echo CHtml::openTag('div',array('class'=>'view-text-note-actions'));
			if($isOwner)
			{
				echo CHtml::image('images/attach_more.png','',
				array('id'=>'attch-left-note', 'class'=>'action-show-hide-attch', 'title'=>'Adjunto', 'style'=>'width:16px;'));				
			}
			elseif(count($data->multimedias)>0)
			{
				echo CHtml::image('images/attch.png','',
				array('id'=>'attch-left-note', 'class'=>'action-show-hide-attch', 'title'=>'Adjunto', 'style'=>'width:25px;'));
			}					
			echo CHtml::closeTag('div');
			?>
		
		</div>
		<div class="review-single-view-actions" style="padding-top: 0px;">
			<div class="review-single-view-actions-need-conf">
				<?php
				echo CHtml::openTag('div',array('class'=>'review-note-users-groups'));								
					echo CHtml::decode('Para: ');
				echo CHtml::closeTag('div');								
				$first = true;
				foreach ($data->userGroupNotes as $item){
					//si esta en userGroupNote es que lo puede ver (segun la grilla de permisos de formularios)
					//if($item->addressed){ 
						if(!$first)
						{
							echo CHtml::openTag('div',array('class'=>'review-note-users-groups'));								
								echo CHtml::encode(',');								
							echo CHtml::closeTag('div');								
						}
						$first = false;							
						$group = User::getCurrentUserGroup();
						if($item->Id_user_group==$group->Id)
						{
							$user=User::getCurrentUser();
							
							echo CHtml::openTag('div',array('class'=>'review-note-users-names'));								
								echo CHtml::encode($user->name.' '.$user->last_name);								
							echo CHtml::closeTag('div');								
						}
						else 
						{
							echo CHtml::openTag('div',array('class'=>'review-note-users-groups'));								
								echo CHtml::encode(' '.$item->userGroup->description);								
							echo CHtml::closeTag('div');								
						}
					//}
				}
				?>
			</div>
			<div class="review-single-view-actions-conf">
				<?php 	 		
		 		if($needConfirmation)
		 		{
		 			if($confirmed || $declined)
		 			{
		 				$color = 'background-color:';
		 				$color.=($confirmed)?'#80e765;color:black;':'#ed5656;color:black;';
		 				echo CHtml::openTag('div',
		 					array(
		 						'class'=>'review-confirmed-note-btn review-confirm-note-btn-pos',
		 						'style'=>$color,
		 					)
		 				);
		 				echo ($confirmed)?'Confirmardo':'Rechazado';
		 				echo CHtml::closeTag('div');	 				
		 				echo CHtml::openTag('div',array('class'=>'review-conf-note-pos'));
		 				echo '('. $dataUserGroupNote->getConfirmDate() .')';
		 				echo CHtml::closeTag('div');
		 			}
		 			else 
		 			{
		 				$outOfDate = isset($dataUserGroupNote)?$dataUserGroupNote->isOutOfDate():false;
		 				if($outOfDate)
		 				{
		 					echo CHtml::openTag('div',
		 						array(
 							 			'class'=>'review-confirmed-note-btn review-confirm-note-btn-pos',
 							 			'style'=>'background-color:#80e765;color:black;',
		 							)
		 						);
		 					echo 'Auto Conf';
		 					echo CHtml::closeTag('div');
		 					echo CHtml::openTag('div',array('class'=>'review-conf-note-pos'));
		 					echo '('. $dataUserGroupNote->getDueDate() .')';
		 					echo CHtml::closeTag('div');
		 					
		 				}
		 				else 
		 				{
			 				echo CHtml::openTag('div',array('class'=>'review-confirm-note-btn review-confirm-note-btn-pos','id'=>'confirm_note_'.$data->Id));
			 				echo 'Confirmar';
			 				echo CHtml::closeTag('div');
			 				echo CHtml::openTag('div',array('class'=>'review-decline-note-btn review-decline-note-btn-pos','id'=>'decline_note_'.$data->Id));
			 				echo 'Rechazar';
			 				echo CHtml::closeTag('div');
		 				}
		 			}
		 		}
		 	?>
			</div>
		</div>
		<div id='edit_main_note_<?php echo $data->Id?>' class="review-create-note-btn review-create-note-btn-main div-hidden">
			Grabar
		</div>
		<div id='edit_main_note_cancel_<?php echo $data->Id?>' class="review-create-note-btn review-create-note-btn-main-cancel div-hidden">
			Cancelar
		</div>
		<?php if($isOwner):?>
			<textarea id='main_note<?php echo $data->Id?>' class="wall-action-edit-main-note" placeholder='Escriba una nota...'><?php echo $data->note;?></textarea>
			<textarea id='main_original_note<?php echo $data->Id?>' class="wall-action-edit-main-note" style="display: none;" placeholder='Escriba una nota...'><?php echo $data->note;?></textarea>
		<?php else:?>
			<div class="wall-action-edit-main-note" >
			<p class="single-formated-text"><?php echo $data->note;?></p>
			</div>
		<?php endif;?>
		
	</div>		
	<div class="review-multimedia-conteiner">
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
			if(sizeof($images)==0)
			{
				echo CHtml::openTag('div', array('class'=>'review-add-images-container'));
				if($isOwner){
					echo CHtml::link('Adjuntar Imagenes',"#",
						array('class'=>'review-text-docs','id'=>'linkAttachImages')
					);
					echo CHtml::openTag('div',array('id'=>'optionsAttachImages','style'=>'margin-left:10px;display:none;'));
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
			if($isOwner){
				echo CHtml::link('Adjuntar Documentos',
					ReviewController::createUrl('AjaxAttachDoc',array('id'=>$data->review->Id, 'idNote'=>$data->Id)),
					array('class'=>'review-text-docs'));
			}
			echo CHtml::closeTag('div');
				
		?>
	
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
		echo CHtml::openTag('div', array('class'=>'review-add-docs-container'));
		if($isOwner && User::useTechnicalDocs()){
			echo CHtml::link('Adjuntar Documentos Tecnicos',
				ReviewController::createUrl('AjaxAttachTechDoc',array('id'=>$data->review->Id, 'idNote'=>$data->Id)),
					array('class'=>'review-text-docs'));
		}
		echo CHtml::closeTag('div');
	?>
	</div>
	</div>
	
	</div>
	</div>
	<div class="singles-notes-confirmations" style="display:none;">
		<?php if ($needConfirmation):?>
		<div class="singles-notes-confirmations-title">
			<?php 
			echo CHtml::encode("Estado de confirmaciones:");
			?>
		</div>
		<div class="singles-notes-confirmations-row">
			<?php 
				$criteria=new CDbCriteria;
				
				$criteria->addCondition('t.Id_user_group <> '. User::getCurrentUserGroup()->Id);
				$criteria->addCondition('t.Id_note = '. $data->Id);
				$criteria->addCondition('t.need_confirmation = 1');
				
				$modelUserGroupNote = UserGroupNote::model()->findAll($criteria);
				echo CHtml::openTag('div',array('class'=>'status-permission-row'));
				foreach ($modelUserGroupNote as $item)
				{
					$outOfDate = isset($item)?$item->isOutOfDate():false;
					
					echo CHtml::openTag('div',array('class'=>'review-permission-row'));
						echo CHtml::openTag('div',array('class'=>'status-permission-title'));
						echo $item->userGroup->description.":";					
						echo CHtml::closeTag('div');
						$text = "";
						$color = 'background-color:';
						$date = "";
						if($item->confirmed)
						{
							$text = CHtml::encode("Confirmado");
							$color.='#80e765;color:black;';
							$date = '('. $item->getConfirmDate() .')';
						}
						else if($item->declined)
						{
							$text = CHtml::encode("Declinado");						
							$color.='#ed5656;color:black;';
							$date = '('. $item->getConfirmDate() .')';
						}
						else if($outOfDate)
						{
							$text = CHtml::encode("Auto Conf");
							$color.='#80e765;color:black;';
							$date = '('. $item->getDueDate() .')';
						}
						else
						{
							$text = CHtml::encode("Pendiente");						
							$color.='#AFBAD7;color:black;';
						}
						echo CHtml::openTag('div',array('class'=>'status-permission-data','style'=>$color));
						echo $text;
						echo CHtml::closeTag('div');
						
						echo CHtml::openTag('div',array('class'=>'status-permission-date'));
							echo $date;
						echo CHtml::closeTag('div');
						
					echo CHtml::closeTag('div');
				}
				echo CHtml::closeTag('div');
			?>
		</div>
		<?php endif;?>		
	</div>
	<div id="singleNoteContainer" class="singles-notes-container">
	<?php $notes=$data->notes;
		array_unshift($notes,$data);
	?>	
	<?php if (!empty($notes)):?>
		<?php
		$noNotes= true;
		foreach($notes as $item)
		{			
			if($item->in_progress && $item->username==User::getCurrentUser()->username)
			{
				$noNotes = false;
				$this->renderPartial('_viewMiniNoteInProgress',array('modelMiniNote'=>$item,'modelMainNote'=>$data));
			}
			elseif(!$item->in_progress)
			{
				$noNotes = false;
				$this->renderPartial('_viewMiniNote',array('modelMiniNote'=>$item,'modelMainNote'=>$data));				
			}
		}
		if($noNotes)
		{
			echo CHtml::openTag('div',array('class'=>'view-text-note div-hidden'));
			echo CHtml::closeTag('div');	
		}
		?>
	<?php else:?>
		<?php 
		echo CHtml::openTag('div',array('class'=>'view-text-note div-hidden'));
		echo CHtml::closeTag('div');
		?>		
	<?php endif?>
	</div>
	<?php if($canDoFeeback):?>
	<div class="review-text-note-add" id="mini_note_container_<?php echo $data->Id?>">
				
		<textarea id="note_<?php echo $data->Id?>" tabindex="-1" class="review-action-add-note-holder" placeholder='Escriba una nota...'></textarea>
	</div>
		<?php endif;?>
</div>


