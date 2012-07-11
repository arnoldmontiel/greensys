<?php
$this->breadcrumbs=array(
	'Budgets'=>array('index'),
	$model->project->description=>array('view','id'=>$model->Id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Budget', 'url'=>array('index')),
	array('label'=>'Create Budget', 'url'=>array('create')),
	array('label'=>'View Budget', 'url'=>array('view', 'id'=>$model->Id)),
	array('label'=>'Manage Budget', 'url'=>array('admin')),
);
?>

<h1>Update Budget</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,
												'modelBudgetState'=>$modelBudgetState,
												'modelProject'=>$modelProject,)); ?>