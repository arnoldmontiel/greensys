<?php
$this->breadcrumbs=array(
	'Nomenclators'=>array('index'),
	$model->description=>array('view','id'=>$model->Id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Nomenclator', 'url'=>array('index')),
	array('label'=>'Create Nomenclator', 'url'=>array('create')),
	array('label'=>'View Nomenclator', 'url'=>array('view', 'id'=>$model->Id)),
	array('label'=>'Manage Nomenclator', 'url'=>array('admin')),
);
?>

<h1>Update Nomenclator</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>