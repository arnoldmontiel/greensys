<?php
$this->breadcrumbs=array(
	'Document Types'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Crear Tipo de Documentos', 'url'=>array('create')),
);
?>

<h1>Administrar Tipo de Documentos</h1>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php
$this->widget('bootstrap.widgets.TbGridView', array(
		'type'=>'bordered',
		'dataProvider'=>$model->search(),
		'filter'=>$model,
		'template'=>'{items}{pager}',
		'columns'=>array(		
		array('name'=>'name', 'htmlOptions'=>array('style'=>'width: 180px')),
		'description',
		array(
			'htmlOptions' => array('nowrap'=>'nowrap'),
			'class'=>'bootstrap.widgets.TbButtonColumn',	'template'=>'{view}  {update}',	
		),
	),
)); 
 ?>
