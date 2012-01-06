<?php
$this->breadcrumbs=array(
	'Services'=>array('index'),
	$model->description=>array('view','id'=>$model->Id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Service', 'url'=>array('index')),
	array('label'=>'Create Service', 'url'=>array('create')),
	array('label'=>'View Service', 'url'=>array('view', 'id'=>$model->Id)),
	array('label'=>'Manage Service', 'url'=>array('admin')),
	array('label'=>'Assing Categories', 'url'=>array('serviceCategory')),
);
?>

<h1>Update Service</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>