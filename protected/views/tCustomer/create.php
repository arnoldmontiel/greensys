<?php
$this->breadcrumbs=array(
	'Customers'=>array('index'),
	'Create',
);
?>
<div class="well well-small">
<h4>Crear Cliente</h4>
</div>

<?php echo $this->renderPartial('_form', array('modelCustomer'=>$modelCustomer,
	'modelContact'=>$modelContact,
	'modelPerson'=>$modelPerson,
	'modelUser'=>$modelUser,
	'modelHyperlink'=>$modelHyperlink
)); ?>