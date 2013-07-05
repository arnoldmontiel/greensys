<?php
$this->breadcrumbs=array(
	'Tags'=>array('index'),
	'Create',
);

?>
<div class="well well-small">
<h4>Crear Etapa</h4>
</div>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>