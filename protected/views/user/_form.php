<?php
Yii::app()->clientScript->registerScript(__CLASS__.'#User-tapia-form', "

");
?>
<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
		'id'=>'user-form',
		'type'=>'horizontal',
		'enableAjaxValidation'=>true,
		'focus'=>'input:visible:enabled:first'
));
?>
<fieldset>
		<?php echo $form->textFieldRow($model,'username',array('size'=>60,'maxlength'=>128,'disabled'=>$model->isNewRecord ? false : true)); ?>
		<?php echo $form->passwordFieldRow($model,'password',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->textFieldRow($model,'email',array('size'=>60,'maxlength'=>128)); ?>
		<?php 
			$userGroups = CHtml::listData($ddlUserGroup, 'Id', 'description');
			echo $form->dropDownListRow(
				$model,'Id_user_group',$userGroups,
					array(
						'hint'=>CHtml::link( 'Agregar Nuevo Perfil','#',array('onclick'=>'jQuery("#CreateUserGroup").dialog("open"); return false;')
					)
				)
			); 
		?>
				
		<?php echo $form->textFieldRow($model,'name',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->textFieldRow($model,'last_name',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->textFieldRow($model,'address',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->textFieldRow($model,'phone_house',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->textFieldRow($model,'phone_mobile',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->textFieldRow($model,'dni',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->textFieldRow($model,'cuil',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->textAreaRow($model,'description',array('size'=>255,'maxlength'=>255,'cols'=>80)); ?>
</fieldset>			
	<div class="form-actions">
        <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>$model->isNewRecord ? 'Crear' : 'Guardar')); ?>
        <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'reset', 'label'=>'Reset')); ?>
    </div>
	
<?php $this->endWidget(); ?>

<?php
//User Group
	$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
			'id'=>'CreateUserGroup',
			// additional javascript options for the dialog plugin
			'options'=>array(
					'title'=>'Crear Grupo de Usuario',
					'autoOpen'=>false,
					'modal'=>true,
					'width'=> '500',
					'buttons'=>	array(							
							'Grabar'=>'js:function()
							{
							jQuery("#wating").dialog("open");
							jQuery.post("'.Yii::app()->createUrl("userGroup/AjaxCreate").'", $("#user-group-form").serialize(),
							function(data) {
								if(data!=null)
								{
									$("#User_Id_user_group").append(
										$("<option></option>").val(data.Id).html(data.description)
									);
									jQuery("#CreateUserGroup").dialog( "close" );
								}
							jQuery("#wating").dialog("close");
						},"json"
					);
	
	}',
	'Cancelar'=>'js:function(){jQuery("#CreateUserGroup").dialog( "close" );}'),
			),
	));
	$modelUserGroup = new UserGroup();
	echo $this->renderPartial('../userGroup/_formPopUp', array('model'=>$modelUserGroup));
	
	$this->endWidget('zii.widgets.jui.CJuiDialog');
?>