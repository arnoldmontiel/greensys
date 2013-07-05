<?php 
Yii::app()->clientScript->registerScript(__CLASS__.'#g-drive', "
	$('.folder-gdrive').click(function(){
	
		var id = $(this).attr('id');		
		$.post(
			'".AuditLoginController::createUrl('AjaxGetFiles')."',
		{
			id: id			
		}).success(
			function(data)
			{
				$('#file-browser').html(data);
		});
	});
	
	
");

?>
<div class="well well-small">
<h4>Google Drive</h4>
</div>

<div id="file-browser" class="well well-small">
<?php 
	$this->renderPartial('_gdrive',array('response'=>$response));
?>
</div>