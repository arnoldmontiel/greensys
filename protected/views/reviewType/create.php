<?php
$this->breadcrumbs=array(
	'Review Types'=>array('index'),
	'Create',
);
?>

<h1>Crear Formulario</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>