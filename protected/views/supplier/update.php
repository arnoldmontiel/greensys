<?php
$this->breadcrumbs=array(
	'Suppliers'=>array('index'),
	$model->business_name=>array('view','id'=>$model->Id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Supplier', 'url'=>array('index')),
	array('label'=>'Create Supplier', 'url'=>array('create')),
	array('label'=>'View Supplier', 'url'=>array('view', 'id'=>$model->Id)),
	array('label'=>'Manage Supplier', 'url'=>array('admin')),
);
?>

<h1>Update Supplier <?php echo $model->Id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'modelContact'=>$modelContact,'modelHyperlink'=>$modelHyperlink)); ?>