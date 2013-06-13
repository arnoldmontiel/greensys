<?php 

Yii::app()->clientScript->registerScript(__CLASS__.'#review-type-form', "
	$('#ReviewType_is_for_client').change(function(){
		$('#ReviewType_is_internal').attr('checked',false);
	});
	$('#ReviewType_is_internal').change(function(){
		$('#ReviewType_is_for_client').attr('checked',false);
	});
	$('#btnSave').click(function(){
		$('#dialogProcessing').dialog('open');
	});
	$('.btn-group a').click(function(){
	
    	var fieldId = $(this).data('field');
    	var id = $(this).data('id');
    	var value = 1;    	

    	var hiddenValue = $('#hidden-user-group-chk').val();
    	var obj = jQuery.parseJSON(hiddenValue);
    	
    	if($(this).hasClass('active'))
    		value = 0;
    	
    	switch (fieldId) {
    		case 'create':
    			obj[id].create = value;
    			if(value == 1)
    			{
    				$(this).parent().find('#chkCanRead').addClass('active');
    				$(this).parent().find('#chkCanFeedback').addClass('active');
    				obj[id].read = value;
    				obj[id].feedback = value;
    			}
    		break;
    		case 'read':
    			obj[id].read = value;
    			if(value == 0)
    			{
    				$(this).parent().find('#chkCanFeedback').removeClass('active');    				
    				obj[id].feedback = value;    				
    			}
    		break;
    		case 'feedback':
    			obj[id].feedback = value;
    			if(value == 1)
    			{
    				$(this).parent().find('#chkCanRead').addClass('active');    				
    				obj[id].read = value;    				
    			}
    		break;
    		case 'mail':
    			obj[id].mail = value;
    		break;
    		case 'close':
    			obj[id].close = value;
    		break; 
    	}    	
    	var newValue = JSON.stringify(obj);    	
    	$('#hidden-user-group-chk').val(newValue);
   });
");

?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'review-type-form',
	'enableAjaxValidation'=>false,
)); ?>
<?php
$this->widget('ext.processingDialog.processingDialog', array(
		'idDialog'=>'dialogProcessing',
));
?>	
	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textField($model,'description',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>
	
	<div class="row">	
		<div class="check-title">
			Seleccione el tipo de etapa
		</div>
		<div class="review-types">
		<?php 
		$tagTypes = array('1'=>'Con Seguimiento','2'=>'Sin Seguimiento');
		echo CHtml::radioButtonList('radiolist-tag-type', $tagTypeSelect, $tagTypes);	 ?>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="check-title">	
			Grupos de Usuarios que podr&aacute; crear
		</div>		
<?php
		$modelUserGroup = UserGroup::model()->findAll();
		$container = array();
		$checkbox = array('create'=>0,'read'=>0,'feedback'=>0,'mail'=>0,'close'=>0);
		foreach($modelUserGroup as $item)
		{
			$canCreate = false;
			$canRead = false;
			$canFeedback = false;
			$canMail = false;
			$canClose = false;
			
			if(!$model->isNewRecord)
			{
				$modelReviewTypeUsrGrup =  ReviewTypeUserGroup::model()->findByAttributes(array('Id_review_type'=>$model->Id, 'Id_user_group'=>$item->Id));
				if(isset($modelReviewTypeUsrGrup))
				{
					$checkbox = array('create'=>$modelReviewTypeUsrGrup->can_create,
										'read'=>$modelReviewTypeUsrGrup->can_read,
										'feedback'=>$modelReviewTypeUsrGrup->can_feedback,
										'mail'=>$modelReviewTypeUsrGrup->can_mail,
										'close'=>$modelReviewTypeUsrGrup->can_close);
					
					$canCreate = ($modelReviewTypeUsrGrup->can_create == 1)?true:false;
					$canRead = ($modelReviewTypeUsrGrup->can_read == 1)?true:false;
					$canFeedback = ($modelReviewTypeUsrGrup->can_feedback == 1)?true:false;
					$canMail = ($modelReviewTypeUsrGrup->can_mail == 1)?true:false;
					$canClose = ($modelReviewTypeUsrGrup->can_close == 1)?true:false;
				}
			}
			
			echo CHtml::openTag('div', array('id'=>'userGroup_'.$item->Id));
			
				echo CHtml::openTag('div', array('class'=>'user-group-first'));
					$this->widget('bootstrap.widgets.TbLabel', array(
					     'type'=>'success', // 'success', 'warning', 'important', 'info' or 'inverse'
					     'label'=>CHtml::encode($item->description),
					));
				echo CHtml::closeTag('div');
				
				$this->widget('bootstrap.widgets.TbButtonGroup', array(
				    'type' => 'secondary',
				    'toggle' => 'checkbox',
				    'buttons' => array(
								array('label'=>'Crear','active' => $canCreate,
														'htmlOptions'=>array('id'=>'chkCanCreate',
																			'data-id'    => $item->Id,
								 											'data-field' => 'create',
                    														)
                    				 ),
								array('label'=>'Leer','active' => $canRead,
														'htmlOptions'=>array('id'=>'chkCanRead',
																			'data-id'    => $item->Id,
								 											'data-field' => 'read',
                    														)
                    				 ),
								array('label'=>'Responde','active' => $canFeedback,
														'htmlOptions'=>array('id'=>'chkCanFeedback',
																			'data-id'    => $item->Id,
								 											'data-field' => 'feedback',
                    														)
                    				 ),
								array('label'=>'Correo','active' => $canMail,
														'htmlOptions'=>array('id'=>'chkCanMail',
																			'data-id'    => $item->Id,
								 											'data-field' => 'mail',
                    														)
                    				 ),
								array('label'=>'Cerrar','active' => $canClose,
														'htmlOptions'=>array('id'=>'chkCanClose',
																			'data-id'    => $item->Id,
								 											'data-field' => 'close',
                    														)
                    				 ),
						),
				));
			
			echo CHtml::closeTag('div');
			$container[$item->Id] = $checkbox;				
		}
		echo CHtml::hiddenField('hidden-user-group-chk', json_encode($container) ,array('id'=>'hidden-user-group-chk'));
?>
	</div>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar',array('id'=>'btnSave')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->