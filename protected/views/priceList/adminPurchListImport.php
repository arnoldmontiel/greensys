<?php
$this->breadcrumbs=array(
	'Price Lists'=>array('index'),
	'Manage Import',
);

$this->menu=array(
	array('label'=>'Create PriceList', 'url'=>array('create')),
	array('label'=>'Manage PriceList', 'url'=>array('admin')),
	array('label'=>'Import Purch List from Excel', 'url'=>array('importPurchListFromExcel')),
);

Yii::app()->clientScript->registerScript('admin-measures-import', "

$('.btn-download-file').click(function(){
	var fileName = $(this).attr('fileName');
	var root = 'docs';
	$(this).attr('src')
	$.post('".ProductController::createUrl('AjaxDownloadFile')."',
				{
					fileName: fileName,
					root: root 
				}
				).success(
					function(data) 
								{
								
								}
							);
});

");

?>

<h1>Manage Measures Import</h1>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'measures-import-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(				
			'original_file_name',
			array(
					'name'=>'supplier_description',
					'value'=>'$data->supplier->business_name',
				),			
			array(
					'name'=>'priceList_description',
					'value'=>'$data->priceList->description',
			),
			'not_found_model',
			'creation_date',
	),
)); ?>
