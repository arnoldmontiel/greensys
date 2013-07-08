<?php 
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
		'id'=>'tag-form',
		'type'=>'horizontal',
		'enableAjaxValidation'=>true,
		'focus'=>'input:visible:enabled:first'
));
?>
<fieldset>
		<?php echo $form->textFieldRow($model,'description',array('size'=>60,'maxlength'=>255)); ?>
</fieldset>

	<div class="form-actions">
        <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>$model->isNewRecord ? 'Crear' : 'Guardar')); ?>
        <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'reset', 'label'=>'Reset')); ?>
    </div>
	
<?php $this->endWidget(); ?>
