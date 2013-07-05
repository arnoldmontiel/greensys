<?php
$this->breadcrumbs=array(
	'Review Types'=>array('index'),
	$model->Id,
);

Yii::app()->clientScript->registerScript(__CLASS__.'#review-type-view', "
	
	$('.btn-group a').click(function(){
		return false;
	});
	
	$('input:radio').change(function(){	
		var value = $(this).val();
		var confirmMsg = 'Este tipo de formulario pasar\u00e1 a ser Sin Seguimiento';
		
		if(value == 1){ //Con seguimiento
			confirmMsg = 'Este tipo de formulario pasar\u00e1 a ser Con Seguimiento';
		}
			
		if(confirm(confirmMsg)) {
       		$.post('".ReviewTypeController::createUrl('AjaxChangeTagType')."', 
				{
					idRadio: value,					
					idReviewType: ".$model->Id."
				}
				).success(
				function(data){					
			});
   		}
		
	});
");
?>
<div class="well well-small">
<h4>Vista Formulario</h4>
</div>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'description',
		'long_description',		
	),
)); ?>

<div>	
	<div class="check-title">
		Tipo de etapa
	</div>
	<div class="review-types">
		<?php 
		$tagTypeSelect = ( $model->has_tag_tracking == 1)?1:2;
		$tagTypes = array('1'=>'Con Seguimiento','2'=>'Sin Seguimiento');
		echo CHtml::radioButtonList('radiolist-tag-type', $tagTypeSelect, $tagTypes, array('disabled'=>'disabled'));	 ?>
	</div>
</div>

<br>

<?php
		$modelUserGroup = UserGroup::model()->findAll();	
		foreach($modelUserGroup as $item)
		{
			$canCreate = false;
			$canRead = false;
			$canFeedback = false;
			$canMail = false;
			$canClose = false;
			
			$modelReviewTypeUsrGrup =  ReviewTypeUserGroup::model()->findByAttributes(array('Id_review_type'=>$model->Id, 'Id_user_group'=>$item->Id));
			if(isset($modelReviewTypeUsrGrup))
			{					
				$canCreate = ($modelReviewTypeUsrGrup->can_create == 1)?true:false;
				$canRead = ($modelReviewTypeUsrGrup->can_read == 1)?true:false;
				$canFeedback = ($modelReviewTypeUsrGrup->can_feedback == 1)?true:false;
				$canMail = ($modelReviewTypeUsrGrup->can_mail == 1)?true:false;
				$canClose = ($modelReviewTypeUsrGrup->can_close == 1)?true:false;
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
								array('label'=>'Responder','active' => $canFeedback,
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
								array('label'=>'Finalizar','active' => $canClose,
														'htmlOptions'=>array('id'=>'chkCanClose',
																			'data-id'    => $item->Id,
								 											'data-field' => 'close',
                    														)
                    				 ),
						),
				));
			
			echo CHtml::closeTag('div');
							
		}
?>
