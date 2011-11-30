<?php
$this->breadcrumbs=array(
	'Entity Types'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List EntityType', 'url'=>array('index')),
	array('label'=>'Manage EntityType', 'url'=>array('admin')),
);
?>

<h1>Create EntityType</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>