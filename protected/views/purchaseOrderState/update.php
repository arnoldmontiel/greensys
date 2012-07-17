<?php
$this->breadcrumbs=array(
	'Purchase Order States'=>array('index'),
	$model->Id=>array('view','id'=>$model->Id),
	'Update',
);

$this->menu=array(
	array('label'=>'List PurchaseOrderState', 'url'=>array('index')),
	array('label'=>'Create PurchaseOrderState', 'url'=>array('create')),
	array('label'=>'View PurchaseOrderState', 'url'=>array('view', 'id'=>$model->Id)),
	array('label'=>'Manage PurchaseOrderState', 'url'=>array('admin')),
);
?>

<h1>Update PurchaseOrderState <?php echo $model->Id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>