<?php
$this->breadcrumbs=array(
	'Multimedias'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Multimedia', 'url'=>array('index')),
	array('label'=>'Manage Multimedia', 'url'=>array('admin')),
);
?>

<h1>Create Multimedia</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>