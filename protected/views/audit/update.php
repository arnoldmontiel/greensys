<?php
/* @var $this AuditController */
/* @var $model Audit */

$this->breadcrumbs=array(
	'Audits'=>array('index'),
	$model->Id=>array('view','id'=>$model->Id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Audit', 'url'=>array('index')),
	array('label'=>'Create Audit', 'url'=>array('create')),
	array('label'=>'View Audit', 'url'=>array('view', 'id'=>$model->Id)),
	array('label'=>'Manage Audit', 'url'=>array('admin')),
);
?>

<h1>Update Audit <?php echo $model->Id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>