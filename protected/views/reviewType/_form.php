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
	
	$('.checkbox-group label').click(function(){
		var fieldId = $(this).data('field');
		var id = $(this).data('id');
    	var value = 1;    	

    	var hiddenValue = $('#hidden-user-group-chk').val();
    	var obj = jQuery.parseJSON(hiddenValue);
	
    	if($(this).hasClass('ui-state-active'))
    		value = 0;
    		
    	switch (fieldId) {
    		case 'create':
    			obj[id].create = value;
    			if(value == 1)
    			{
    				$(this).parent().parent().find('#lblCanRead_'+id).addClass('ui-state-active');
    				$(this).parent().parent().find('#chkCanRead_'+id).attr('checked','checked');
    				$(this).parent().parent().find('#lblCanFeedback_'+id).addClass('ui-state-active');
    				$(this).parent().parent().find('#chkCanFeedback_'+id).attr('checked','checked');
    				obj[id].read = value;
    				obj[id].feedback = value;
    			}
    		break;
    		case 'read':
    			obj[id].read = value;
    			if(value == 0)
    			{
    				$(this).parent().parent().find('#lblCanFeedback_'+id).removeClass('ui-state-active');					
    				$(this).parent().parent().find('#chkCanFeedback_'+id).removeAttr('checked');    				
    				obj[id].feedback = value;    				
    			}
    		break;
    		case 'feedback':
    			obj[id].feedback = value;
    			if(value == 1)
    			{
    				$(this).parent().parent().find('#lblCanRead_'+id).addClass('ui-state-active');
    				$(this).parent().parent().find('#chkCanRead_'+id).attr('checked','checked');    				
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
				

				$this->beginWidget('zii.widgets.jui.CJuiButton', array(
	    			'name'=>'btnradio'.$item->Id,
	    			'buttonType'=>'buttonset'
				)); 
				
				echo CHtml::openTag('div',array('class'=>'checkbox-group'));
					echo CHtml::openTag('div',array('style'=>'float:left'));
					echo CHtml::checkBox('chkCanCreate_'.$item->Id, $canCreate,array('id'=>'chkCanCreate_'.$item->Id));
					echo CHtml::label('Crear', 'chkCanCreate_'.$item->Id, array('data-field'=>'create',
																			'data-id'=>$item->Id,
																			'id'=>'lblCanCreate_'.$item->Id));
					echo CHtml::closeTag('div');
					echo CHtml::openTag('div',array('style'=>'float:left'));
					echo CHtml::checkBox('chkCanRead_'.$item->Id, $canRead,array('id'=>'chkCanRead_'.$item->Id));
					echo CHtml::label('Leer', 'chkCanRead_'.$item->Id, array('data-field'=>'read',
																			'data-id'=>$item->Id,
																			'id'=>'lblCanRead_'.$item->Id));
					echo CHtml::closeTag('div');
					echo CHtml::openTag('div',array('style'=>'float:left'));
					echo CHtml::checkBox('chkCanFeedback_'.$item->Id, $canFeedback,array('id'=>'chkCanFeedback_'.$item->Id));
					echo CHtml::label('Responde', 'chkCanFeedback_'.$item->Id, array('data-field'=>'feedback',
																			'data-id'=>$item->Id,
																			'id'=>'lblCanFeedback_'.$item->Id));
					echo CHtml::closeTag('div');
					echo CHtml::openTag('div',array('style'=>'float:left'));
					echo CHtml::checkBox('chkCanMail_'.$item->Id, $canMail,array('id'=>'chkCanMail_'.$item->Id));
					echo CHtml::label('Correo', 'chkCanMail_'.$item->Id, array('data-field'=>'mail',
																			'data-id'=>$item->Id,
																			'id'=>'lblCanMail_'.$item->Id));
					echo CHtml::closeTag('div');
					echo CHtml::openTag('div',array('style'=>'float:left'));
					echo CHtml::checkBox('chkCanClose_'.$item->Id, $canClose,array('id'=>'chkCanClose_'.$item->Id));
					echo CHtml::label('Cerrar', 'chkCanClose_'.$item->Id, array('data-field'=>'close',
																			'data-id'=>$item->Id,
																			'id'=>'lblCanClose_'.$item->Id));
					echo CHtml::closeTag('div');
				echo CHtml::closeTag('div');
				$this->endWidget();
			
// 			$this->widget('bootstrap.widgets.TbButtonGroup', array(
// 				    'type' => 'secondary',
// 				    'toggle' => 'checkbox',
// 				    'buttons' => array(
// 								array('label'=>'Crear','active' => $canCreate,
// 														'htmlOptions'=>array('id'=>'chkCanCreate',
// 																			'data-id'    => $item->Id,
// 								 											'data-field' => 'create',
//                     														)
//                     				 ),
// 								array('label'=>'Leer','active' => $canRead,
// 														'htmlOptions'=>array('id'=>'chkCanRead',
// 																			'data-id'    => $item->Id,
// 								 											'data-field' => 'read',
//                     														)
//                     				 ),
// 								array('label'=>'Responde','active' => $canFeedback,
// 														'htmlOptions'=>array('id'=>'chkCanFeedback',
// 																			'data-id'    => $item->Id,
// 								 											'data-field' => 'feedback',
//                     														)
//                     				 ),
// 								array('label'=>'Correo','active' => $canMail,
// 														'htmlOptions'=>array('id'=>'chkCanMail',
// 																			'data-id'    => $item->Id,
// 								 											'data-field' => 'mail',
//                     														)
//                     				 ),
// 								array('label'=>'Cerrar','active' => $canClose,
// 														'htmlOptions'=>array('id'=>'chkCanClose',
// 																			'data-id'    => $item->Id,
// 								 											'data-field' => 'close',
//                     														)
//                     				 ),
// 						),
// 				));
			
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