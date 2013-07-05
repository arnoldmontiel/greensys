<?php
$this->breadcrumbs=array(
	'Document Types'=>array('index'),
	'Create',
);
?>

<h1>Crear Tipo de Documento</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>