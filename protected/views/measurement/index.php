<?php
$this->breadcrumbs=array(
	'Measurements',
);

$this->menu=array(
	array('label'=>'Create Measurement', 'url'=>array('create')),
	array('label'=>'Manage Measurement', 'url'=>array('admin')),
);
?>

<h1>Measurements</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
