<?php
$this->breadcrumbs=array(
	'Budget States'=>array('index'),
	$model->Id=>array('view','id'=>$model->Id),
	'Update',
);

$this->menu=array(
	array('label'=>'List BudgetState', 'url'=>array('index')),
	array('label'=>'Create BudgetState', 'url'=>array('create')),
	array('label'=>'View BudgetState', 'url'=>array('view', 'id'=>$model->Id)),
	array('label'=>'Manage BudgetState', 'url'=>array('admin')),
);
?>

<h1>Update BudgetState <?php echo $model->Id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>