<?php
Yii::app()->clientScript->registerScript('AttachImage', "

$('#btnCancel').click(function(){
		window.location = '".ReviewController::createUrl('update',array('id'=>$model->Id))."';
		return false;
});

$('#btnPublic').click(function(){
	window.location = '".ReviewController::createUrl('update',array('id'=>$model->Id))."';
		return false;
});

$('#chkAll').change(function(){
		if($(this).is(':checked'))
			$('#images').find('input:checkbox').attr('checked',true);
		else
			$('#images').find('input:checkbox').attr('checked',false);
		
});

");
?>


<?php
$this->widget('ext.xupload.XUploadWidget', array(
                    'url' => AlbumController::createUrl('album/AjaxUploadToNote',array('idAlbum'=>$modelAlbum->Id,'idCustomer'=>$modelAlbum->Id_customer,'idProject'=>$modelAlbum->Id_project, 'idNote'=>$idNote)),
					'multiple'=>true,
					'name'=>'file',
					'options' => array(
						'acceptFileTypes' => '/(\.|\/)(gif|jpeg|png)$/i',
						'onComplete' => 'js:function (event, files, index, xhr, handler, callBack) {

							id = jQuery.parseJSON(xhr.response).id;
							$tr = $(document).find("#"+id);
							$tr.find(".file_upload_cancel button").click(function(){
								var target = $(this);
											
								$.get("'.AlbumController::createUrl('album/AjaxRemoveImageFromNote').'",
 									{
										IdMultimedia:$(target).parent().parent().attr("id"),
										IdNote:'.$idNote.'
 								}).success(
 									function(data) 
 									{
 										
 										$(target).parent().parent().attr("style","display:none");	
 									}
 								);
                         		
 							});
 							
 							$tr.find("#photo_description").change(function(){
								var target = $(this);
								
								$.get("'.AlbumController::createUrl('album/AjaxAddImageDescription').'",
 									{
										IdMultimedia:$(target).parent().parent().attr("id"),
										description:$(this).val()
 								}).success(
 									function(data) 
 									{
 										
 									}
 								);
                         		
 							});
                         }'
					),
));
?>


<div class="row" style="text-align: center;">
	<?php echo CHtml::button('Aceptar',array('class'=>'wall-action-submit-btn','id'=>'btnPublic',));?>
	<?php echo CHtml::button('Cancelar',array('class'=>'wall-action-submit-btn','id'=>'btnCancel',));?>
</div>