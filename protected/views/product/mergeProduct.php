
<?php
Yii::app()->clientScript->registerScript(__CLASS__.'#merge-products', "

$('#cancelButton').click(function(){
	window.location = '".ProductController::createUrl('importResults',array('id'=>$idImport))."';
	return false;
});

$('#btn-merge-data-all').click(function(){
	$('#merge-area').find('.btn-merge-data').each(function(){
		var id = $(this).attr('key');
		var newValue =  $('#'+id+'_new').text();
		$('#Product_'+id).text(newValue);
	});
		
	return false;
});

$('#btn-undo-all').click(function(){
	
	$('#merge-area').find('.btn-undo').each(function(){
		var id = $(this).attr('key');
		var newValue =  $('#'+id+'_hidden').text();
		$('#Product_'+id).text(newValue);
	});
		
	return false;
});

$('.btn-merge-data').click(function(){
	var id = $(this).attr('key');
	var newValue =  $('#'+id+'_new').text();
	
	$('#Product_'+id).text(newValue);	
	return false;
});

$('.btn-undo').click(function(){
	var id = $(this).attr('key');
	var newValue =  $('#'+id+'_hidden').text();
	$('#Product_'+id).text(newValue);	
	return false;
});
");

$this->menu=array(
array('label'=>'Import From Excel', 'url'=>array('importFromExcel')),
array('label'=>'Manage Import', 'url'=>array('adminImport')),
array('label'=>'Import Results', 'url'=>array('importResults','id'=>$idImport)),
);
?>
<div>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'model',
		array('label'=>$model->getAttributeLabel('Id_brand'),
			'type'=>'raw',
			'value'=>$model->brand->description
		),
		array('label'=>$model->getAttributeLabel('Id_category'),
			'type'=>'raw',
			'value'=>$model->category->description
		),
		array('label'=>$model->getAttributeLabel('Id_sub_category'),
			'type'=>'raw',
			'value'=>$model->subCategory->description
		),
	),
)); ?>
</div>
<br>
<?php
echo CHtml::button("<< All",array('id'=>'btn-merge-data-all', 'key'=>$key));
echo CHtml::button("Undo All",array('id'=>'btn-undo-all', 'key'=>$key));
?>
<br>
<div id="merge-area">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'merge-product',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); 

echo '<table width=80% class="detail-view">';
	echo '<tr class="odd">';
		echo '<td width=40% style="text-align:center">';
			echo "CURRENT VALUE";
		echo '</td>';
		echo '<td width=20% style="text-align:center">';
			echo '&nbsp;';
		echo '</td>';
		echo '<td width=40% style="text-align:center">';
			echo "NEW VALUE";
		echo '</td>';
	echo '</tr>';
foreach($differences as $key => $diff)
{
	
	echo '<tr class="odd">';
		echo '<td colspan=3 style="text-align:center">';
			echo CHtml::activeLabelEx($model, $key);
		echo '</td>';
	echo '</tr>';
	echo '<tr class="even">';
		echo '<td width=40%>';
			echo CHtml::activeTextArea($model, $key,array('disabled'=>true));
			echo CHtml::textArea($key,$diff['old'],array('id'=>$key.'_hidden', 'style'=>'display:none'));
		echo '</td>';		
		echo '<td width=20% style="text-align:center">';
			echo CHtml::button("<<",array('class'=>'btn-merge-data', 'key'=>$key));
			echo '<br>';
			echo CHtml::button("Undo",array('class'=>'btn-undo', 'key'=>$key));
		echo '</td>';
		echo '<td width=40%>';
			echo CHtml::textArea($key,$diff['new'],array('id'=>$key.'_new','disabled'=>true));
		echo '</td>';
	echo '</tr>';
}
echo '</table>';
?>
</div>
<?php
echo CHtml::submitButton('Finish Merge', array('id'=>'saveButton'));
echo CHtml::submitButton('Cancel', array('id'=>'cancelButton'));
?>
<?php $this->endWidget(); ?>