<?php
$this->breadcrumbs=array(
	'Review Types'=>array('index'),
	'Create',
);
?>
<div class="well well-small">
<h4>Crear Formulario</h4>
</div>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>