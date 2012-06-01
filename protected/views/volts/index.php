<?php
$this->breadcrumbs=array(
	'Volts',
);

$this->menu=array(
	array('label'=>'Create Volts', 'url'=>array('create')),
	array('label'=>'Manage Volts', 'url'=>array('admin')),
);
?>

<h1>Volts</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
