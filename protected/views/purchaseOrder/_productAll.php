<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'product-all-grid',
	'dataProvider'=>$modelProduct->search(),
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
				'name'=>'code',
			    'value'=>'CHtml::link($data->code,"#",array("id"=>$data->Id,"class"=>"link-popup"))',
				'type'=>'raw'				 
			),
			array(
				'name'=>'code_supplier',
			    'value'=>'$data->code_supplier',
			),
			array(
	 			'name'=>'brand_description',
				'value'=>'$data->brand->description',
			),
			array(
		 		'name'=>'category_description',
				'value'=>'$data->category->description',
			),
			'description_customer',
			'description_supplier',
		),
	));		
?>
<p class="messageError">
<?php echo Yii::app()->lc->t('Product has already been added to selected Purchase Order');?>
</p>
