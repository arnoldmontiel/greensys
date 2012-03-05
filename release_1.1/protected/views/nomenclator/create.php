<?php
$this->breadcrumbs=array(
	'Nomenclators'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Nomenclator', 'url'=>array('index')),
	array('label'=>'Manage Nomenclator', 'url'=>array('admin')),
);
?>

<h1>Create Nomenclator</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>