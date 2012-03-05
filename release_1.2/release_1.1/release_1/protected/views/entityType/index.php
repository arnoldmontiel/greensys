<?php
$this->breadcrumbs=array(
	'Entity Types',
);

$this->menu=array(
	array('label'=>'Create EntityType', 'url'=>array('create')),
	array('label'=>'Manage EntityType', 'url'=>array('admin')),
);
?>

<h1>Entity Types</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
