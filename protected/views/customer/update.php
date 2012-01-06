<?php
$this->breadcrumbs=array(
	'Customers'=>array('index'),
	$model->person->last_name=>array('view','id'=>$model->Id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Customer', 'url'=>array('index')),
	array('label'=>'Create Customer', 'url'=>array('create')),
	array('label'=>'View Customer', 'url'=>array('view', 'id'=>$model->Id)),
	array('label'=>'Manage Customer', 'url'=>array('admin')),
);
?>

<h1>Update Customer</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 
												'modelPerson'=>$modelPerson,
												'modelContact'=>$modelContact)); ?>