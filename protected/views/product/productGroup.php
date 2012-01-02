<?php
$this->breadcrumbs=array(
	'Products'=>array('index'),
	'Assing Products',
);
$this->menu=array(
	array('label'=>'List Product', 'url'=>array('index')),
	array('label'=>'Create Product', 'url'=>array('create')),
	array('label'=>'Manage Product', 'url'=>array('admin')),
);
$this->showSideBar = true;
Yii::app()->clientScript->registerScript('productGroup', "");

?>

<div class="form">
	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'productGroup-form',
		'enableAjaxValidation'=>true,
	)); ?>

	<div class="gridTitle-decoration1">
		<div class="gridTitle1">
		Products
		</div>
	</div>
	
	<?php
	$this->widget('zii.widgets.grid.CGridView', array(
					'id'=>'product-grid',
					'dataProvider'=>$model->searchSummary(),
					'filter'=>$model,
					'summaryText'=>'',
					'selectionChanged'=>'js:function(){
						$.fn.yiiGridView.update("productGroup-grid", {
							data: "Product[Id]="+$.fn.yiiGridView.getSelection("product-grid")
						});
						$.post("'.ProductController::createUrl('AjaxFillSidebar').'",
								{"Product[Id]":$.fn.yiiGridView.getSelection("product-grid")}
							).success(
								function(data) 
								{
									$("#sidebar").html(data);
									if(data!="")
									{
										$( "#sidebar" ).show();
									}
									else
									{
										$( "#sidebar" ).hide();	
									}	
								}
							);
						var idProduct = $.fn.yiiGridView.getSelection("product-grid");
						if(idProduct!="")
						{
							$( "#display" ).animate({opacity: "show"},"slow");
						}
						else
						{
							$( "#display" ).animate({opacity: "hide"},"slow");
						}
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
	),
	));
	?>
	<div id="display" style="display: none">
	<div class="gridTitle-decoration1">
		<div class="gridTitle1">
		Products Selection
		</div>
	</div>
	<?php 				
		$this->widget('zii.widgets.grid.CGridView', array(
			'id'=>'productChild-grid',
			'dataProvider'=>$model->searchSummary(),
			'filter'=>$model,
			'summaryText'=>'',	
			'selectionChanged'=>'js:function(){
				$.get(	"'.ProductController::createUrl('AjaxAddProductGroup').'",
						{
							IdProductParent:$.fn.yiiGridView.getSelection("product-grid"),
							IdProductChild:$.fn.yiiGridView.getSelection("productChild-grid")
						}).success(
							function() 
							{
								markAddedRow("productChild-grid");		
								$.fn.yiiGridView.update("productGroup-grid", {
								data: $(this).serialize()
								});
								unselectRow("productChild-grid");		
							}
						);
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
		Group
		</div>
	</div>
		<?php 				
		$this->widget('zii.widgets.grid.CGridView', array(
			'id'=>'productGroup-grid',
			'dataProvider'=>$modelProductGroup->searchProductChild(),
			'filter'=>$modelProductGroup,
			'summaryText'=>'',
			'columns'=>array(	
			array(
					 		'name'=>'product_code',
							'value'=>'$data->productChild->code',
			),
			array(
					 		'name'=>'product_supplier_business_name',
							'value'=>'$data->productChild->supplier->business_name',
			),
		
			array(
				 			'name'=>'product_brand_description',
							'value'=>'$data->productChild->brand->description',
			),		
			array(
					 		'name'=>'product_description_customer',
							'value'=>'$data->productChild->description_customer',
			),
			array(
				 			'name'=>'product_description_supplier',
							'value'=>'$data->productChild->description_supplier',
			),
						'quantity',
						array(
					'class'=>'CButtonColumn',
					'template'=>'{delete}',
					'buttons'=>array
					(
					        'delete' => array
							(
					            'url'=>'Yii::app()->createUrl("product/AjaxRemoveProductGroup", array("IdProductParent"=>$data->id_product_parent,"IdProductChild"=>$data->id_product_child))',
							),
					),
				),
		
			),			
			));		
		?>
	
	</div>
		
	
	<?php $this->endWidget(); ?>

</div><!-- form -->
