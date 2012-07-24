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
$('#expand-products').click(function(){
		if($('#expand-products').html()=='+')
		{
			$('#expand-products').html('-');
			$('#product-grid').toggle('blind',{},1000);
			$('#addAll').toggle('blind',{},1000);		
		}
		else
		{
			$('#expand-products').html('+');
			$('#product-grid').toggle('blind',{},1000);
			$('#addAll').toggle('blind',{},1000);		
		}
})
		
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
)
loadPage();
function loadPage()
{
	$('#product-grid').attr('style','display: none;');
	bindObjects();
}
function bindObjects()
		{
$('.link-popup').click(
	function()
	{
		$.post('".PurchaseOrderController::createUrl('product/AjaxDinamicViewPopUp')."',
			{Id_product:$(this).attr('id')},
			function(data)
			{
				$('#popup-place-holder').html(data);
				$('#ViewProduct').dialog('open'); 
			}
		);
		return false;
	}
);
$('.budget-select-link-popup').click(
	function()
	{
		jQuery('#waiting').dialog('open');
		
		$.post('".PurchaseOrderController::createUrl('AjaxDinamicBudgetSelectorPopUp')."',
			{Id_product:$(this).attr('id')},
			function(data)
			{
				$('#select-budget-popup-place-holder').html(data);
				$('#SelectBudget').dialog('open'); 
				jQuery('#waiting').dialog('close');
}
		);
		return false;
	}
);
		
$('.link-popup-product').click(
	function()
	{
		$.post('".PurchaseOrderController::createUrl('product/AjaxDinamicViewPopUp')."',
			{Id_product:$(this).attr('id')},
			function(data)
			{
				$('#popup-place-holder').html(data);
				$('#ViewProduct').dialog('open'); 
			}
		);
		return false;
	}
);
		
		$('#purchase-order-item-grid').find('input.txt-price-shipping').each(
				function(index, item){
					$(item).keyup(function(){
						validateNumber($(this));
					});
			
					$(item).change(function(){
						var target = $(this);
						var quantity = $(this).parent().parent().find('input.txt-quantity').val();
						var price_total = parseFloat(parseFloat($(this).val()) + parseFloat($(this).parent().parent().find('input.txt-price-purchase').val())).toFixed(2)*quantity;
						var price_shipping = parseFloat($(this).val()).toFixed(2);
		
						$.post(
							'".PurchaseOrderController::createUrl('AjaxUpdateItemValues')."',
						{
							Id_purchase_order_item: $(this).attr('id'),
							price_shipping: price_shipping,
							price_total: price_total,
							quantity: quantity,
						},
							function(data)
						{
							$(target).parent().parent().find('#saveok1').animate({opacity: 'show'},4000,
							function(){
								$(target).parent().parent().find('#saveok1').animate({opacity: 'hide'},4000)
							} 
							);
							$(target).parent().parent().find('#saveok3').animate({opacity: 'show'},4000,
							function(){
								$(target).parent().parent().find('#saveok3').animate({opacity: 'hide'},4000)
							} 
							);
							$(target).parent().parent().find('input.txt-price-total').val(data.price_total);							
							$('#purchase_order_price_total').val(data.purhcase_order_price_total);							
							$('#purchase_order_price_shipping').val(data.purhcase_order_price_shipping);							
					},'json');			
				});
			});		
		$('#purchase-order-item-grid').find('input.txt-quantity').each(
				function(index, item){
					$(item).keyup(function(){
						validateNumber($(this));
					});
			
					$(item).change(function(){
						var target = $(this);
						var quantity = $(this).parent().parent().find('input.txt-quantity').val();
						var price_total = parseFloat(parseFloat($(this).parent().parent().find('input.txt-price-shipping').val()) + parseFloat($(this).parent().parent().find('input.txt-price-purchase').val())).toFixed(2)*quantity;
						var price_shipping = parseFloat($(this).parent().parent().find('input.txt-price-shipping').val()).toFixed(2);
		
						$.post(
							'".PurchaseOrderController::createUrl('AjaxUpdateItemValues')."',
						{
							Id_purchase_order_item: $(this).attr('id'),
							price_shipping: price_shipping,
							price_total: price_total,
							quantity: quantity,
						},
							function(data)
						{
							$(target).parent().parent().find('#saveok2').animate({opacity: 'show'},4000,
							function(){
								$(target).parent().parent().find('#saveok2').animate({opacity: 'hide'},4000)
							} 
							);
							$(target).parent().parent().find('#saveok3').animate({opacity: 'show'},4000,
							function(){
								$(target).parent().parent().find('#saveok3').animate({opacity: 'hide'},4000)
							} 
							);
							$(target).parent().parent().find('input.txt-price-total').val(data.price_total);
							$('#purchase_order_price_total').val(data.purhcase_order_price_total);							
							$('#purchase_order_price_shipping').val(data.purhcase_order_price_shipping);							
						},'json');
			
				});
			});		
		
}
");
$this->widget('ext.processingDialog.processingDialog', array(
		'buttons'=>array('none'),
		'idDialog'=>'waiting',
));

