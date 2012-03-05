<?php
$this->breadcrumbs=array(
	'Measurement Types',
);

$this->menu=array(
	array('label'=>'Create MeasurementType', 'url'=>array('create')),
	array('label'=>'Manage MeasurementType', 'url'=>array('admin')),
);
?>

<h1>Measurement Types</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
