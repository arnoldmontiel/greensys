<?php
$this->breadcrumbs=array(
	'Budgets'=>array('index'),
	$modelInstance->project->description=>array('view','id'=>$modelInstance->Id, 'version'=>$modelInstance->version_number),
	'All Versions',
);

$this->menu=array(
	array('label'=>'List Budget', 'url'=>array('index')),
	array('label'=>'Create Budget', 'url'=>array('create')),
);

?>

<h1>All Versions</h1>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'budget-grid',
	'dataProvider'=>$model->search(),
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
		array(
 			'name'=>'version_number',
			'value'=>'$data->version_number',
			'type'=>'raw',
     		'htmlOptions'=>array('style'=>'text-align: right;'),
		),
		'description',		
		array(
 			'name'=>'percent_discount',
			'value'=>'$data->percent_discount',
			'type'=>'raw',
     		'htmlOptions'=>array('style'=>'text-align: right;'),
		),
		'date_creation',
		'date_inicialization',
		array(
 			'name'=>'totPrice',
			'value'=>'$data->totalPrice',
			'type'=>'raw',
     		'htmlOptions'=>array('style'=>'text-align: right;'),
		),
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view}',
					'buttons'=>array
					(
							'view' => array
							(
					            'url'=>'Yii::app()->createUrl("budget/ViewVersion", array("id"=>$data->Id, "version"=>$data->version_number))',
							),
					),
		),
	),
)); ?>
