<?php
Yii::app()->clientScript->registerScript('UploadImages', "

$('#btnReady').click(function(){
	window.location = '".ProductController::createUrl('index')."';
		return false;
});

");
?>


<?php
$this->widget('ext.xupload.XUploadWidget', array(
                    'url' => ProductController::createUrl('ajaxUploadImage'),
					'multiple'=>true,
					'name'=>'file',
					'fromGreen'=>true, 
					'options' => array(
						'acceptFileTypes' => '/(\.|\/)(gif|jpeg|png)$/i',
						'onComplete' => 'js:function (event, files, index, xhr, handler, callBack) {

							id = jQuery.parseJSON(xhr.response).id;
							$tr = $(document).find("#"+id);
							$tr.find(".file_upload_cancel button").click(function(){
								var target = $(this);
											
								$.get("'.ProductController::createUrl('ajaxRemoveImage').'",
 									{
										IdMultimedia:$(target).parent().parent().attr("id")
 								}).success(
 									function(data) 
 									{
 										
 										$(target).parent().parent().attr("style","display:none");	
 									}
 								);
                         		
 							});
 							
 							$tr.find("#photo_description").change(function(){
								var target = $(this);
								
								$.get("'.ProductController::createUrl('ajaxAddImageDescription').'",
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
	<?php echo CHtml::button('Listo',array('class'=>'wall-action-submit-btn','id'=>'btnReady',));?>
</div>