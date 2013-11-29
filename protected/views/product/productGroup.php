<?php
$this->breadcrumbs=array(
	'Products'=>array('index'),
	'Assing Products',
);
$this->menu=array(
array('label'=>'Create Product', 'url'=>array('create')),
array('label'=>'Manage Product', 'url'=>array('admin')),
array('label'=>'Assign Requirements', 'url'=>array('productRequirement')),
array('label'=>'Manage Import', 'url'=>array('adminImport')),
array('label'=>'Import From Excel', 'url'=>array('importFromExcel')),
array('label'=>'Manage Measures Import', 'url'=>array('adminMeasuresImport')),
array('label'=>'Import Measures From Excel', 'url'=>array('importMeasuresFromExcel')),

);
$this->showSideBar = true;
Yii::app()->clientScript->registerScript('productGroup', "

loadGrid();
function loadGrid()
{
	selectSpecificRow('product-grid', '".$modelProductGroup->Id_product_parent."');
	gridSelectionChange();
	
	
}

function gridChangeSelectedRow()
{
	$.fn.yiiGridView.update('productGroup-grid', {
							data: 'Product[Id]='+$.fn.yiiGridView.getSelection('product-grid')
						});
						$.post('".ProductController::createUrl('AjaxFillSidebar')."',
								{'Product[Id]':$.fn.yiiGridView.getSelection('product-grid')}
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
						var idProduct = $.fn.yiiGridView.getSelection('product-grid');
						if(idProduct!='')
						{
							$( '#display' ).animate({opacity: 'show'},'slow');
						}
						else
						{
							$( '#display' ).animate({opacity: 'hide'},'slow');
						}
}

function gridSelectionChange()
{
	var idProduct = '".$modelProductGroup->Id_product_parent."';
	
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
		'id'=>'productGroup-form',
		'enableAjaxValidation'=>true,
	)); ?>

	<div class="gridTitle-decoration1">
		<div class="gridTitle1">
		Product Parent
		</div>
	</div>
	
	<?php
	$this->widget('zii.widgets.grid.CGridView', array(
					'id'=>'product-grid',
					'dataProvider'=>$model->searchSummary(),
					'filter'=>$model,
					'summaryText'=>'',
					'selectableRows'=>0,
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
								array
								(
								    'class'=>'CButtonColumn',
								    'template'=>'{selectRowBtn}',
								    'buttons'=>array
									(
								        'selectRowBtn' => array
											(
												'imageUrl'=>'images/rbn_no.png',
									            'click'=>'function(){
									            		if($(this).parent().parent().hasClass("selected"))
									            		{
									            			$(this).children().attr("src","images/rbn_no.png");
									            			$("#product-grid").find("tr").removeClass("selected");
									            		}
									            		else
									            		{
									            			$("#product-grid").find("tr").removeClass("selected");
									            			$("#product-grid").find(".selectRowBtn").children().attr("src","images/rbn_no.png");
									            			$(this).parent().parent().addClass("selected");
									            			$(this).children().attr("src","images/rbn_yes.png")
									            		}
									            		gridChangeSelectedRow();
									            		return false;
													}',
											),
								        
									),
								),
									
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
			'selectableRows'=>0,	
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
			array
			(
					'class'=>'CButtonColumn',
					'template'=>'{agregar}',
					'buttons'=>array
					(
							'agregar' => array
							(
									'click'=>'function(){
				            			$(this).parent().parent().addClass("selected");
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
				            		return false;
								}',
							),
			
					),
			),
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
		Product Children
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
							 		'name'=>'product_model',
									'value'=>'$data->productChild->model',
			),
		array(
							 		'name'=>'product_part_number',
									'value'=>'$data->productChild->part_number',
		),		
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
							 		'name'=>'product_short_description',
									'value'=>'$data->productChild->short_description',
			),
						'quantity',
						array(
					'class'=>'CButtonColumn',
					'template'=>'{delete}',
					'buttons'=>array
					(
					        'delete' => array
							(
					            'url'=>'Yii::app()->createUrl("product/AjaxRemoveProductGroup", array("IdProductParent"=>$data->Id_product_parent,"IdProductChild"=>$data->Id_product_child))',
							),
					),
				),
		
			),			
			));		
		?>
	
	</div>
		
	
	<?php $this->endWidget(); ?>

</div><!-- form -->
