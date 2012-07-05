<?php
$this->breadcrumbs=array(
	'Areas'=>array('index'),
	$model->description=>array('view','id'=>$model->Id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Area', 'url'=>array('index')),
	array('label'=>'Create Area', 'url'=>array('create')),
	array('label'=>'View Area', 'url'=>array('view', 'id'=>$model->Id)),
	array('label'=>'Manage Area', 'url'=>array('admin')),
	array('label'=>'Assign Products', 'url'=>array('productArea','Area'=>array('Id'=>$model->Id))),
	array('label'=>'Assign Categories', 'url'=>array('categoryArea','Area'=>array('Id'=>$model->Id))),
	array('label'=>'Assign Services', 'url'=>array('serviceArea','Area'=>array('Id'=>$model->Id))),
);
?>

<h1>Update Area</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>