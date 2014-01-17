<script type="text/javascript">
function removeImage(idMultimedia)
{
	if (confirm("¿Está seguro de eliminar esta imagen?")) 
	{
		$.post("<?php echo ProductController::createUrl('ajaxRemoveImage'); ?>",
			{
				IdMultimedia:idMultimedia
			}
		).success(
			function(data){
				$.fn.yiiGridView.update("product-grid-images");
			});
		return false;
	}
	return false;
}
</script>
<div class="container">
<h1 class="pageTitle">Administrador de Imagenes</h1>
<ul class="nav nav-tabs">
        <li class="active"><a href="#tabUpload" data-toggle="tab">Upload</a></li>
        <li><a href="#tabImagenes" data-toggle="tab">Todas las Im&aacute;genes</a></li>
      </ul>
      <div class="tab-content">
  <div class="tab-pane active" id="tabUpload">
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
							
							$.fn.yiiGridView.update("product-grid-images");
							
							id = jQuery.parseJSON(xhr.response).id;
							$tr = $(document).find("#"+id);
							
// 							if($("#files > tbody").length > 0)
// 								$("#files").show();
							
							$tr.find(".file_upload_cancel button").click(function(){
								var target = $(this);
								if (confirm("¿Está seguro de eliminar esta imagen?")) 
								{
									$.post("'.ProductController::createUrl('ajaxRemoveImage').'",
	 									{
											IdMultimedia:$(target).parent().parent().attr("id")
	 								}).success(
	 									function(data) 
	 									{
	 										$.fn.yiiGridView.update("product-grid-images");
	 										$(target).parent().parent().attr("style","display:none");	
	 									}
	 								);
								}
								return false;
                         		
 							});
 							

                         }'
					),
));
?>

	</div>
  	<div class="tab-pane" id="tabImagenes">
		<div class="row">
			<div class="col-sm-12">
				<?php echo $this->renderPartial('_tabImages',array('modelProducts'=>$modelProducts)); ?>
			</div>
		</div>
	</div>
</div>
	
	<div class="row">
		<div class="col-sm-12">
			<?php echo CHtml::button('Listo',array('class'=>'wall-action-submit-btn','id'=>'btnReady',));?>
		</div>
	</div>

</div>