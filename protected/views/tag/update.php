<?php
$this->breadcrumbs=array(
	'Tags'=>array('index'),
	$model->Id=>array('view','id'=>$model->Id),
	'Update',
);
?>

<h1>Actualizar Etapa</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>