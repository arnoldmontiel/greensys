<?php
$this->breadcrumbs=array(
	'Document Types'=>array('index'),
	'Create',
);
?>
<div class="well well-small">
<h4>Crear Tipo de Documento</h4>
</div>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>