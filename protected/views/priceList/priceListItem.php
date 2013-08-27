<?php
$this->breadcrumbs=array(
	'Price List'=>array('index'),
	'Assign Product',
);

$this->menu=array(
	array('label'=>'List PriceList', 'url'=>array('index')),
	array('label'=>'Create PriceList', 'url'=>array('create')),
	array('label'=>'Manage PriceList', 'url'=>array('admin')),
	array('label'=>'Clone PriceList', 'url'=>array('clonePriceList')),
);

$this->showSideBar = true;

Yii::app()->clientScript->registerScript(__CLASS__.'#price_list_assign', "
		
function loadPage()
	{
				
	if($('#PriceList_Id').val()!= ''){
		$.post('".PriceListController::createUrl('AjaxGetPriceListAttributes')."',
			$('#PriceList_Id').serialize(),
			function(data) 
			{
				if(data.Id_price_list_type == '1')
				{
					$.fn.yiiGridView.update('price-list-item-grid', {
						data: $('#PriceList_Id').serialize()
					});
					$.fn.yiiGridView.update('product-grid', {
						data: $('#PriceList_Id').serialize()
					});
					$('#display-sale').animate({opacity: 'hide'},240,
						function(){ $('#display').animate({opacity: 'show'},240);}
					);
					$.post('".PriceListController::createUrl('AjaxFillSidebar')."',
								$('#PriceList_Id').serialize()
							).success(
								function(data) 
								{
									$('#sidebar').html(data);
									$( '#sidebar' ).show();	
								}
							);
				}
				else
				{
					$.fn.yiiGridView.update('price-list-item-grid-sale', {
						data: $('#PriceList_Id').serialize()
					});
					$.fn.yiiGridView.update('product-grid-sale', {
						data: $('#PriceList_Id').serialize()
					});
					$('#display').animate({opacity: 'hide'},240,
						function(){ $('#display-sale').animate({opacity: 'show'},240);}
					);
					$.post('".PriceListController::createUrl('AjaxFillSidebar')."',
								$('#PriceList_Id').serialize()
							).success(
								function(data) 
								{
									$('#sidebar').html(data);
									$( '#sidebar' ).show();	
								}
							);
					}
			}
		,'json');		
	}
	else{
		$('#display').animate({opacity: 'hide'},240);
		$('#sidebar').hide();
	}
	return false;
}

loadPage();
		
$('#PriceList_Id').change(function(){
		loadPage();
}	
);

");
?>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'priceList-form',
		'enableAjaxValidation'=>true,
));
?>
	
	<div id="priceList" style="margin-bottom: 5px">		
		<?php
		
			$criteria = new CDbCriteria;			
			$criteria->order = 't.Id_price_list_type, t.description ASC';
			$priceListDB= PriceList::model()->findAll($criteria);
			$priceLists = CHtml::listData($priceListDB, 'Id', 'PriceListDesc');
		?>
		<?php echo $form->labelEx($modelPriceList,'Price List'); ?>
		<?php echo $form->dropDownList($modelPriceList, 'Id', $priceLists,		
			array(
				'prompt'=>'Select a Price List'
			)		
		);
		?>
	</div>
		
	<div id="display" style="display: none">
		<?php echo $this->renderPartial('_priceListItem', array('model'=>$model,'modelProduct'=>$modelProduct,)); ?>
	</div><!-- display-->
	<div id="display-sale" style="display: none">
		<?php echo $this->renderPartial('_priceListItemSale', array('model'=>$model,'modelProduct'=>$modelProduct,)); ?>
	</div><!-- display-->
	<?php $this->endWidget(); ?>

</div><!-- form -->
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