<?php
$this->breadcrumbs=array(
	'User Groups'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Administrar Perfil', 'url'=>array('admin')),
);
?>

<h1>Crear Perfil</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>