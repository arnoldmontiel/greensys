<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Create',
);
?>
<div class="well well-small">
<h4>Crear Usuario</h4>
</div>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'ddlUserGroup'=>$ddlUserGroup)); ?>