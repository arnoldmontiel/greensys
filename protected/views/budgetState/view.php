<?php
$this->breadcrumbs=array(
	'Budget States'=>array('index'),
	$model->Id,
);

$this->menu=array(
	array('label'=>'List BudgetState', 'url'=>array('index')),
	array('label'=>'Create BudgetState', 'url'=>array('create')),
	array('label'=>'Update BudgetState', 'url'=>array('update', 'id'=>$model->Id)),
	array('label'=>'Delete BudgetState', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->Id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage BudgetState', 'url'=>array('admin')),
);
?>

<h1>View BudgetState #<?php echo $model->Id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'Id',
		'description',
	),
)); ?>
