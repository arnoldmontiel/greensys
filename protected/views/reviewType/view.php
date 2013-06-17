<?php
$this->breadcrumbs=array(
	'Review Types'=>array('index'),
	$model->Id,
);

$this->menu=array(
	array('label'=>'Crear Formulario', 'url'=>array('create')),
	array('label'=>'Actualizar Formulario', 'url'=>array('update', 'id'=>$model->Id)),
	array('label'=>'Administrar Formularios', 'url'=>array('admin')),
);

Yii::app()->clientScript->registerScript(__CLASS__.'#review-type-view', "
	
	$('.btn-group a').click(function(){
		return false;
   });
");
?>

<h1>Vista Formulario</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'description',
		array('label'=>$model->getAttributeLabel('Con Seguimiento'),
				'type'=>'raw',
				'value'=>CHtml::checkBox("tagType",( TagReviewType::model()->countByAttributes(array('Id_review_type'=>$model->Id))>1)?true:false,array("disabled"=>"disabled"))
		),
	),
)); ?>

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
							
		}
?>
