<?php 
Yii::app()->clientScript->registerScript(__CLASS__.'#g-drive', "


	beginBind();
	
	function beginBind()
	{
		 bindEvents();
	}

	function bindEvents()
	{
		$('#file-browser').find('.folder-gdrive').click(function(){
			var id = $(this).attr('id');
			var text = $(this).text();
					
			$.post(
				'".AuditLoginController::createUrl('AjaxGetFiles')."',
			{
				id: id,			
				text: text,
				path: $('#hidden-path').val()			
			}).success(
				function(data)
				{
					$('#file-browser').html(data);
					bindEvents();
			});
		});
		
		$('#file-browser').find('.path-gdrive').click(function(){			
			var id = $(this).attr('id');
					
			$.post(
				'".AuditLoginController::createUrl('AjaxGetFilesFromPath')."',
			{
				id: id,
				path: $('#hidden-path').val()
			}).success(
				function(data)
				{
					$('#file-browser').html(data);
					bindEvents();
			});
		});
	}
	
	
");

?>
<div class="well well-small">
<h4>Google Drive</h4>
</div>

<div id="file-browser" class="well well-small">
<?php 
	$this->renderPartial('_gdrive',array('files'=>$files, 'path'=>$path));
?>
</div>