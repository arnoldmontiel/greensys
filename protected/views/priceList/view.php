<?php
$this->breadcrumbs=array(
	'Price Lists'=>array('index'),
	$model->description,
);

$this->menu=array(
	array('label'=>'List PriceList', 'url'=>array('index')),
	array('label'=>'Create PriceList', 'url'=>array('create')),
	array('label'=>'Update PriceList', 'url'=>array('update', 'id'=>$model->Id)),
	array('label'=>'Delete PriceList', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->Id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage PriceList', 'url'=>array('admin')),
	array('label'=>'Assing Products', 'url'=>array('priceListItem')),
);
?>

<h1>View PriceList</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'description',
		'date_creation',
		'date_validity',
		array('label'=>$model->getAttributeLabel('validity'),
			'type'=>'raw',
			'value'=>CHtml::checkBox("validity",$model->validity,array("disabled"=>"disabled"))
		),
		array('label'=>$model->getAttributeLabel('Id_supplier'),
			'type'=>'raw',
			'value'=>$model->supplier->business_name
		),
),
)); ?>
