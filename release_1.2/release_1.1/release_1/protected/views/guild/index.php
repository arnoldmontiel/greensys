<?php
$this->breadcrumbs=array(
	'Guilds',
);

$this->menu=array(
	array('label'=>'Create Guild', 'url'=>array('create')),
	array('label'=>'Manage Guild', 'url'=>array('admin')),
);
?>

<h1>Guilds</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
