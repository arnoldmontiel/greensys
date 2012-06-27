<?php 
Yii::app()->clientScript->registerScript(__CLASS__.'#price_list', "
		function configureDropDowns()
		{
			if($('#PriceList_Id_price_list_type').val()=='1')
			{
				$('#PriceList_Id_importer').attr('disabled',true);
				$('#PriceList_Id_supplier').attr('disabled',false);
	
			}
			else
			{
				$('#PriceList_Id_importer').attr('disabled',false);
				$('#PriceList_Id_supplier').attr('disabled',true);
			}
		}
		configureDropDowns();
		$('#PriceList_Id_price_list_type').change(
			function(){
				configureDropDowns();
			}
		);
");
?>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'price-list-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'date_validity'); ?>
 		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
	     // additional javascript options for the date picker plugin
 		'language'=>'en',
 		'model'=>$model,
 		'attribute'=>'date_validity',
 		'options'=>array(
	         'showAnim'=>'fold',
	     ),
	     'htmlOptions'=>array(
	         'style'=>'height:20px;'
	    ),
		));?>
		<?php echo $form->error($model,'date_validity'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textField($model,'description',array('size'=>45,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>
	<div style="display: inline-block;">
		<?php echo $form->labelEx($model,'Id_price_list_type'); ?>
		<?php echo $form->dropDownList($model, 'Id_price_list_type', CHtml::listData(
    			PriceListType::model()->findAll(), 'Id', 'name')); 
		?>
		<?php echo $form->error($model,'Id_product_type'); ?>
	</div>
	
	<div class="row">
			<?php echo $form->labelEx($model,'validity'); ?>			
			<?php echo $form->checkBox($model,'validity'); ?>
			<?php echo $form->error($model,'validity'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Id_supplier'); ?>
		<?php echo $form->dropDownList($model, 'Id_supplier', CHtml::listData(
    			Supplier::model()->findAll(), 'Id', 'business_name')); 
		?>
		<?php echo $form->error($model,'Id_supplier'); ?>
		
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'Id_importer'); ?>
		<?php echo $form->dropDownList($model, 'Id_importer', CHtml::listData(
    			Importer::model()->findAll(), 'Id', 'contact.description')); 
		?>
		<?php echo $form->error($model,'Id_supplier'); ?>
		
	</div>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->