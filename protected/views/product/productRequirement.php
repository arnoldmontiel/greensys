<?php
$this->breadcrumbs=array(
	'Product'=>array('index'),
	'Assing Requirement',
);
$this->menu=array(
	array('label'=>'List Product', 'url'=>array('index')),
	array('label'=>'Create Project', 'url'=>array('create')),
	array('label'=>'Manage Project', 'url'=>array('admin')),
	array('label'=>'Assign Groups', 'url'=>array('productGroup')),
);
$this->showSideBar = true;
Yii::app()->clientScript->registerScript('productRequirement', "");

?>

<div class="form">
	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'productRequirement-form',
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
						$.fn.yiiGridView.update("productRequirement-grid", {
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
			Requirement Selection
			</div>
		</div>
		<?php 				
			$this->widget('zii.widgets.grid.CGridView', array(
				'id'=>'requirement-grid',
				'dataProvider'=>$modelRequirement->searchProductReq(),
				'filter'=>$modelRequirement,
				'summaryText'=>'',	
				'selectionChanged'=>'js:function(){
					$.get(	"'.ProductController::createUrl('AjaxAddProductRequirement').'",
							{
								IdProduct:$.fn.yiiGridView.getSelection("product-grid"),
								IdRequirement:$.fn.yiiGridView.getSelection("requirement-grid")
							}).success(
								function() 
								{
									markAddedRow("requirement-grid");		
									$.fn.yiiGridView.update("productRequirement-grid", {
									data: $(this).serialize()
									});
									unselectRow("requirement-grid");		
								}
							 
							)
						.error(
							function()
							{
								$(".messageError").animate({opacity: "show"},2000);
								$(".messageError").animate({opacity: "hide"},2000);
							}
						);
				}',
				'columns'=>array(	
					array(
				 			'name'=>'internal',
							'value'=>'CHtml::checkBox("internal",$data->internal,array("disabled"=>"disabled"))',
							'type'=>'raw',
					),
					'description_short',
					array(
				 			'name'=>'guild_description',
							'value'=>'$data->guild->description',
					),
				
				),
			));		
			?>
			<p class="messageError"><?php
			echo Yii::app()->lc->t('Relation already exists');
			?></p>
			<div class="gridTitle-decoration1">
				<div class="gridTitle1">
					Relation
				</div>
			</div>
			<?php 				
			$this->widget('zii.widgets.grid.CGridView', array(
				'id'=>'productRequirement-grid',
				'dataProvider'=>$modelProductRequirement->searchProductReqProd(),
				'filter'=>$modelProductRequirement,
				'summaryText'=>'',
				'columns'=>array(	
				array(
					 			'name'=>'internal',
								'value'=>'CHtml::checkBox("internal",$data->productRequirement->internal,array("disabled"=>"disabled"))',
								'type'=>'raw',
				),
				array(
						 		'name'=>'description_short',
								'value'=>'$data->productRequirement->description_short',
				),
			
				array(
					 			'name'=>'description_customer',
								'value'=>'$data->product->description_customer',
				),		
				array(
						 		'name'=>'description_supplier',
								'value'=>'$data->product->description_supplier',
				),
				array(
					 			'name'=>'code',
								'value'=>'$data->product->code',
				),
				array(
					 			'name'=>'guild',
								'value'=>'$data->productRequirement->guild->description',
				),
							array(
						'class'=>'CButtonColumn',
						'template'=>'{delete}',
						'buttons'=>array
						(
						        'delete' => array
								(
						            'url'=>'Yii::app()->createUrl("product/AjaxRemoveProductRequirement", array("IdProduct"=>$data->Id_product,"IdRequirement"=>$data->Id_product_requirement))',
								),
						),
					),
			
				),			
				));		
			?>
			
		</div>
		<?php $this->endWidget(); ?>

	<div id="display"></div>
</div><!-- form -->
