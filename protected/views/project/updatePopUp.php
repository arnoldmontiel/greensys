<?php
$this->breadcrumbs=array(
	'Projects'=>array('index'),
	$model->description=>array('view','id'=>$model->Id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Project', 'url'=>array('index')),
	array('label'=>'Create Project', 'url'=>array('create')),
	array('label'=>'View Project', 'url'=>array('view', 'id'=>$model->Id)),
	array('label'=>'Manage Project', 'url'=>array('admin')),
);
?>

<h1>Update Project</h1>

<?php echo $this->renderPartial('_formPopUp', array('model'=>$model)); ?>