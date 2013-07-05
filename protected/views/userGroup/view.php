<?php
$this->breadcrumbs=array(
	'User Groups'=>array('index'),
	$model->Id,
);
?>
<div class="well well-small">
<h4>Vista Perfil</h4>
</div>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'description',
		array('label'=>$model->getAttributeLabel('is_internal'),
				'type'=>'raw',
				'value'=>CHtml::checkBox("is_internal",$model->is_internal,array("disabled"=>"disabled"))
		),
		array('label'=>$model->getAttributeLabel('is_administrator'),
				'type'=>'raw',
				'value'=>CHtml::checkBox("is_administrator",$model->is_administrator,array("disabled"=>"disabled"))
		),
		array('label'=>$model->getAttributeLabel('use_technical_docs'),
				'type'=>'raw',
				'value'=>CHtml::checkBox("use_technical_docs",$model->use_technical_docs,array("disabled"=>"disabled"))
		),
	),
)); ?>
