<?php
/* @var $this InitCustomerController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Init Customers',
);

$this->menu=array(
	array('label'=>'Create InitCustomer', 'url'=>array('create')),
	array('label'=>'Manage InitCustomer', 'url'=>array('admin')),
);
?>

<h1>Init Customers</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
