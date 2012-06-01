<?php
$this->breadcrumbs=array(
	'Products'=>array('index'),
	$model->code=>array('view','id'=>$model->Id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Product', 'url'=>array('index')),
	array('label'=>'Create Product', 'url'=>array('create')),
	array('label'=>'View Product', 'url'=>array('view', 'id'=>$model->Id)),
	array('label'=>'Manage Product', 'url'=>array('admin')),
	array('label'=>'Assign Groups', 'url'=>array('productGroup')),
	array('label'=>'Assign Requirements', 'url'=>array('productRequirement')),
);
?>

<h1>Update Product <?php echo $model->code; ?></h1>

<?php echo $this->renderPartial('_form', array(
											'model'=>$model,
											'modelHyperlink'=>$modelHyperlink,
											'modelNote'=>$modelNote,
											'ddlSubCategory'=>$ddlSubCategory,
											'ddlRacks'=>$ddlRacks,
											)); ?>