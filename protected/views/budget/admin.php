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
		'description',
		'percent_discount',
		'date_creation',
		'date_inicialization',
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view}{update}{delete}',
					'buttons'=>array
					(
					        'delete' => array
							(
					            'url'=>'Yii::app()->createUrl("budget/Delete", array("id"=>$data->Id, "version"=>$data->version_number))',
							),
							'view' => array
							(
					            'url'=>'Yii::app()->createUrl("budget/View", array("id"=>$data->Id, "version"=>$data->version_number))',
							),
							'update' => array
							(
					            'url'=>'Yii::app()->createUrl("budget/Update", array("id"=>$data->Id, "version"=>$data->version_number))',
							),
					),
		),
	),
)); ?>
