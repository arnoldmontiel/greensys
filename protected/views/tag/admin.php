<?php
$this->breadcrumbs=array(
	'Tags'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Crear Etapas', 'url'=>array('create')),
);


?>

<h1>Administrar Etapas</h1>

<?php
$columns = array(
		'description',
		array(
				'class'=>'bootstrap.widgets.TbButtonColumn',
				'template'=>'{view} {update}',
		),
); 
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
		'columns'=>$columns,
));
?>
