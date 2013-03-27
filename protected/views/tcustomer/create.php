<?php
$this->breadcrumbs=array(
	'Customers'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Listar Clientes', 'url'=>array('index')),
	array('label'=>'Asignacion Clientes', 'url'=>array('assign')),
	array('label'=>'Administrar Clientes', 'url'=>array('admin')),
);
?>

<h1>Crear Cliente</h1>

<?php echo $this->renderPartial('_form', array('modelCustomer'=>$modelCustomer,
	'modelContact'=>$modelContact,
	'modelPerson'=>$modelPerson,
	'modelUser'=>$modelUser,
	'modelHyperlink'=>$modelHyperlink
)); ?>