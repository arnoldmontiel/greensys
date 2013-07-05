<?php
$this->breadcrumbs=array(
	'User Groups'=>array('index'),
	'Create',
);
?>

<h1>Crear Perfil</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>