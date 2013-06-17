<?php
$this->breadcrumbs=array(
	'Review Types'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Administrar Formularios', 'url'=>array('admin')),
);
?>

<h1>Crear Formulario</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'tagTypeSelect'=>$tagTypeSelect)); ?>