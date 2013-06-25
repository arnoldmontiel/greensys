<?php
$this->menu=array(
	array('label'=>'List Product', 'url'=>array('index')),
	array('label'=>'Create Product', 'url'=>array('create')),
	array('label'=>'Manage Product', 'url'=>array('admin')),
	array('label'=>'Assign Groups', 'url'=>array('productGroup')),
	array('label'=>'Assign Requirements', 'url'=>array('productRequirement')),
	array('label'=>'Import From Excel', 'url'=>array('importFromExcel')),
);
?>

<h1>Resultados Import</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'file_name',
		'insert_rows',
		'already_exist_rows',
		'total_rows',
		'error_rows',
		'import_code',
		'date',		
	),
)); ?>