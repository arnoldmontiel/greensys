<?php
$this->breadcrumbs=array(
	'Purchase Orders'=>array('index'),
	$model->code,
);

$this->menu=array(
	array('label'=>'List PurchaseOrder', 'url'=>array('index')),
	array('label'=>'Create PurchaseOrder', 'url'=>array('create')),
	array('label'=>'Update PurchaseOrder', 'url'=>array('update', 'id'=>$model->Id)),
	array('label'=>'Delete PurchaseOrder', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->Id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage PurchaseOrder', 'url'=>array('admin')),
	array('label'=>'Assign Products', 'url'=>array('assignProducts', 'id'=>$model->Id)),
);
$this->widget('ext.processingDialog.processingDialog', array(
	'buttons'=>array('none'),
	'idDialog'=>'waiting',
));
Yii::app()->clientScript->registerScript(__CLASS__.'#purchase_order_purchase_view', "
$('.link-popup-product').click(
	function()
	{
		jQuery('#waiting').dialog('open');
		$.post('".PurchaseOrderController::createUrl('product/AjaxDinamicViewPopUp')."',
			{Id_product:$(this).attr('id')},
			function(data)
			{
				$('#popup-place-holder').html(data);
				$('#ViewProduct').dialog('open'); 
				jQuery('#waiting').dialog('close');
			}
		);
		return false;
	}
);
		
function openBudgetSelectorView(id)
	{
		jQuery('#waiting').dialog('open');
		
		$.post('".PurchaseOrderController::createUrl('AjaxDinamicBudgetSelectorViewPopUp')."',
			{Id_purchase_item:$.fn.yiiGridView.getSelection(id)},
			function(data)
			{
				$('#select-budget-popup-place-holder-view').html(data);
		
				$('input.txt-quantity').keyup(function(){
					validateNumber($(this));
				});
				$('input.txt-quantity').change(function(){
					if($(this).val()==''){
						$(this).val('0')
					}
				});
		
		
				$('#SelectBudgetView').dialog('open'); 
				jQuery('#waiting').dialog('close');
			}
		);
		return false;
	}
");
?>

<h1>View PurchaseOrder</h1>

<div class="left">
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'cssFile'=>Yii::app()->baseUrl . '/css/detail-view-blue.css',
		'attributes'=>array(
		'code',
		array('label'=>$model->getAttributeLabel('Id_supplier'),
				'type'=>'raw',
				'value'=>$model->supplier->business_name
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
	),
)); 
?>
</div>
<?php 

$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'purchase-order-item-grid',
	'dataProvider'=>$modelPurchaseOrderItem->search(),
 	'filter'=>$modelPurchaseOrderItem,
	'summaryText'=>'',
	'selectionChanged'=>'js:function(id){
		if($.fn.yiiGridView.getSelection(id)!="")
			openBudgetSelectorView(id);
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
														"disabled"=>"disabled",
													)
											)',
	
					'type'=>'raw',
					'htmlOptions'=>array("style"=>"text-align:right;"),
					'htmlOptions'=>array("style"=>"text-align:right;"),
					'footer'=>'<input id="purchase_order_price_shipping" class="txt-purchase-order-price-shipping-total" type="text" name="txt_purchase_order_price_shipping_total" value="'.$model->PriceShippingTotal.'" disabled="disabled" style="width:50px;text-align:right;">',
					'footerHtmlOptions'=>array("style"=>"text-align:right;"),
						
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
														"disabled"=>"disabled",
													)
											)',
	
					'type'=>'raw',
					'htmlOptions'=>array("style"=>"text-align:right;"),
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
			),
)); 
	//Budget Selector
	$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
			'id'=>'SelectBudgetView',
			// additional javascript options for the dialog plugin
			'options'=>array(
					'title'=>'Aplicated Budgets',
					'autoOpen'=>false,
					'modal'=>true,
					'width'=> '700',
					'buttons'=>	array(
							'Close'=>'js:function(){jQuery("#SelectBudgetView").dialog( "close" );}',
					),
			),
	));
	echo CHtml::openTag('div',array('id'=>'select-budget-popup-place-holder-view','style'=>'position:relative;display:inline-block;width:97%'));
	echo CHtml::closeTag('div');
	
	$this->endWidget('zii.widgets.jui.CJuiDialog');
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
?>

