<?php
$this->breadcrumbs=array(
	'User Groups'=>array('index'),
	$model->Id=>array('view','id'=>$model->Id),
	'Update',
);
?>
<div class="well well-small">
<h4>Actualizar Perfil</h4>
</div>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>