<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->username=>array('view','id'=>$model->username),
	'Update',
);
?>
<div class="well well-small">
<h4>Actualizar Usuario</h4>
</div>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'ddlUserGroup'=>$ddlUserGroup)); ?>