<?php
$this->breadcrumbs=array(
	'User Groups'=>array('index'),
	$model->Id=>array('view','id'=>$model->Id),
	'Update',
);

$this->menu=array(
	array('label'=>'Crear Perfil', 'url'=>array('create')),
	array('label'=>'Ver Perfil', 'url'=>array('view', 'id'=>$model->Id)),
	array('label'=>'Administrar Perfiles', 'url'=>array('admin')),
);
?>

<h1>Actualizar Perfil</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>