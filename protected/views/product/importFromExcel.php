<?php
Yii::app()->clientScript->registerScript(__CLASS__.'#UploadSubtitle', "


");

$this->menu=array(
	array('label'=>'List Product', 'url'=>array('index')),
	array('label'=>'Create Product', 'url'=>array('create')),
	array('label'=>'Manage Product', 'url'=>array('admin')),
	array('label'=>'Assign Groups', 'url'=>array('productGroup')),
	array('label'=>'Assign Requirements', 'url'=>array('productRequirement')),
	array('label'=>'Manage Import', 'url'=>array('adminImport')),
);
?>

<h1>Import products from SIX</h1>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'importFromExcel-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>



<br>
	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'file  *.csv'); ?>
		<?php echo $form->fileField($model,'file'); ?>
		<?php echo $form->error($model,'file'); ?>
	</div>

	<div style="width:50%;float:left">
		<?php echo CHtml::submitButton('Import',array('id'=>'Upload','name'=>'Upload')); ?>
	</div><!-- div button save -->
	<div style="width:50%;float:right;position:relative">
	<?php
			echo CHtml::submitButton('Cancel', array('id'=>'cancelButton'));
	?>		 
	</div><!-- div button cancel -->
	
<?php $this->endWidget(); ?>

</div><!-- form -->