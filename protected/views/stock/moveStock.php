<?php
$this->breadcrumbs=array(
	'Stocks'=>array('index'),
	$model->movementType->description,
);

$this->menu=array(
	array('label'=>'List Stock', 'url'=>array('index')),
	array('label'=>'Create Stock', 'url'=>array('create')),
	array('label'=>'Update Stock', 'url'=>array('update', 'id'=>$model->Id)),
	array('label'=>'Delete Stock', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->Id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Stock', 'url'=>array('admin')),
);
Yii::app()->clientScript->registerScript(__CLASS__.'move-stock', "
$('#product-grid').attr('style','display:none;');
$('#stock-item-grid').find('input.txtQuantity').each(
												function(index, item){
																$(item).keyup(function(){
			        												validateNumber($(this));
																});
												
																$(item).change(function(){
																	
																	var target = $(this);
																	
																	$.post(
																		'".StockController::createUrl("AjaxUpdateQuantity")."',
																		 {
																		 	idStockItem: $(this).attr('id'),
																			quantity:$(this).val()
																		 },
																	 	function(data) 
																	 		{	
																				$(target).val(data.quantity);
 																	 			$(target).parent().parent().find('#saveok').animate({opacity: 'show'},4000);
																				$(target).parent().parent().find('#saveok').animate({opacity: 'hide'},4000);
																			},
																		'json');
																				
																});
													});	
");

?>

<h1>Move Stock</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
			array('label'=>$model->getAttributeLabel('Id_movement_type'),
			'type'=>'raw',
			'value'=>$model->movementType->description
		),
		array('label'=>$model->getAttributeLabel('Id_project'),
			'type'=>'raw',
			'value'=>isset($model->project)?$model->project->description:""
		),
		'username',
		'creation_date',
		'description',
	),
)); ?>

<br>
<div id="display">
	 
<div class="gridTitle-decoration1" style="display: inline-block; width: 97%;height: 35px;margin-bottom:10px">
	<div class="gridTitle1" style="display: inline-block;position: relative; width: 90%;vertical-align: top; margin-top: 4px;">
		<?php 		echo CHtml::link('+ Select Products',
						'#',
						array(	'id'=>'expand-products',
								'onclick'=>'
									jQuery("#product-grid").toggle("blind",{},1000);
									if($(this).html()=="+ Select Products")
									{
										$(this).html("- Select Products");
									}
									else
									{
										$(this).html("+ Select Products");
									}
									return false;
								'
								)
							)
		?>
		<?php echo CHtml::link( '(New Product)','#',array('onclick'=>'jQuery("#CreateProduct").dialog("open"); return false;'));?>
		
	</div>
	
</div>
<?php		
	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'product-grid',
		'dataProvider'=>$modelProduct->searchSummary(),
		'filter'=>$modelProduct,
		'summaryText'=>'',	
		'selectionChanged'=>'js:function(id){
			$.get(	"'.StockController::createUrl('AjaxMoveProductStock').'",
					{
						IdStock:"'.$model->Id.'",
						IdProduct:$.fn.yiiGridView.getSelection("product-grid")
					}).success(
						function() 
						{
							markAddedRow("product-grid");
							
							$.fn.yiiGridView.update("stock-item-grid", {
							data: $(this).serialize()
							});
							
							unselectRow("product-grid");		
						})
					.error(
						function()
						{
							$(".messageError").animate({opacity: "show"},2000);
							$(".messageError").animate({opacity: "hide"},2000);
							unselectRow("product-grid");
						});
		}',
		'columns'=>array(	
				array(
					'name'=>'code',
				    'value'=>'$data->code',
				 
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
				array(
					'value'=>'CHtml::image("images/save_ok.png","",array("id"=>"addok", "style"=>"display:none; float:left;", "width"=>"15px", "height"=>"15px"))',
					'type'=>'raw',
					'htmlOptions'=>array('width'=>20),
				),
			),
		));		
		?>	

	<p class="messageError"><?php
		echo Yii::app()->lc->t('Product has already been added');
		?></p>

	<div class="gridTitle-decoration1" style="display: inline-block; width: 97%;height: 35px;">
		<div class="gridTitle1" style="display: inline-block;position: relative; width: 90%;vertical-align: top; margin-top: 4px;">
			Moved Stock
		</div>
	</div>
			<?php 

