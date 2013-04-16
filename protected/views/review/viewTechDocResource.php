<?php
Yii::app()->clientScript->registerScript('viewDocResource', "
$('#btnBack').click(function(){
		window.location = '".ReviewController::createUrl('index',array('Id_customer'=>$Id_customer,'Id_project'=>$Id_project))."';
		return false;
});

$('.link-permission-g-drive').click(function(){	
	var id = $(this).attr('id');
	$('#table_'+id).toggle();
	return false;
});

$('.image-g-drive').click(function(){

	$('#dialogProcessing').dialog('open');
	var mainParent = $(this).parent().parent();
	var target = $(this);
	
	var shared = $(this).attr('shared');
	var id = $(this).attr('id');
	var idSplited = id.split('_');
	var username = idSplited[0];
	var idGoogle = idSplited[1];
	
	$.post('".ReviewController::createUrl('AjaxShareFile')."', 
			{
				Id_google_drive: idGoogle,
				username: username,
				shared: shared
			}	
			).success(
			function(data){				
				if(data == '1')
				{				
					if(shared == 'true'){
						$(target).attr('shared','false');
						$(target).attr('src','images/g-drive-unshared.png')
						$(target).attr('title','No Compartido');						
					}else{
						$(target).attr('shared','true');
						$(target).attr('src','images/g-drive-shared.png')
						$(target).attr('title','Compartido');
					}
					//$(mainParent).toggle();
					$('#dialogProcessing').dialog('close');
				}
				}).error(function(data){
						$('#dialogProcessing').dialog('close');
			});
});

");
?>
	
<div class="review-area-files" id="files_container">
	<div class="review-resources-title">
		Recursos Multimedias - Documentos T&eacute;cnicos
	</div>
	<div class="review-action-area-files" >
		<?php
		$currentDocTypeDesc = '';
		$isFirst = true;
		$isCurrent = true; 
		$userCustomers = UserCustomer::model()->findAllByAttributes(array('Id_project'=>$Id_project));
		foreach ($modelMultimedia as $item)
		{
			if($isFirst)
			{
				$currentDocTypeDesc = $item->documentType->name;
				$isFirst = false;
				$tab = "";
				
				echo CHtml::openTag('div',array('class'=>'review-update-single-files'));
				echo $currentDocTypeDesc;
				echo CHtml::closeTag('div');
			}
							
			if($currentDocTypeDesc != $item->documentType->name)
			{
				$currentDocTypeDesc = $item->documentType->name;
				echo CHtml::openTag('div',array('class'=>'review-update-single-files'));
				echo $currentDocTypeDesc;
				echo CHtml::closeTag('div');
				$isCurrent = true;
			}
			
			echo CHtml::openTag('div',array('id'=>'file_'.$item->Id,'class'=>'review-update-single-files'));
				if($isCurrent)
					echo CHtml::openTag('div',array('class'=>'review-tech-files-name'));					
				else
					echo CHtml::openTag('div',array('class'=>'review-tech-child-files-name'));
				
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
					echo CHtml::link(CHtml::encode($item->file_name),Yii::app()->baseUrl.'/docs/'.$item->file_name,array('target'=>'_blank'));
					echo CHtml::encode(' '.round(($item->size / 1024), 2));
					echo CHtml::encode(' (Kb) ');						
				echo CHtml::closeTag('div');
				echo CHtml::openTag('div',array('class'=>'review-tech-files-descr'));						
					echo CHtml::encode($item->description);
					echo "<p>Subido por : ". $item->username ." el ". $item->creation_date . "</p>";										
				echo CHtml::closeTag('div');
				
				if($isCurrent)
				{
					echo CHtml::openTag('div',array('class'=>'review-tech-files-permission'));
						echo CHtml::link('Permisos G-Drive','#',
						array('id'=>$item->Id_google_drive, 'class'=>'link-permission-g-drive')
						);
						echo CHtml::openTag('div',array('id'=>'table_'.$item->Id_google_drive, 'class'=>'google-permission-zone'));
						foreach($userCustomers as $modelUserCustomer)
						{
							
							echo CHtml::openTag('div',array('class'=>'google-permission-users'));						
								echo $modelUserCustomer->user->name . ' '. $modelUserCustomer->user->last_name;
							echo CHtml::closeTag('div');
							
							echo CHtml::openTag('div',array('class'=>'google-permission-status'));
								$modelPermission = PermissionGoogleDrive::model()->findByAttributes(array('username'=>$modelUserCustomer->username,
																						'Id_google_drive'=>$item->Id_google_drive));
														
								if(isset($modelPermission) || $modelUserCustomer->username == $item->username)
								{
									echo CHtml::image('images/g-drive-shared.png','',
									array('id'=>$modelUserCustomer->username.'_'.$item->Id_google_drive, 
											'class'=>'image-g-drive', 
											'title'=>'Compartido',
											'shared'=>'true',
											'style'=>'width:25px;'));
								}						
								else 
								{
									echo CHtml::image('images/g-drive-unshared.png','',
									array('id'=>$modelUserCustomer->username.'_'.$item->Id_google_drive, 
											'class'=>'image-g-drive', 
											'title'=>'No Compartido',
											'shared'=>'false', 
											'style'=>'width:25px;'));
								}						
							echo CHtml::closeTag('div');
						}
						echo CHtml::closeTag('div');
					echo CHtml::closeTag('div');
				}				
			echo CHtml::closeTag('div');
			$isCurrent = false;
		}
		?>
	</div>
</div>
<div class="row" style="text-align: center;">	
	<?php echo CHtml::button('Volver',array('class'=>'wall-action-submit-btn','id'=>'btnBack',));?>
</div>
<?php
$this->widget('ext.processingDialog.processingDialog', array(
		'idDialog'=>'dialogProcessing',
));
?>
