<?php
$this->breadcrumbs=array(
	'Purchase Orders'=>array('index'),
	$model->Id,
);

$this->menu=array(
	array('label'=>'List PurchaseOrder', 'url'=>array('index')),
	array('label'=>'Create PurchaseOrder', 'url'=>array('create')),
	array('label'=>'Update PurchaseOrder', 'url'=>array('update', 'id'=>$model->Id)),
	array('label'=>'Delete PurchaseOrder', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->Id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage PurchaseOrder', 'url'=>array('admin')),
);

Yii::app()->clientScript->registerScript(__CLASS__.'#purchase_order_purchase', "
$('#addAll').hover(
	function () {
		$(this).attr('src','images/add_all_blue_light.png');
  	},
  	function () {
		$(this).attr('src','images/add_all_blue.png');
  	}
);		
$('#addAll').click(
		function()
		{
			if(!confirm('Are you sure you want to add all filtered products?'))
			{ 
				return false;
			}
		
			$.post('".PurchaseOrderController::createUrl('AjaxAddFilteredProducts')."',
				$.param($(
			        '#product-grid .filters input,  #product-grid .filters select, '
    		))+'&Id_purchase_order=".$model->Id."',
				function(data){
					$.fn.yiiGridView.update('purchase-order-item-grid');
				}
			);	
			
		}
);
");
?>

<h1>Assign Products</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		array('label'=>$model->getAttributeLabel('Id_supplier'),
				'type'=>'raw',
				'value'=>$model->supplier->business_name
		),
		'date_creation',
		array('label'=>$model->getAttributeLabel('Id_purchase_order_state'),
				'type'=>'raw',
				'value'=>$model->purchaseOrderState->description
		),
		array('label'=>$model->getAttributeLabel('Id_importer'),
				'type'=>'raw',
				'value'=>$model->importer->contact->description
		),
		array('label'=>$model->getAttributeLabel('Id_shipping_parameter'),
				'type'=>'raw',
				'value'=>$model->shippingParameter->description
		),
		array('label'=>$model->getAttributeLabel('Id_shipping_type'),
				'type'=>'raw',
				'value'=>$model->shippingType->description
		),
	),
)); ?>
	<div class="gridTitle-decoration1" style="display: inline-block; width: 98%;height: 35px;">
		<div class="gridTitle1" style="display: inline-block;position: relative; width: 90%;vertical-align: top; margin-top: 4px;">
			Products
			</div>
		<div style="display: inline-block;position: relative; width: 20px;height:20px; vertical-align: middle;">
		<?php
		echo CHtml::imageButton(
                                'images/add_all_blue.png',
                                array(
                                'title'=>'Add current filtered products',
                                'style'=>'width:30px;',
                                'id'=>'addAll',
                                )
                                                         
                            ); 
		?>

		</div>
	</div>
	

	<?php		
	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'product-grid',
		'dataProvider'=>$modelProduct->searchSummary(),
		'filter'=>$modelProduct,
		'summaryText'=>'',	
		'selectionChanged'=>'js:function(id){
			$.get(	"'.PurchaseOrderController::createUrl('AjaxAddPurchaseOrderItem').'",
					{
						Id_purchase_order:'.$model->Id.',
						Id_product:$.fn.yiiGridView.getSelection("product-grid")
					}).success(
						function() 
						{
							markAddedRow("product-grid");
							
							$.fn.yiiGridView.update("purchase-order-item-grid", {
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
		echo Yii::app()->lc->t('Product has already been added to selected Purchase Order');
		?></p>

		
				<?php 

$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'purchase-order-item-grid',
	'dataProvider'=>$modelPurchaseOrderItem->search(),
 	'filter'=>$modelPurchaseOrderItem,
	'summaryText'=>'',
	'columns'=>array(
				array(
 				            'name'=>'product_code',
				            'value'=>'$data->product->code',
				),
				array(
 				            'name'=>'product_description_customer',
				            'value'=>'$data->product->description_customer',
				),
				array(
					'name'=>'price_purchase',
					'value'=>
                                    	'CHtml::textField("txtMsrp",
												$data->price_purchase,
												array(
														"id"=>$data->Id,
														"class"=>"txtPricePurchase",
														"style"=>"width:50px;text-align:right;",
													)
											)',
							
					'type'=>'raw',					
					'htmlOptions'=>array("style"=>"text-align:right;"),
				),
				array(
					'value'=>'CHtml::image("images/save_ok.png","",array("id"=>"saveok", "style"=>"display:none", "width"=>"20px", "height"=>"20px"))',
					'type'=>'raw',
					'htmlOptions'=>array('width'=>25),
				),
				array(
					'name'=>'price_shipping',
					'value'=>
                                    	'CHtml::textField("txtPriceShipping",
												$data->price_shipping,
												array(
														"id"=>$data->Id,
														"class"=>"txtPriceShipping",
														"style"=>"width:50px;text-align:right;",
													)
											)',
	
					'type'=>'raw',
					'htmlOptions'=>array("style"=>"text-align:right;"),
				),
				array(
					'value'=>'CHtml::image("images/save_ok.png","",array("id"=>"saveok2", "style"=>"display:none", "width"=>"20px", "height"=>"20px"))',
					'type'=>'raw',
					'htmlOptions'=>array('width'=>25),
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
					'htmlOptions'=>array("style"=>"text-align:right;"),
				),
			array(
					'value'=>'CHtml::image("images/save_ok.png","",array("id"=>"saveok2", "style"=>"display:none", "width"=>"20px", "height"=>"20px"))',
					'type'=>'raw',
					'htmlOptions'=>array('width'=>25),
				),
				array(
					'name'=>'price_total',
					'value'=>
                                    	'CHtml::textField("txtPriceTotal",
												$data->price_total,
												array(
														"id"=>$data->Id,
														"class"=>"txtPriceTotal",
														"style"=>"width:50px;text-align:right;",
													)
											)',
	
					'type'=>'raw',
					'htmlOptions'=>array("style"=>"text-align:right;"),
				),
				array(
					'value'=>'CHtml::image("images/save_ok.png","",array("id"=>"saveok3", "style"=>"display:none", "width"=>"20px", "height"=>"20px"))',
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
					            'url'=>'Yii::app()->createUrl("purchaseOrder/AjaxDeletePurchaseOrderItem", array("id"=>$data->Id))',
							),
					),
				),
			),
)); ?>
		