$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'stock-item-grid',
	'dataProvider'=>$modelStockItem->search(),
 	'filter'=>$modelStockItem,
	'summaryText'=>'',
 	'afterAjaxUpdate'=>'function(id, data){
 										$("#stock-item-grid").find("input.txtQuantity").each(
												function(index, item){
																$(item).keyup(function(){
			        												validateNumber($(this));
																});
												
																$(item).change(function(){
																	
																	var target = $(this);
																	
																	$.post(
																		"'.StockController::createUrl('AjaxUpdateQuantity').'",
																		 {
																		 	idStockItem: $(this).attr("id"),
																			quantity:$(this).val()
																		 },
																	 	function(data) 
																	 		{	
																				$(target).val(data.quantity);
 																	 			$(target).parent().parent().find("#saveok").animate({opacity: "show"},4000);
																				$(target).parent().parent().find("#saveok").animate({opacity: "hide"},4000);
																			},
																		"json");
																		
																});
													});	
 									}',	
	'columns'=>array(
				array(
					'name'=>'product_code',
				    'value'=>'$data->product->code',
				 
				),
				array(
					'name'=>'product_code_supplier',
				    'value'=>'$data->product->code_supplier',
	
				),
				array(
					'name'=>'product_customer_desc',
				    'value'=>'$data->product->description_customer',
	
				),
				array(
 					'name'=>'product_brand_desc',
				    'value'=>'$data->product->brand->description',
	
				),
				array(
 					'name'=>'product_supplier_name',
				    'value'=>'$data->product->supplier->business_name',

				),
				array(
					'name'=>'quantity',
					'value'=>
                                    	'CHtml::textField("txtQuantity",
												$data->quantity,
												array(
														"id"=>$data->Id,
														"class"=>"txtQuantity",
														"style"=>"width:50px;text-align:right;",
													)
											)',
							
					'type'=>'raw',
					
			        'htmlOptions'=>array('width'=>5),
				),
				array(
					'value'=>'CHtml::image("images/save_ok.png","",array("id"=>"saveok", "style"=>"display:none", "width"=>"20px", "height"=>"20px"))',
					'type'=>'raw',
					'htmlOptions'=>array('width'=>25),
				),
				array(
					'class'=>'CButtonColumn',
					'template'=>'{delete}',
					'buttons'=>array
					(
					        'delete' => array
							(
					            'url'=>'Yii::app()->createUrl("stock/AjaxDeleteStockItem", array("id"=>$data->Id))',
							),
					),
				),
			),
)); ?>
</div>
<?php 
	//Product PopUp
	$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
			'id'=>'CreateProduct',
			// additional javascript options for the dialog plugin
			'options'=>array(
					'title'=>'Create Product',
					'autoOpen'=>false,
					'modal'=>true,
					'width'=> '800',
					'height'=> '530',
					'resizable'=> false,
					'buttons'=>	array(
							'Cancelar'=>'js:function(){jQuery("#CreateProduct").dialog( "close" );}',
							'Grabar'=>'js:function()
							{
							jQuery("#wating").dialog("open");
							jQuery.post("'.Yii::app()->createUrl("product/ajaxCreate").'", $("#product-form").serialize(),
							function(data) {
								if(data!=null)
								{
									$.fn.yiiGridView.update("product-grid", {
										data: $(this).serialize()
									});
									jQuery("#CreateProduct").dialog( "close" );
								}
							jQuery("#wating").dialog("close");
							},"json"
					);
	
			}'),
			),
	));
	$modelProductPopUp = new Product();
	$modelHyperlink = Hyperlink::model()->findAllByAttributes(array('Id_product'=>$modelProductPopUp->Id,'Id_entity_type'=>ProductController::getEntityTypeStatic()));
	$modelNote = new GNote;
	$ddlRacks = array();
	for($index = 1; $index <= 10; $index++ )
	{
		$item['Id'] = $index;
		$item['description'] = $index;
		$ddlRacks[$index] = $item;
	}
		
	echo $this->renderPartial('../product/_formPopUp',array(
			'model'=>$modelProductPopUp,
			'modelHyperlink'=>$modelHyperlink,
			'modelNote'=>$modelNote,
			'ddlRacks'=>$ddlRacks,
	));
	
	
	$this->endWidget('zii.widgets.jui.CJuiDialog');
	?>