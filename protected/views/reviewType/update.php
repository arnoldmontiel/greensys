<?php
$this->breadcrumbs=array(
	'Review Types'=>array('index'),
	$model->Id=>array('view','id'=>$model->Id),
	'Update',
);
?>

<h1>Actualizar Formulario</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>