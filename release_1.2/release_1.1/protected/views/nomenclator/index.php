<?php
$this->breadcrumbs=array(
	'Nomenclators',
);

$this->menu=array(
	array('label'=>'Create Nomenclator', 'url'=>array('create')),
	array('label'=>'Manage Nomenclator', 'url'=>array('admin')),
);
?>

<h1>Nomenclators</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
