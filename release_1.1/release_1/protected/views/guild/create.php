<?php
$this->breadcrumbs=array(
	'Guilds'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Guild', 'url'=>array('index')),
	array('label'=>'Manage Guild', 'url'=>array('admin')),
);
?>

<h1>Create Guild</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>