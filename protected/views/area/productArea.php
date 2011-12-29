<?php
$this->breadcrumbs=array(
	'Areas'=>array('index'),
	'Assing Products',
);
$this->menu=array(
	array('label'=>'List Area', 'url'=>array('index')),
	array('label'=>'Create Area', 'url'=>array('create')),
	array('label'=>'Manage Area', 'url'=>array('admin')),
	array('label'=>'Assign Categories', 'url'=>array('categoryArea')),
	array('label'=>'Assign Services', 'url'=>array('serviceArea')),
);

Yii::app()->clientScript-> registerScript('update', "
				$('#Area_Id').change(function(){
					$.fn.yiiGridView.update('productArea-grid', {
						data: $(this).serialize()
					});
					if($('#Area_Id :selected').attr('value')=='')
					{
						$( '#display' ).animate({opacity: 'hide'},'slow');
					}
					else
					{
						$( '#display' ).animate({opacity: 'show'},'slow');
					}
					return false;
				});
				");
?>
<div class="form">
	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'productArea-form',
		'enableAjaxValidation'=>true,
	)); ?>

	<div style="row;width:100%;margin:2px;">
		<?php echo $form->labelEx($model,'Area'); ?>
		<?php echo $form->dropDownList($model, 
			'Id',
			CHtml::listData($model->findAll(), 'Id', 'description'),
			array('prompt'=>'Select an Area')
		);
		?>				
		</div>

	<div id="display" class="selectablesItems" style="display:none;">
	<div class="gridTitle-decoration1">
	<div class="gridTitle1">
	Products Selection
	</div>
	</div>
	
	<?php		
	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'product-grid',
		'dataProvider'=>$modelProduct->searchSummary(),
		'filter'=>$modelProduct,
		'summaryText'=>'',
		'selectionChanged'=>'js:function(){
			$.get(	"'.AreaController::createUrl('AjaxAddProductArea').'",
					{
						IdArea:$("#Area_Id :selected").attr("value"),
						IdProduct:$.fn.yiiGridView.getSelection("product-grid")
					}).success(
						function() 
						{
							markAddedRow("product-grid");
							$.fn.yiiGridView.update("productArea-grid", {
							data: $(this).serialize()
							});
						});
		}',
	'columns'=>array(
			array(
					 		'name'=>'code',
							'value'=>'$data->code',
			),
	
			array(
					 		'name'=>'supplier_description',
							'value'=>'$data->supplier->business_name',
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
			array(
					'value'=>'CHtml::image("images/save_ok.png","",array("id"=>"addok", "style"=>"display:none; float:left;", "width"=>"15px", "height"=>"15px"))',
					'type'=>'raw',
					'htmlOptions'=>array('width'=>20),
			),
	
			),
		));		
		?>
		<div class="gridTitle-decoration1">
		<div class="gridTitle1">
		Products Applied
		</div>
		</div>
		
		<?php 				
		$this->widget('zii.widgets.grid.CGridView', array(
			'id'=>'productArea-grid',
			'dataProvider'=>$modelProductArea->searchProduct(),
			'filter'=>$modelProductArea,
			'summaryText'=>'',
			'columns'=>array(	
			array(
					 		'name'=>'product_code',
							'value'=>'$data->product->code',
			),
			array(
					 		'name'=>'product_supplier_business_name',
							'value'=>'$data->product->supplier->business_name',
			),
		
			array(
				 			'name'=>'product_brand_description',
							'value'=>'$data->product->brand->description',
			),		
			array(
					 		'name'=>'product_description_customer',
							'value'=>'$data->product->description_customer',
			),
			array(
				 			'name'=>'product_description_supplier',
							'value'=>'$data->product->description_supplier',
			),
						'quantity',
				array(
					'class'=>'CButtonColumn',
					'template'=>'{delete}',
					'buttons'=>array
					(
					        'delete' => array
							(
					            'url'=>'Yii::app()->createUrl("area/AjaxRemoveProductArea", array("IdArea"=>$data->id_area,"IdProduct"=>$data->id_product))',
							),
					),
				),
		
			),			
			));		
		?>
		</div>
	
	<?php $this->endWidget(); ?>
</div><!-- form -->
