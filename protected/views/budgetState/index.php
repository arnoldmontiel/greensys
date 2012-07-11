<?php
$this->breadcrumbs=array(
	'Budget States',
);

$this->menu=array(
	array('label'=>'Create BudgetState', 'url'=>array('create')),
	array('label'=>'Manage BudgetState', 'url'=>array('admin')),
);
?>

<h1>Budget States</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
