<?php
$this->breadcrumbs=array(
	'Product'=>array('index'),
	'Assing Requirement',
);
$this->menu=array(
	array('label'=>'Create Product', 'url'=>array('create')),
	array('label'=>'Manage Product', 'url'=>array('admin')),
	array('label'=>'Assign Groups', 'url'=>array('productGroup')),
	array('label'=>'Assign Requirements', 'url'=>array('productRequirement')),
	array('label'=>'Manage Import', 'url'=>array('adminImport')),
	array('label'=>'Import From Excel', 'url'=>array('importFromExcel')),
	array('label'=>'Manage Measures Import', 'url'=>array('adminMeasuresImport')),
	array('label'=>'Import Measures From Excel', 'url'=>array('importMeasuresFromExcel')),
	
);
$this->showSideBar = true;
Yii::app()->clientScript->registerScript('productRequirement', "

loadGrid();
function loadGrid()
{
	selectSpecificRow('product-grid', '".$modelProductRequirement->Id_product."');
	gridSelectionChange();
	
	
}

function gridSelectionChange()
{
	var idProduct = '".$modelProductRequirement->Id_product."';
	
	if(idProduct!='')
	{
		$( '#display' ).animate({opacity: 'show'},'slow');
	}
	else
	{
		$( '#display' ).animate({opacity: 'hide'},'slow');
	}
	
	$.post('".ProductController::createUrl('AjaxFillSidebar')."',
			{'Product[Id]':idProduct}
		).success(
			function(data) 
			{
				$('#sidebar').html(data);
				if(data!='')
				{
					$( '#sidebar' ).show();
				}
				else
				{
					$( '#sidebar' ).hide();	
				}	
			}
						);
						
}
",CClientScript::POS_END);
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
							'model',
							'part_number',
							'code',
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
							'short_description',
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
							function(data)
							{
								$(".messageError").html(data.responseText);
								$(".messageError").animate({opacity: "show"},2000.,function(){$(".messageError").animate({opacity: "hide"},2000)});
								unselectRow("requirement-grid");
							}
						);
				}',
				'columns'=>array(	
					array(
				 			'name'=>'internal',
							'value'=>'CHtml::checkBox("internal",$data->internal,array("disabled"=>"disabled"))',
							'type'=>'raw',
								'filter'=>CHtml::listData(
									array(
										array('id'=>'0','value'=>'No'),
										array('id'=>'1','value'=>'Yes')
									)
									,'id','value'
								),				
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
								'filter'=>CHtml::listData(
									array(
										array('id'=>'0','value'=>'No'),
										array('id'=>'1','value'=>'Yes')
									)
									,'id','value'
								),				
				),
				array(
						 		'name'=>'description_short',
								'value'=>'$data->productRequirement->description_short',
				),
			array(
								 			'name'=>'guild',
											'value'=>'$data->productRequirement->guild->description',
			),
				array(
						 		'name'=>'model',
								'value'=>'$data->product->model',
				),
			
				array(
					 			'name'=>'part_number',
								'value'=>'$data->product->part_number',
				),						
				array(
					 			'name'=>'code',
								'value'=>'$data->product->code',
				),
				array(
										 		'name'=>'short_description',
												'value'=>'$data->product->short_description',
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
