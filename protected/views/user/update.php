<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->username=>array('view','id'=>$model->username),
	'Update',
);
?>

<h1>Actualizar Usuario</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'ddlUserGroup'=>$ddlUserGroup)); ?>