<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'product-requirement-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<div style="display: inline-block;">
			<?php echo $form->labelEx($model,'Id_guild'); ?>
			<?php echo $form->dropDownList($model, 'Id_guild', CHtml::listData(
	    			Guild::model()->findAll(), 'Id', 'description'
			),array(
					'prompt'=>'Select a Guild'
				)); 
			?>
			<?php echo $form->error($model,'Id_customer'); ?>
		</div>
		<div style="display: inline-block;">
			<?php echo CHtml::link( 'Add new Guild', ProductRequirementController::createUrl('CreateDependency', array('dependency'=>'guild')));?>
		</div>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'internal'); ?>
		<?php echo $form->checkBox($model,'internal'); ?>
		<?php echo $form->error($model,'internal'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description_short'); ?>
		<?php echo $form->textField($model,'description_short',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'description_short'); ?>
	</div>

<?php
	
	 $this->widget('ext.richtext.jwysiwyg', array(
	 	'id'=>'noteContainer',	// default is class="ui-sortable" id="yw0"	
	 	'notes'=> $modelNote->note
	 			));
	
	?>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

<?php
if(!$model->isNewRecord)
{
$this->widget('ext.xupload.XUploadWidget', array(
                    'url' => ProductRequirementController::createUrl('AjaxUpload',array('id'=>$model->Id)),
					'multiple'=>true,
					'name'=>'file',
					'options' => array(
						'acceptFileTypes' => '/(\.|\/)(gif|jpeg|png)$/i',
						'onComplete' => 'js:function (event, files, index, xhr, handler, callBack) {

							id = jQuery.parseJSON(xhr.response).id;
							$tr = $(document).find("#"+id);
							$tr.find(".file_upload_cancel button").click(function(){
								var target = $(this);
											
								$.get("'.ProductRequirementController::createUrl('album/AjaxRemoveImage').'",
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
								
								$.get("'.ProductRequirementController::createUrl('album/AjaxAddImageDescription').'",
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
}
?>
</div><!-- form -->