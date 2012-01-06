<?php
$this->breadcrumbs=array(
	'Importers'=>array('index'),
	$model->Id=>array('view','id'=>$model->Id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Importer', 'url'=>array('index')),
	array('label'=>'Create Importer', 'url'=>array('create')),
	array('label'=>'View Importer', 'url'=>array('view', 'id'=>$model->Id)),
	array('label'=>'Manage Importer', 'url'=>array('admin')),
);
?>

<h1>Update Importer <?php echo $model->Id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'modelContact'=>$modelContact)); ?>