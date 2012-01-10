<?php
$this->breadcrumbs=array(
	'Importers'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Importer', 'url'=>array('index')),
	array('label'=>'Create Importer', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('importer-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Importers</h1>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'importer-grid',
	'dataProvider'=>$model->searchSummary(),
	'filter'=>$model,
	'columns'=>array(
		'description',
		array(
 			'name'=>'contact_telephone_1',
			'value'=>'$data->contact->telephone_1',
		),
		array(
 			'name'=>'contact_telephone_2',
			'value'=>'$data->contact->telephone_2',
		),
		array(
 			'name'=>'contact_email',
			'value'=>'$data->contact->email',
		),
array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
