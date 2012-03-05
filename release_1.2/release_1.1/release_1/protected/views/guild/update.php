<?php
$this->breadcrumbs=array(
	'Guilds'=>array('index'),
	$model->description=>array('view','id'=>$model->Id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Guild', 'url'=>array('index')),
	array('label'=>'Create Guild', 'url'=>array('create')),
	array('label'=>'View Guild', 'url'=>array('view', 'id'=>$model->Id)),
	array('label'=>'Manage Guild', 'url'=>array('admin')),
);
?>

<h1>Update Guild</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>