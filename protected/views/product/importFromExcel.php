<?php
Yii::app()->clientScript->registerScript(__CLASS__.'#UploadSubtitle', "


");

$this->menu=array(
	array('label'=>'List Nzb', 'url'=>array('index')),
	array('label'=>'Manage Nzb', 'url'=>array('admin')),
);
?>

<h1>Upload subtitle</h1>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'importFromExcel-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>



<br>
	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'file  *.srt'); ?>
		<?php echo $form->fileField($model,'file'); ?>
		<?php echo $form->error($model,'file'); ?>
	</div>

	<div style="width:50%;float:left">
		<?php echo CHtml::submitButton('Upload',array('id'=>'Upload','name'=>'Upload')); ?>
	</div><!-- div button save -->
	<div style="width:50%;float:right;position:relative">
	<?php
			echo CHtml::submitButton('Cancel', array('id'=>'cancelButton'));
	?>		 
	</div><!-- div button cancel -->
	
<?php $this->endWidget(); ?>

</div><!-- form -->