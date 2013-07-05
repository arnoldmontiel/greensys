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
<br>
<?php 
	
	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'user-customer-grid',
		'dataProvider'=>$modelReviewTypeUserGroup->search(),
		'summaryText'=>'',
		'columns'=>array(
				array(
			 		'name'=>'review_type_desc',
					'htmlOptions'=>array('style'=>'text-align: center'),
					'value'=>'$data->reviewType->description',
				),
				),
			)
		); 
	?>
