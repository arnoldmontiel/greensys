<?php
$this->breadcrumbs=array(
	'Categories'=>array('index'),
	$model->description,
);

$this->menu=array(
	array('label'=>'List Category', 'url'=>array('index')),
	array('label'=>'Create Category', 'url'=>array('create')),
	array('label'=>'Update Category', 'url'=>array('update', 'id'=>$model->Id)),
	array('label'=>'Delete Category', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->Id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Category', 'url'=>array('admin')),
	array('label'=>'Assign Sub Category', 'url'=>array('assignSubCategory','Category'=>array('Id'=>$model->Id))),
);
?>

<h1>View Category</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'description',
	),
)); ?>

<?php 
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'price-list-item-grid',
	'dataProvider'=>$modelCategorySubCategory->search(),
 	'filter'=>$modelCategorySubCategory,
	'summaryText'=>'',
	'columns'=>array(
				array(
					'name'=>'subCategory_description',
					'value'=>'$data->subCategory->description',
					'type'=>'raw'
				),
			),
)); ?>
