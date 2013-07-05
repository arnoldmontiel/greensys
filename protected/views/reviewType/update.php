<?php
$this->breadcrumbs=array(
	'Review Types'=>array('index'),
	$model->Id=>array('view','id'=>$model->Id),
	'Update',
);
?>
<div class="well well-small">
<h4>Actualizar Formulario</h4>
</div>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>