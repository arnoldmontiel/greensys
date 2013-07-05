<?php
$this->breadcrumbs=array(
	'User Groups'=>array('index'),
	'Create',
);
?>
<div class="well well-small">
<h4>Crear Perfil</h4>
</div>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>