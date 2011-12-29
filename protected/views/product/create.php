<?php
$this->breadcrumbs=array(
	'Products'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Product', 'url'=>array('index')),
	array('label'=>'Manage Product', 'url'=>array('admin')),
	array('label'=>'Assign Groups', 'url'=>array('productGroup')),
);
?>

<h1>Create Product</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>