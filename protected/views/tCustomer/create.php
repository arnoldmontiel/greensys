<?php
$this->breadcrumbs=array(
	'Customers'=>array('index'),
	'Create',
);
?>

<h1>Crear Cliente</h1>

<?php echo $this->renderPartial('_form', array('modelCustomer'=>$modelCustomer,
	'modelContact'=>$modelContact,
	'modelPerson'=>$modelPerson,
	'modelUser'=>$modelUser,
	'modelHyperlink'=>$modelHyperlink
)); ?>