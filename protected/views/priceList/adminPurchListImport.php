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

$('.link-download-file').click(function(){
	var fileName = $(this).attr('fileName');
	var root = 'docs';
	var href = '".PriceListController::createUrl('AjaxDownloadFile')."';
	var params = '&fileName='+fileName + '&root='+root;
	$(this).attr('href',href+params);
	
});

");

?>

<h1>Manage Purch List Import</h1>


<?php 
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'purch-list-import-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'afterAjaxUpdate'=>'js:function(){
				$("#purch-list-import-grid").find(".link-download-file").each(
						function(index, item){
							$(item).click(function(){
									var fileName = $(this).attr("fileName");
									var root = "docs";
									var href = "'.PriceListController::createUrl('AjaxDownloadFile').'";
									var params = "&fileName="+fileName + "&root="+root;
									$(this).attr("href",href+params);				
															
							});
						});
		}',
	'columns'=>array(		
			array(
					'name'=>'original_file_name',
					'value'=>'CHtml::link($data->original_file_name,"",array("class"=>"link-download-file", "fileName"=>$data->file_name))',
					'type'=>'raw'
			),
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
