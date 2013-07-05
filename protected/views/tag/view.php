<?php
$this->breadcrumbs=array(
	'Tags'=>array('index'),
	$model->Id,
);

?>

<h1>Vista Etapa</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'description',
	),
)); ?>

<?php 
	$modelTagReviewType = new TagReviewType();
	$modelTagReviewType->Id_tag = $model->Id;
	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'tag-customer-grid',
		'dataProvider'=>$modelTagReviewType->search(),
		'summaryText'=>'',
		'columns'=>array(
				array(
			 		'name'=>'Formularios Asociados',
					'htmlOptions'=>array('style'=>'text-align: center'),
					'value'=>'$data->reviewType->description',
				),
				),
			)
		); 
	?>
