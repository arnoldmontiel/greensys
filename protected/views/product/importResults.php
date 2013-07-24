<?php
/* @var $this AutoRipperController */
/* @var $model AutoRipper */
Yii::app()->clientScript->registerScript('admin-import-results', "

$('.btn-merge-product').click(function(){
	var id = $(this).attr('id');
	var idImport = $('#idImport').val();
	window.location = '".ProductController::createUrl('mergeProduct')."' + '&id='+id + '&idImport='+idImport;
	return false;
});
");

$this->menu=array(
	array('label'=>'List Product', 'url'=>array('index')),
	array('label'=>'Create Product', 'url'=>array('create')),
	array('label'=>'Manage Product', 'url'=>array('admin')),
	array('label'=>'Assign Groups', 'url'=>array('productGroup')),
	array('label'=>'Assign Requirements', 'url'=>array('productRequirement')),
	array('label'=>'Manage Import', 'url'=>array('adminImport')),
	array('label'=>'Import From Excel', 'url'=>array('importFromExcel')),
);
?>

<h1>Resultados Import</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'file_name',
		'insert_rows',
		'already_exist_rows',
		'total_rows',
		'error_rows',
		'import_code',
		'date',		
	),
)); ?>

<?php 
echo CHtml::hiddenField('idImport',$model->Id,array('id'=>'idImport'));
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'product-grid',
	'summaryText'=>'',
	'afterAjaxUpdate'=>'js:function(){
				$("#product-grid").find(".btn-merge-product").each(
						function(index, item){
							$(item).click(function(){
								var id = $(this).attr("id");
								window.location = "'.ProductController::createUrl('mergeProduct').'" + "&id="+id;
								return false;								
															
							});
						});

			}',
	'dataProvider'=>$modelProduct->searchDuplicade(),
	'filter'=>$modelProduct,
	'columns'=>array(
			array(
		 		'name'=>'code',
				'value'=>'$data->code',
			),			
			array(
		 		'name'=>'model',
				'value'=>'$data->model',
			),					
			array(
	 			'name'=>'brand_description',
				'value'=>'$data->brand->description',
			),
			array(
		 		'name'=>'category_description',
				'value'=>'$data->category->description',
			),
			array(				
				'htmlOptions' => array('style'=>'width:100px;'),
			 	'type'=>'raw',
			 	'value'=>'CHtml::button("Unificar datos",array("id"=>$data->Id, "class"=>"btn-merge-product"))',			 			
			),	
	),
)); ?>