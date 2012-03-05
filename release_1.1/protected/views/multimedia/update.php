<?php
$this->breadcrumbs=array(
	'Multimedias'=>array('index'),
	$model->name=>array('view','id'=>$model->Id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Multimedia', 'url'=>array('index')),
	array('label'=>'Create Multimedia', 'url'=>array('create')),
	array('label'=>'View Multimedia', 'url'=>array('view', 'id'=>$model->Id)),
	array('label'=>'Manage Multimedia', 'url'=>array('admin')),
);
?>

<h1>Update Multimedia <?php echo $model->Id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>