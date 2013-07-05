<?php
$this->breadcrumbs=array(
	'Document Types'=>array('index'),
	$model->name=>array('view','id'=>$model->Id),
	'Update',
);
?>

<h1>Actualizar Tipo de Documento</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>