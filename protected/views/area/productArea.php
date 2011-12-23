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
?>
<div class="form">
	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'productArea-form',
		'enableAjaxValidation'=>true,
	)); ?>

	<div style="row;width:100%;margin:2px;">
		<?php
		Yii::app()->clientScript->registerScript('update', "
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
		<?php echo $form->labelEx($model,'Area'); ?>
		<?php echo $form->dropDownList($model, 
			'Id',
			CHtml::listData($model->findAll(), 'Id', 'description'),
			array('prompt'=>'Select an Area')
		);
		?>				
		</div>

	<div id="display" class="selectablesItems" style="display:none;">
	<?php		
	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'product-grid',
		'dataProvider'=>$modelProduct->searchSummary(),
		'filter'=>$modelProduct,
		'selectionChanged'=>'js:function(){
			$.get(	"'.AreaController::createUrl('AjaxAddProductArea').'",
					{
						IdArea:$("#Area_Id :selected").attr("value"),
						IdProduct:$.fn.yiiGridView.getSelection("product-grid")
					}).success(
						function() 
						{
							$.fn.yiiGridView.update("productArea-grid", {
							data: $(this).serialize()
							});
						});
		}',
	'columns'=>array(
			array('name'=>'Id',
						'value'=>'$data->Id',
						'visible'=>false,
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
			),
		));		
		?>
		<?php 				
		$this->widget('zii.widgets.grid.CGridView', array(
			'id'=>'productArea-grid',
			'dataProvider'=>$modelProductArea->searchProduct(),
			'filter'=>$modelProductArea,
			'columns'=>array(	
				array('name'=>'Id',
				'value'=>'$data->Id',
				'visible'=>false,
				),
			array(
					 		'name'=>'product_description_customer',
							'value'=>'$data->product->description_customer',
			),
			array(
				 			'name'=>'product_description_supplier',
							'value'=>'$data->product->description_supplier',
			),
			array(
				 			'name'=>'product_brand_description',
							'value'=>'$data->product->brand->description',
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
