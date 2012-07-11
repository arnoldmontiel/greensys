<?php
$this->breadcrumbs=array(
	'Budgets'=>array('index'),
	$model->project->description,
);

$this->menu=array(
	array('label'=>'List Budget', 'url'=>array('index')),
	array('label'=>'Create Budget', 'url'=>array('create')),
	array('label'=>'Update Budget', 'url'=>array('update', 'id'=>$model->Id)),
	array('label'=>'Delete Budget', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->Id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Budget', 'url'=>array('admin')),
);
?>

<h1>View Budget</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		array('label'=>$model->getAttributeLabel('Id_project'),
			'type'=>'raw',
			'value'=>$model->project->description
		),
		'version_number',
		array('label'=>$model->getAttributeLabel('Id_budget_state'),
			'type'=>'raw',
			'value'=>$model->budgetState->description
		),
		'description',
		'percent_discount',
		'date_creation',
		'date_inicialization',
		'date_finalization',
		'date_estimated_inicialization',
		'date_estimated_finalization',
	),
)); ?>
