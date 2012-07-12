<?php
$this->breadcrumbs=array(
	'Budgets'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Budget', 'url'=>array('index')),
	array('label'=>'Create Budget', 'url'=>array('create')),
);

?>

<h1>Manage Budgets</h1>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'budget-grid',
	'dataProvider'=>$model->searchSummary(),
	'filter'=>$model,
	'columns'=>array(
		array(
 			'name'=>'Id_project',
			'value'=>'$data->project->description',
		),
		array(
 			'name'=>'Id_budget_state',
			'value'=>'$data->budgetState->description',
		),
		'version_number',
		'percent_discount',
		'date_creation',
		'date_inicialization',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
