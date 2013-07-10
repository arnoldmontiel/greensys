<?php 
Yii::app()->clientScript->registerScript(__CLASS__.'#uploadGDriveImage', "


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
				'".ReviewController::createUrl('AjaxGetFiles')."',
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
				'".ReviewController::createUrl('AjaxGetFilesFromPath')."',
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
	
	$('#btnCancel').click(function(){
		window.location = '".ReviewController::createUrl('update',array('id'=>$model->Id))."';
		return false;
	});

	$('#btnPublic').click(function(){		
		var selectedImgs = {};
		$('#file-browser input:checked').each(
			function(i, item){
				var id = $(item).attr('id');
				var url = $(item).attr('url');
				selectedImgs[id] = url;
		});
				
		$.post(
				'".ReviewController::createUrl('AjaxGetGDriveImagen')."',
			{
				idAlbum: ".$modelAlbum->Id.",
				idCustomer: ".$modelAlbum->Id_customer.",
				idProject: ".$modelAlbum->Id_project.",
				idNote: ".$idNote.",
				selectedImgs: JSON.stringify(selectedImgs)				
			}).success(
				function(data)
				{
					alert(1);					
			});
		return false;
	});
	
	$('#chkAll').change(function(){
			if($(this).is(':checked'))
				$('#file-browser').find('input:checkbox').attr('checked',true);
			else
				$('#file-browser').find('input:checkbox').attr('checked',false);
			
	});	
	
");

?>
<div class="well well-small">
<h4>Google Drive</h4>
</div>
<?php 
echo CHtml::label('Seleccionar Todo', 'chkAll');
echo CHtml::checkBox('chkAll','',array('id'=>'chkAll'));?>
<div id="file-browser" class="well well-small">
<?php 
	$this->renderPartial('_uploadGDriveImage',array('files'=>$files, 'path'=>$path));
?>
</div>
<div class="row" style="text-align: center;">
	<?php echo CHtml::button('Aceptar',array('class'=>'wall-action-submit-btn','id'=>'btnPublic',));?>
	<?php echo CHtml::button('Cancelar',array('class'=>'wall-action-submit-btn','id'=>'btnCancel',));?>
</div>