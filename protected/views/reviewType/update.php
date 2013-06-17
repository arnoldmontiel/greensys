<?php
$this->breadcrumbs=array(
	'Review Types'=>array('index'),
	$model->Id=>array('view','id'=>$model->Id),
	'Update',
);

$this->menu=array(
	array('label'=>'Crear Formulario', 'url'=>array('create')),
	array('label'=>'Ver Formulario', 'url'=>array('view', 'id'=>$model->Id)),
	array('label'=>'Administrar Formularios', 'url'=>array('admin')),
);
?>

<h1>Actualizar Formulario</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'tagTypeSelect'=>$tagTypeSelect)); ?>