<?php
$this->breadcrumbs=array(
	'Measurement Unit Converters',
);

$this->menu=array(
	array('label'=>'Create MeasurementUnitConverter', 'url'=>array('create')),
	array('label'=>'Manage MeasurementUnitConverter', 'url'=>array('admin')),
);
?>

<h1>Measurement Unit Converters</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
