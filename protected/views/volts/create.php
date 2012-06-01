<?php
$this->breadcrumbs=array(
	'Volts'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Volts', 'url'=>array('index')),
	array('label'=>'Manage Volts', 'url'=>array('admin')),
);
?>

<h1>Create Volts</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>