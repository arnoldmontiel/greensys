<?php
$this->breadcrumbs=array(
	'Measurement Units',
);

$this->menu=array(
	array('label'=>'Create MeasurementUnit', 'url'=>array('create')),
	array('label'=>'Manage MeasurementUnit', 'url'=>array('admin')),
);
?>

<h1>Measurement Units</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
