<?php
$this->breadcrumbs=array(
	'Document Types'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Administrar Tipo de Documentos', 'url'=>array('admin')),
);
?>

<h1>Crear Tipo de Documento</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>