<?php
Yii::app()->clientScript->registerScript(__CLASS__.'#importMeasures-Excel', "

$('#cancelButton').click(function(){
	window.location = '".ProductController::createUrl('adminMeasuresImport')."';
	return false;
});

$('#btn-export').click(function(){
	window.location = '".ProductController::createUrl('ExportToExcel') ."';
	return false;
});
			
");

$this->menu=array(
	array('label'=>'Create Product', 'url'=>array('create')),
	array('label'=>'Manage Product', 'url'=>array('admin')),
	array('label'=>'Assign Groups', 'url'=>array('productGroup')),
	array('label'=>'Assign Requirements', 'url'=>array('productRequirement')),
	array('label'=>'Manage Import', 'url'=>array('adminImport')),
	array('label'=>'Import From Excel', 'url'=>array('importFromExcel')),
	array('label'=>'Manage Measures Import', 'url'=>array('adminMeasuresImport')),
);

?>

<h1>Import product measure from Excel</h1>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'importMeasuresExcel-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>



<br>
	<?php echo $form->errorSummary($model); ?>
<?php echo CHtml::link( 'Export','#',array('id'=>'btn-export'));?>
	<div class="row">		
		<div style="width: 120px; display: inline-block;">
			<?php echo $form->labelEx($modelProductImportLog,'Id_measurement_unit_linear'); ?>
			<?php				
				echo $form->dropDownList($modelProductImportLog, 'Id_measurement_unit_linear', 
					CHtml::listData($ddlMeasurementUnitLinear, 'Id', 'short_description')); 
			?>
			<?php echo $form->error($modelProductImportLog,'Id_measurement_unit_linear'); ?>
		</div>
		<div style="width: 120px; display: inline-block;">
			<?php echo $form->labelEx($modelProductImportLog,'Id_measurement_unit_weight'); ?>
			<?php				
				echo $form->dropDownList($modelProductImportLog, 'Id_measurement_unit_weight', 
					CHtml::listData($ddlMeasurementUnitWeight, 'Id', 'short_description')); 
			?>
			<?php echo $form->error($modelProductImportLog,'Id_measurement_unit_weight'); ?>
		</div>		
		<div style="width: 120px; display: inline-block;">
			<?php echo $form->labelEx($modelProductImportLog,'Id_brand'); ?>
			<?php				
				echo $form->dropDownList($modelProductImportLog, 'Id_brand', 
					CHtml::listData($ddlBrand, 'Id', 'description')); 
			?>
			<?php echo $form->error($modelProductImportLog,'Id_brand'); ?>
		</div>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'file  *.xslx, *.xls'); ?>
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