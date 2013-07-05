<?php
$this->breadcrumbs=array(
	'Customers'=>array('index'),
	'Update',
);
?>

<h1>Actualizar Cliente</h1>

<?php echo $this->renderPartial('_form', array('modelCustomer'=>$modelCustomer,
	'modelContact'=>$modelContact,
	'modelPerson'=>$modelPerson,
	'modelUser'=>$modelUser,
	'modelHyperlink'=>$modelHyperlink
)); ?>