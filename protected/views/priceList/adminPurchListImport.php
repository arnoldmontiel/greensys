<?php
$this->breadcrumbs=array(
	'Price Lists'=>array('index'),
	'Manage Import',
);

$this->menu=array(
	array('label'=>'Create PriceList', 'url'=>array('create')),
	array('label'=>'Manage PriceList', 'url'=>array('admin')),
	array('label'=>'Import Purch List from Excel', 'url'=>array('importPurchListFromExcel')),
);

Yii::app()->clientScript->registerScript('admin-measures-import', "

");

?>

<h1>Manage Purch List Import</h1>


<?php 
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'purch-list-import-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(		
			array(
					'name'=>'original_file_name',
					'value'=>'CHtml::link($data->original_file_name,"./docs/".$data->file_name)',
					'type'=>'raw'
			),
			array(
					'name'=>'supplier_description',
					'value'=>'$data->supplier->business_name',
				),			
			array(
					'name'=>'priceList_description',
					'value'=>'$data->priceList->description',
			),
			'not_found_model',
			'creation_date',			
	),
)); ?>
