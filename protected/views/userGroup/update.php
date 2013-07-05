<?php
$this->breadcrumbs=array(
	'User Groups'=>array('index'),
	$model->Id=>array('view','id'=>$model->Id),
	'Update',
);
?>

<h1>Actualizar Perfil</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>