<?php
$this->breadcrumbs=array(
	'Budget States'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List BudgetState', 'url'=>array('index')),
	array('label'=>'Manage BudgetState', 'url'=>array('admin')),
);
?>

<h1>Create BudgetState</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>