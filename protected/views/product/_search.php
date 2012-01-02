<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'Id'); ?>
		<?php echo $form->textField($model,'Id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Id_brand'); ?>
		<?php echo $form->textField($model,'Id_brand'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Id_category'); ?>
		<?php echo $form->textField($model,'Id_category'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Id_nomenclator'); ?>
		<?php echo $form->textField($model,'Id_nomenclator'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'description_customer'); ?>
		<?php echo $form->textField($model,'description_customer',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'description_supplier'); ?>
		<?php echo $form->textField($model,'description_supplier',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'code'); ?>
		<?php echo $form->textField($model,'code',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'code_supplier'); ?>
		<?php echo $form->textField($model,'code_supplier',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'discontinued'); ?>
		<?php echo $form->textField($model,'discontinued'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'length'); ?>
		<?php echo $form->textField($model,'length',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'width'); ?>
		<?php echo $form->textField($model,'width',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'height'); ?>
		<?php echo $form->textField($model,'height',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'profit_rate'); ?>
		<?php echo $form->textField($model,'profit_rate',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'msrp'); ?>
		<?php echo $form->textField($model,'msrp',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'time_instalation'); ?>
		<?php echo $form->textField($model,'time_instalation'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hide'); ?>
		<?php echo $form->textField($model,'hide'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'weight'); ?>
		<?php echo $form->textField($model,'weight',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->