<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'delete-reviewType-form',
	'enableAjaxValidation'=>false,
)); ?>

<p class="note">Seleccione un agrupador de la lista para reemplazar "<?php echo $model->description; ?>"</p>
<?php echo CHtml::hiddenField('Id-to-delete',$model->Id,array('id'=>'Id-to-delete')); ?>
	<div class="row" >
		<?php 
		
		echo CHtml::dropDownList('new-review-type', '', CHtml::listData(
    			$ddlReviewType, 'Id', 'description')); 
		?>			
	</div>	

<?php $this->endWidget(); ?>

</div><!-- form -->