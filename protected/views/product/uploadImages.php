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

</div>
  <div class="tab-pane" id="tabImagenes">
<div class="row">
<div class="col-sm-12">

<table id="files" class="table table-striped table-bordered tablaIndividual tablaUploadImagenes"><thead>
					<tr>
						<th>Imagen</th>
						<th>Marca</th>
						<th>Producto</th>
						<th class="align-right">Acciones</th>
					</tr>
					</thead><tbody>
					<tr>
					<td class="imageUploadCont">
					<img  src="images/Captura de pantalla 2012-03-04 a las 01.58.08_small.jpg" />
					</td>
					<td>RTI</td>
					<td>PDF-993</td>
					<td class="align-right file_upload_cancel">
					<button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button>
					</td>
					</tr>
					<tr>
					<td class="imageUploadCont">
					<img  src="images/Captura de pantalla 2012-03-04 a las 01.58.08_small.jpg" />
					</td>
					<td>RTI</td>
					<td>PDF-33333</td>
					<td class="align-right file_upload_cancel">
					<button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button>
					</td>
					</tr>
					</tbody></table>

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