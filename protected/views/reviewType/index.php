<?php
$this->breadcrumbs=array(
	'Review Types',
);

$this->menu=array(
	array('label'=>'Crear Formulario', 'url'=>array('create')),
	array('label'=>'Administrar Formularios', 'url'=>array('admin')),
);
?>

<h1>Tipos de Formulario</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
