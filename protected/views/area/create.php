<?php
$this->breadcrumbs=array(
	'Areas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Area', 'url'=>array('index')),
	array('label'=>'Manage Area', 'url'=>array('admin')),
	array('label'=>'Assign Products', 'url'=>array('productArea')),
	array('label'=>'Assign Categories', 'url'=>array('categoryArea')),
	array('label'=>'Assign Services', 'url'=>array('serviceArea')),
);
?>

<h1>Create Area</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>