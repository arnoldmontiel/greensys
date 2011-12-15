<?php
$this->breadcrumbs=array(
	'Price List Items'=>array('index'),
	$model->Id=>array('view','id'=>$model->Id),
	'Update',
);

$this->menu=array(
	array('label'=>'List PriceListItem', 'url'=>array('index')),
	array('label'=>'Create PriceListItem', 'url'=>array('create')),
	array('label'=>'View PriceListItem', 'url'=>array('view', 'id'=>$model->Id)),
	array('label'=>'Manage PriceListItem', 'url'=>array('admin')),
);
?>

<h1>Update PriceListItem <?php echo $model->Id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>