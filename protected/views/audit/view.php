<?php
/* @var $this AuditController */
/* @var $model Audit */

$this->breadcrumbs=array(
	'Audits'=>array('index'),
	$model->Id,
);

$this->menu=array(
	array('label'=>'List Audit', 'url'=>array('index')),
	array('label'=>'Create Audit', 'url'=>array('create')),
	array('label'=>'Update Audit', 'url'=>array('update', 'id'=>$model->Id)),
	array('label'=>'Delete Audit', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->Id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Audit', 'url'=>array('admin')),
);
?>

<h1>View Audit #<?php echo $model->Id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'Id',
		'table_name',
		'operation',
		'date',
		'username',
		'Id_table',
	),
)); ?>
