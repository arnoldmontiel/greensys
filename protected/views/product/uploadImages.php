<div class="container">
<h1 class="pageTitle">Agregar de Imagenes</h1>
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


<div class="row">
<div class="col-sm-12">
	<?php echo CHtml::button('Listo',array('class'=>'wall-action-submit-btn','id'=>'btnReady',));?>
	
	

<table class="table table-striped table-bordered tablaIndividual tablaUploadImagenes">
<thead>
<tr>
<th id="budget-grid-open_c0"><a class="sort-link">Imagen</a></th>
<th><a class="sort-link">Marca</a></th>
<th><a class="sort-link">Producto</a></th>
<th class="align-right">Acciones</th></thead>
<tbody>
<tr class="odd">
<td style="width:25%;">Imagen</td>
<td style="width:25%;">RTI</td>
<td style="width:25%;">PNOU</td>
<td class="align-right" style="width:25%;"><button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button></td>
</tr>
</tbody>
</table>

</div>
</div>

</div>