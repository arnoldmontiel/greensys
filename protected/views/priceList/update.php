<?php
$this->breadcrumbs=array(
	'Price Lists'=>array('index'),
	$model->description=>array('view','id'=>$model->Id),
	'Update',
);

$this->menu=array(
	array('label'=>'Create PriceList', 'url'=>array('create')),
	array('label'=>'Manage PriceList', 'url'=>array('admin')),
	array('label'=>'View PriceList', 'url'=>array('view', 'id'=>$model->Id)),
	array('label'=>'Assing Products', 'url'=>array('priceListItem','PriceList'=>array('Id'=>$model->Id))),
	array('label'=>'Clone PriceList', 'url'=>array('clonePriceList')),
);
?>

<h1>Update PriceList</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>