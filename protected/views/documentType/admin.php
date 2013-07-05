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
		array('name'=>'name', 'htmlOptions'=>array('style'=>'width: 180px')),
		'description',
		array(			
			'class'=>'bootstrap.widgets.TbButtonColumn',	'template'=>'{view} {update}',	
		),
	),
)); 
 ?>
