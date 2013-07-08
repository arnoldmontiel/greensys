<?php
$this->breadcrumbs=array(
	'Tags'=>array('index'),
	$model->Id,
);

?>
<div class="well well-small">
<h4>Vista Etapa</h4>
</div>

<?php 
$this->widget('bootstrap.widgets.TbDetailView', array(
		'data'=>$model,
'attributes'=>array(
		'description',
)));
?>

<?php 
	$modelTagReviewType = new TagReviewType();
	$modelTagReviewType->Id_tag = $model->Id;
	$this->widget('bootstrap.widgets.TbGridView', array(
			'id'=>'user-group-grid',
			'type'=>'bordered',
			'dataProvider'=>$modelTagReviewType->search(),
			'template'=>'{items}{pager}',
			'pager'=>array(
					'hiddenPageCssClass'=>'disabled',
					'selectedPageCssClass'=>'active',
					'cssFile'=>'css/bootstrap-combined.no-icons.min.css',
					'header'         => '',
					'firstPageLabel' => '&lt;&lt;',
					'prevPageLabel' => '←',
					'nextPageLabel' => '→',
					'lastPageLabel'  => '&gt;&gt;',
			),
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
