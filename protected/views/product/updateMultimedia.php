<?php
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/highslide-with-gallery.js',CClientScript::POS_HEAD);
$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/highslide-exe.js',CClientScript::POS_HEAD);
$cs->registerCssFile(Yii::app()->request->baseUrl.'/js/highslide.css');
$this->breadcrumbs=array(
		'Product'=>array('index'),
		$model->code=>array('view', 'id'=>$model->Id),
		'Update Resources'
);
$this->menu=array(
		array('label'=>'Create Product', 'url'=>array('create')),
		array('label'=>'Manage Product', 'url'=>array('admin')),
		array('label'=>'Update Product', 'url'=>array('update', 'id'=>$model->Id)),
		array('label'=>'View Product', 'url'=>array('view', 'id'=>$model->Id)),
		array('label'=>'Assign Groups', 'url'=>array('productGroup')),
		array('label'=>'Assign Requirements', 'url'=>array('productRequirement')),
		array('label'=>'Manage Import', 'url'=>array('adminImport')),
		array('label'=>'Import From Excel', 'url'=>array('importFromExcel')),
);

Yii::app()->clientScript->registerScript('updateMultimedia-view', "


$('#images_container').find('textarea').each(
									function(index, item){
												$(item).change(function(){
													var target = $(this);
													var it = $(item);
													$.get('".ProductController::createUrl('AjaxAddMultimediaDescription')."',
					 									{
															IdMultimedia:$(target).attr('id'),
															description:$(this).val()
					 								}).success(
					 									function(data) 
					 									{
					 										
					 									}
					 								);
												});

});	

	
");
?>
<div class="resources-title">
Resources
</div>


<div class="multimedia-area-view-data">

<div class="wide form" >

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'multimedia-form-update',
	'enableAjaxValidation'=>false,
)); ?>


	<div class="multimedia-area-data"  id="images_container">
	<?php 

	foreach ($productMultimedias as $item)
	{
		echo CHtml::openTag('div',array('id'=>'picture_'.$item->multimedia->Id,'class'=>'view-attach-data'));
		echo CHtml::imageButton(
		                                'images/remove.png',
								array(
		                                'class'=>'multimedia-action-remove',
		                                'style'=>'right:10px;top:5px;z-index:10;',
										'title'=>'Delete resource',
										'id'=>'delete_'.$item->multimedia->Id,
		                                	'ajax'=> array(
												'type'=>'GET',
												'url'=>ProductController::createUrl('AjaxRemoveMultimedia',array('IdMultimedia'=>$item->multimedia->Id, 'id'=>$model->Id)),
												'beforeSend'=>'function(){
															if(!confirm("\u00BFEst\u00e1 seguro de eliminar esta imagen?")) 
																return false;
																}',
												'success'=>'js:function(data)
												{
													$("#picture_'.$item->multimedia->Id.'").attr("style","display:none");
												}'
									)
								)
		 
			);
		echo CHtml::openTag('div',array('class'=>'multimedia-update-data'));
		switch ( $item->multimedia->Id_multimedia_type) {
			case 1:
				$this->widget('ext.highslide.highslide', array(
												'smallImage'=>"images/".$item->multimedia->file_name_small,
												'image'=>"images/".$item->multimedia->file_name,
												'caption'=>'',
												'Id'=>$item->multimedia->Id,
												'small_width'=>240,
												'small_height'=>180,
				
				));
				break;
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
		
		if($item->multimedia->Id_multimedia_type > 1)
		{
			echo CHtml::link(
			CHtml::encode($item->multimedia->file_name),
			Yii::app()->baseUrl.'/docs/'.$item->multimedia->file_name,
			array('target'=>'_blank','class'=>'multimedia-text-docs')
			);
			echo CHtml::encode(' '.round(($item->multimedia->size / 1024), 2));
			echo CHtml::encode(' (Kb) ');
		}
		echo CHtml::closeTag('div');
		echo CHtml::openTag('div',array());
		echo CHtml::textArea('photo_description',$item->multimedia->description,
							array(
								'id'=>$item->multimedia->Id,
								'placeholder'=>'Escriba una description...',
								'class'=>'multimedia-update-action-descr',
							)
						
			);
		echo CHtml::closeTag('div');		
		echo CHtml::closeTag('div');
	}
	?>	
	</div>

<?php $this->endWidget(); ?>

<?php
$this->widget('ext.xupload.XUploadWidget', array(
                    'url' => ProductController::createUrl('AjaxUpload',array('id'=>$model->Id)),
					'multiple'=>true,
					'name'=>'file',
					'options' => array(
						'acceptFileTypes' => '/(\.|\/)(gif|jpeg|png)$/i',
						'onComplete' => 'js:function (event, files, index, xhr, handler, callBack) {

							id = jQuery.parseJSON(xhr.response).id;
							$tr = $(document).find("#"+id);
							$tr.find(".file_upload_cancel button").click(function(){
								var target = $(this);
											
								$.get("'.ProductController::createUrl('AjaxRemoveMultimedia').'",
 									{
										IdMultimedia:$(target).parent().parent().attr("id"),
										id: '.$model->Id.'
 								}).success(
 									function(data) 
 									{
 										
 										$(target).parent().parent().attr("style","display:none");	
 									}
 								);
                         		
 							});
 							
 							$tr.find("#photo_description").change(function(){
								var target = $(this);
								
								$.get("'.ProductController::createUrl('AjaxAddMultimediaDescription').'",
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
			<?php 
				echo CHtml::link('Back To View',
					ProductController::createUrl('view',array('id'=>$model->Id)),
					array('id'=>'finish-btn','class'=>'input-action-submit-btn')
				);
			?>
	</div>

</div><!-- form -->
</div>