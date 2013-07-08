<?php
Yii::app()->clientScript->registerScript('AttachImage', "

$('#btnUploadImage').click(function(){
		window.location = '".ReviewController::createUrl('uploadImages',array('id'=>$id, 'idNote'=>$idNote))."';
		return false;
});

$('#btnSelectImage').click(function(){
		window.location = '".ReviewController::createUrl('AjaxattachImage',array('id'=>$id, 'idNote'=>$idNote))."';
		return false;
});

$('#btnCancel').click(function(){
		window.location = '".ReviewController::createUrl('update',array('id'=>$id))."';
		return false;
});

$('#btnUploadGdriveImage').click(function(){
		window.location = '".ReviewController::createUrl('uploadGDriveImage',array('id'=>$id, 'idNote'=>$idNote))."';
		return false;
});
");
?>
 
<div style="height:200px">
	<div class="row" style="text-align: center;">
		<div class="review-action-back" id="btnUploadImage">
		Subir Imagenes
		</div>
	</div>
	<div class="row" style="text-align: center;">
		<div class="review-action-back" id="btnSelectImage">
		Imagenes ya subidas
		</div>
	</div>
	<div class="row" style="text-align: center;">
		<div class="review-action-back" id="btnUploadGdriveImage">
		Subir Imagen desde Google Drive
		</div>
	</div>	
	<div class="row" style="text-align: center;">	
		<?php echo CHtml::button('Cancelar',array('class'=>'wall-action-submit-btn','id'=>'btnCancel',));?>
	</div>
</div>
