<?php
$this->breadcrumbs=array(
	'Tags'=>array('index'),
	$model->Id=>array('view','id'=>$model->Id),
	'Update',
);
?>
<div class="well well-small">
<h4>Actualizar Etapa</h4>
</div>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>