<?php
$this->breadcrumbs=array(
	'Customers'=>array('index'),
	'Update',
);
?>

<div class="well well-small">
<h4>Actualizar Cliente</h4>
</div>

<?php echo $this->renderPartial('_form', array('modelCustomer'=>$modelCustomer,
	'modelContact'=>$modelContact,
	'modelPerson'=>$modelPerson,
	'modelHyperlink'=>$modelHyperlink
)); ?>