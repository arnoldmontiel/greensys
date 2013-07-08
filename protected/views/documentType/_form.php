<?php 
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
		'id'=>'document-type-form',
		'type'=>'horizontal',
		'enableAjaxValidation'=>true,
		'focus'=>'input:visible:enabled:first'
));
?>
<fieldset>

	<?php echo $form->textFieldRow($model,'name',array('size'=>60,'maxlength'=>100)); ?>
	<?php echo $form->textAreaRow($model,'description',array('cols'=>60)); ?>
</fieldset>
	
	<div class="form-actions">
        <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>$model->isNewRecord ? 'Crear' : 'Guardar')); ?>
        <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'reset', 'label'=>'Reset')); ?>
    </div>

<?php $this->endWidget(); ?>

