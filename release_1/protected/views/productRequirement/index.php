<?php
$this->breadcrumbs=array(
	'Product Requirements',
);

$this->menu=array(
	array('label'=>'Create ProductRequirement', 'url'=>array('create')),
	array('label'=>'Manage ProductRequirement', 'url'=>array('admin')),
);
?>

<h1>Product Requirements</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
