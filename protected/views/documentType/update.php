<?php
$this->breadcrumbs=array(
	'Document Types'=>array('index'),
	$model->name=>array('view','id'=>$model->Id),
	'Update',
);
?>
<div class="well well-small">
<h4>Actualizar Tipo de Documento</h4>
</div>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>