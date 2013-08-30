<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'product-grid',
	'dataProvider'=>$modelProduct->searchPending(),
	'filter'=>$modelProduct,
	'summaryText'=>'',
	'afterAjaxUpdate'=>'function(id, data){
		bindObjects();
	}',				
	'selectionChanged'=>'js:function(id){
		if($.fn.yiiGridView.getSelection(id)!="")
			openBudgetSelector(id);
	}',
	'columns'=>array(	
			array(
				'name'=>'model',
			    'value'=>'$data->model',
				'type'=>'raw'				 
			),
			array(
				'name'=>'part_number',
			    'value'=>'$data->part_number',
				'type'=>'raw'				 
			),
			array(
	 			'name'=>'brand_description',
				'value'=>'$data->brand->description',
				'type'=>'raw'				 
			),
			array(
				'name'=>'code',
			    'value'=>'CHtml::link($data->code,"#",array("id"=>$data->Id,"class"=>"link-popup"))',
				'type'=>'raw'				 
			),
			array(
		 		'name'=>'category_description',
				'value'=>'$data->category->description',
				'type'=>'raw'				 
			),
			'short_description',
		),
	));		
?>
<p class="messageError">
<?php echo Yii::app()->lc->t('Product has already been added to selected Purchase Order');?>
</p>
