<?php
$this->breadcrumbs=array(
	'Settings'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Manage Setting', 'url'=>array('admin')),
);
?>

<h1>Create Setting</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>