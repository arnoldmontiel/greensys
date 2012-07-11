<?php
$this->breadcrumbs=array(
	'Purchase Orders'=>array('index'),
	$model->Id=>array('view','id'=>$model->Id),
	'Update',
);

$this->menu=array(
	array('label'=>'List PurchaseOrder', 'url'=>array('index')),
	array('label'=>'Create PurchaseOrder', 'url'=>array('create')),
	array('label'=>'View PurchaseOrder', 'url'=>array('view', 'id'=>$model->Id)),
	array('label'=>'Manage PurchaseOrder', 'url'=>array('admin')),
);
?>

<h1>Update PurchaseOrder <?php echo $model->Id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>