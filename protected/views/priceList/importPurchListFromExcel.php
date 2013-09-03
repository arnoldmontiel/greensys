<?php
Yii::app()->clientScript->registerScript(__CLASS__.'#importPurchListFrom-Excel', "

$('#cancelButton').click(function(){
	window.location = '".PriceListController::createUrl('adminPurchListImport')."';
	return false;
});

");

$this->menu=array(
	array('label'=>'Create PriceList', 'url'=>array('create')),
	array('label'=>'Manage PriceList', 'url'=>array('admin')),
	array('label'=>'Manage Import Purch List', 'url'=>array('adminPurchListImport')),
);

?>

<h1>Import Purch price list from Excel</h1>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'importPurchListFromExcel-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>



<br>
	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($modelPriceList,'date_validity'); ?>
 		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
	     // additional javascript options for the date picker plugin
 		'language'=>'es',
 		'model'=>$modelPriceList,
 		'attribute'=>'date_validity',
 		'options'=>array(
	         'showAnim'=>'fold',
	     ),
	     'htmlOptions'=>array(
	         'style'=>'height:20px;'
	    ),
		));?>
		<?php echo $form->error($modelPriceList,'date_validity'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($modelPriceList,'description'); ?>
		<?php echo $form->textField($modelPriceList,'description',array('size'=>45,'maxlength'=>100)); ?>
		<?php echo $form->error($modelPriceList,'description'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($modelPriceList,'Id_supplier'); ?>
		<?php				
			echo $form->dropDownList($modelPriceList, 'Id_supplier', 
				CHtml::listData($ddlSupplier, 'Id', 'business_name')); 
		?>
		<?php echo $form->error($modelPriceList,'Id_supplier'); ?>
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