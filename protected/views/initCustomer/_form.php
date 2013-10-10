<?php
Yii::app()->clientScript->registerScript(__CLASS__.'#Customer-init-tapia-form', "

if('".$modelCustomer->isNewRecord."' == '1')
	$('#User_username').val('');
		
");
?>

<?php 
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
		'id'=>'init-customer-form',
		'type'=>'horizontal',
		'enableAjaxValidation'=>true,
		'focus'=>'input:visible:enabled:first'
));
?>
<fieldset>

		<?php echo $form->textFieldRow($modelContact,'description',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->textFieldRow($modelPerson,'name',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->textFieldRow($modelPerson,'last_name',array('size'=>45,'maxlength'=>45)); ?>
		<?php 
		$modelPerson->date_birth = Yii::app()->lc->toLocal($modelPerson->date_birth, 'date', 'small');
		echo $form->datepickerRow($modelPerson, 'date_birth',
        array('hint'=>'Click para seleccionar la fecha.',
        'prepend'=>'<i class="icon-calendar"></i>','options'=>array('language'=>'es','format' => Yii::app()->locale->getDateFormat('calendar_small'))));?>
		<?php echo $form->textFieldRow($modelPerson,'uid',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->textFieldRow($modelContact,'telephone_1',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->textFieldRow($modelContact,'telephone_2',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->textFieldRow($modelContact,'telephone_3',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->textFieldRow($modelContact,'email',array('size'=>60,'maxlength'=>128,'prepend'=>'@')); ?>
		<?php echo $form->textFieldRow($modelContact,'address',array('size'=>60,'maxlength'=>100)); ?>
		<?php
			$hyperLinks = array();
			$hyperDesc="";
			if(!$modelCustomer->isNewRecord)
			{
				$first = true;
				foreach ($modelHyperlink as $link)
				{
					$hyperLinks[] =$link->description;
					if($first)
					{
						$first= false;
						$hyperDesc.=$link->description;
					}
					else 
					{
						$hyperDesc.=",".$link->description;
					}
				}				
			}
		
		?>
        <?php
        $modelHolder = new Hyperlink();
        $modelHolder->description=$hyperDesc;
        echo $form->select2Row($modelHolder, 'description',
        	 array('asDropDownList' => false,
			'options' => array(
        	'tags' => $hyperLinks,
        	'placeholder' => 'Escriba una URL.',
        	'width' => '40%',
        	'tokenSeparators' => array(',', ' '),
			
        )));
		?>
</fieldset>
	
	<div class="form-actions">
        <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>$modelCustomer->isNewRecord ? 'Crear' : 'Guardar')); ?>
        <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'reset', 'label'=>'Reset')); ?>
    </div>

<?php $this->endWidget(); ?>

