<?php
$this->breadcrumbs=array(
	'Importers',
);

$this->menu=array(
	array('label'=>'Create Importer', 'url'=>array('create')),
	array('label'=>'Manage Importer', 'url'=>array('admin')),
);
?>

<h1>Importers</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
