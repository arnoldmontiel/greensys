<?php
$this->breadcrumbs=array(
	'Products'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Create Product', 'url'=>array('create')),
	array('label'=>'Manage Product', 'url'=>array('admin')),
	array('label'=>'Assign Groups', 'url'=>array('productGroup')),
	array('label'=>'Assign Requirements', 'url'=>array('productRequirement')),
	array('label'=>'Manage Import', 'url'=>array('adminImport')),
	array('label'=>'Import From Excel', 'url'=>array('importFromExcel')),
	array('label'=>'Import Measures From Excel', 'url'=>array('importMeasuresFromExcel')),
);

Yii::app()->clientScript->registerScript('admin-measures-import', "

");

?>

<h1>Manage Measures Import</h1>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'measures-import-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
			array(
					'name'=>'original_file_name',
					'value'=>'CHtml::link($data->original_file_name,"./docs/".$data->file_name)',
					'type'=>'raw'
			),
			array(
				'name'=>'unit_weight_description',
				'value'=>'isset($data->measurementUnitWeight)?$data->measurementUnitWeight->short_description:""',
			),
			array(
				'name'=>'unit_linear_description',
				'value'=>'isset($data->measurementUnitLinear)?$data->measurementUnitLinear->short_description:""',
			),
			'not_found_model',
			'creation_date',
	),
)); ?>
