<?php
$this->breadcrumbs=array(
	'Tags'=>array('index'),
	'Create',
);

?>

<h1>Crear Etapas</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>