?>

<h1>Purchase Order</h1>
<div class="left">
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'cssFile'=>Yii::app()->baseUrl . '/css/detail-view-blue.css',
		'attributes'=>array(
		'Id',
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
</div>
<div class="right">
<?php $this->widget('zii.widgets.CDetailView', array(
	'cssFile'=>Yii::app()->baseUrl . '/css/detail-view-blue.css',
	'data'=>$model,
	'attributes'=>array(
		'date_creation',
		array('label'=>$model->getAttributeLabel('Id_purchase_order_state'),
				'type'=>'raw',
				'value'=>$model->purchaseOrderState->description
		),
		array('label'=>$model->getAttributeLabel('Id_supplier'),
				'type'=>'raw',
				'value'=>$model->supplier->business_name
		),
	),
)); ?>
</div>

	<div class="gridTitle-decoration1" style="display: inline-block; width: 97%;height: 35px;">
		<div id="product-title" class="gridTitle1" style="display: inline-block;position: relative; width: 90%;vertical-align: top; margin-top: 4px;">
			<?php echo CHtml::link('+','#',array('id'=>'expand-products'))?>
			Pendings products
			</div>
		<div style="display: inline-block;position: relative; width: 20px;height:20px; vertical-align: middle;">
		<?php
		echo CHtml::imageButton(
                                'images/add_all_blue.png',
                                array(
                                'title'=>'Add current filtered products',
                                'style'=>'width:30px;display: none;',
                                'id'=>'addAll',
                                )
                                                         
                            ); 
		?>

		</div>
	</div>
	

	<?php		
			
	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'product-grid',
		'dataProvider'=>$modelProduct->searchPending(),
		'filter'=>$modelProduct,
		'summaryText'=>'',
		'selectionChanged'=>'js:function(id){
			$.post(	"'.PurchaseOrderController::createUrl('AjaxAddPurchaseOrderItem').'",
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
				    'value'=>'CHtml::link($data->code,"#",array("id"=>$data->Id,"class"=>"link-popup"))',
					'type'=>'raw'				 
				),
				array(
		 			'name'=>'brand_description',
					'type'=>'raw',
					'value'=>'CHtml::link($data->brand->description,"#",array("id"=>$data->Id,"class"=>"budget-select-link-popup"))',
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
		'afterAjaxUpdate'=>'function(id, data){
			bindObjects();
		}',
		'columns'=>array(
				array(
 				            'name'=>'product_code',
				            'value'=>'CHtml::link($data->product->code,"#",array("id"=>$data->product->Id,"class"=>"link-popup-product"))',
							'type'=>'raw',
							'footer'=>'Total'
				),
				array(
 				            'name'=>'product_description_customer',
				            'value'=>'$data->product->description_customer',
				),
				array(
					'name'=>'price_purchase',
					'value'=>
                                    	'CHtml::textField("txt_price_purchase",
												$data->price_purchase,
												array(
														"id"=>$data->Id,
														"class"=>"txt-price-purchase",
														"style"=>"width:50px;text-align:right;",
														"disabled"=>"disabled",													)
											)',
							
					'type'=>'raw',					
					'htmlOptions'=>array("style"=>"text-align:right;"),
				),
				array(
					'name'=>'price_shipping',
					'value'=>
                                    	'CHtml::textField("txt_price_shipping",
												$data->price_shipping,
												array(
														"id"=>$data->Id,
														"class"=>"txt-price-shipping",
														"style"=>"width:50px;text-align:right;",
													)
											)',
	
					'type'=>'raw',
					'htmlOptions'=>array("style"=>"text-align:right;"),
					'htmlOptions'=>array("style"=>"text-align:right;"),
					'footer'=>'<input id="purchase_order_price_shipping" class="txt-purchase-order-price-shipping-total" type="text" name="txt_purchase_order_price_shipping_total" value="'.$model->PriceShippingTotal.'" disabled="disabled" style="width:50px;text-align:right;">',
					'footerHtmlOptions'=>array("style"=>"text-align:right;"),
						
				),
				array(
					'value'=>'CHtml::image("images/save_ok.png","",array("id"=>"saveok1", "style"=>"display:none", "width"=>"20px", "height"=>"20px"))',
					'type'=>'raw',
					'htmlOptions'=>array('width'=>25),
				),
				array(
					'name'=>'quantity',
					'value'=>
                                    	'CHtml::textField("txt_quantity",
												$data->quantity,
												array(
														"id"=>$data->Id,
														"class"=>"txt-quantity",
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
                                    	'CHtml::textField("txt_price_total",
												$data->price_total,
												array(
														"id"=>$data->Id,
														"class"=>"txt-price-total",
														"style"=>"width:50px;text-align:right;",
														"disabled"=>"disabled",
													)
											)',
	
					'type'=>'raw',
					'htmlOptions'=>array("style"=>"text-align:right;"),
					'footer'=>'<input id="purchase_order_price_total" class="txt-purchase-order-price-total" type="text" name="txt_purchase_order_price_total" value="'.$model->PriceTotal.'" disabled="disabled" style="width:50px;text-align:right;">',
						'footerHtmlOptions'=>array("style"=>"text-align:right;"),
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
<?php 
	//Product View
	$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
			'id'=>'ViewProduct',
			// additional javascript options for the dialog plugin
			'options'=>array(
					'title'=>'Product',
					'autoOpen'=>false,
					'modal'=>true,
					'width'=> '700',
					'buttons'=>	array(
							'cerrar'=>'js:function(){jQuery("#ViewProduct").dialog( "close" );}',
					),
			),
	));
	echo CHtml::openTag('div',array('id'=>'popup-place-holder','style'=>'position:relative;display:inline-block;width:97%'));
	echo CHtml::closeTag('div');
		
	$this->endWidget('zii.widgets.jui.CJuiDialog');

	//Budget Selector View
	$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
			'id'=>'SelectBudget',
			// additional javascript options for the dialog plugin
			'options'=>array(
					'title'=>'Budgets',
					'autoOpen'=>false,
					'modal'=>true,
					'width'=> '700',
					'buttons'=>	array(
							'cerrar'=>'js:function(){jQuery("#SelectBudget").dialog( "close" );}',
							'aplicar'=>'js:function(){jQuery("#SelectBudget").dialog( "close" );}',
					),
			),
	));
	echo CHtml::openTag('div',array('id'=>'select-budget-popup-place-holder','style'=>'position:relative;display:inline-block;width:97%'));
	echo CHtml::closeTag('div');
	
	$this->endWidget('zii.widgets.jui.CJuiDialog');
	
	?>
		