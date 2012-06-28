<?php 
$this->breadcrumbs=array(
	'Price List'=>array('index'),
	'Clone PriceList',
);

$this->menu=array(
	array('label'=>'List PriceList', 'url'=>array('index')),
	array('label'=>'Create PriceList', 'url'=>array('create')),
	array('label'=>'Manage PriceList', 'url'=>array('admin')),
	array('label'=>'Assing Products', 'url'=>array('priceListItem')),
);
?>
<h1>Clone Price List</h1>

<div class="gridTitle-decoration1">
	<div class="gridTitle1">
		Price List Selection
	</div>
</div>
<?php
 $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'clone-price-list-grid',
	'dataProvider'=>$modelToClone->searchSummary(),
	'filter'=>$modelToClone,
 	'selectionChanged'=>'js:function(){
 						
 						$("#clone-price-list-grid > table > tbody > tr").each(function(i)
				        {
				                if($(this).hasClass("selected"))
				                {
				                	$("#PriceList_description").val($(this).find("#description").text());
				                	$("#PriceList_date_validity").val($(this).find("#date_validity").text());
				                	$("#PriceList_Id_supplier").val($(this).find("#bussinesName").text());
// 				                	var followupDate = Date.parse($(this).find("#date_validity").text().trim());
// 				                	var a = new Date(followupDate);
// 				                	a.setMonth(a.getMonth()+1);
// 				                	debugger;
				                }
				        });
				        $.fn.yiiGridView.update("price-list-item-grid", {
							data: "PriceList[id]="+$.fn.yiiGridView.getSelection("clone-price-list-grid")
						});
						var idPriceList = $.fn.yiiGridView.getSelection("clone-price-list-grid");
						if(idPriceList!="")
						{
							$( "#display" ).animate({opacity: "show"},"slow");
							$("#hiddenPriceListId").val(null);
							$("#hiddenPriceListId").val(idPriceList);
							$("#saveButton").removeAttr("disabled");
						}
						else
						{
							$( "#display" ).animate({opacity: "hide"},"slow");
							$("#PriceList_description").val(null);
							$("#PriceList_date_validity").val(null);
							$("#PriceList_Id_supplier").val(null);
							$("#saveButton").attr("disabled", "disabled");
						}
 					}',
	'columns'=>array(
//  		array(
//  			'name'=>'supplier_business_name',
//  			'value'=>'$data->supplier->Id',
//  			'header'=>false,
//  			'filter'=>false,
//  			'headerHtmlOptions'=>array('style'=>'display:none'),
//  			'htmlOptions'=>array('style'=>'display:none')
//  		),
		array(
			'name'=>'supplier_business_name',
			'value'=>'$data->supplier->business_name',
			'htmlOptions'=>array('id'=>'bussinesName'),
		),
 		array(
 			'name'=>'description',
 			'value'=>'$data->description',
 			'htmlOptions'=>array('id'=>'description'),
 		),
 		array(
 			'name'=>'date_creation',
 			'value'=>'$data->date_creation',
 			'htmlOptions'=>array('id'=>'date_creation'),
		),
		array(
 			'name'=>'date_validity',
 			'value'=>'$data->date_validity',
 			'htmlOptions'=>array('id'=>'date_validity'),
 		),
 		array(
 			'name'=>"validity",//$model->getAttributeLabel('validity'),
 			'type'=>'raw',
 			'value'=>'CHtml::checkBox("validity",$data->validity,array("disabled"=>"disabled"))',
 			'filter'=>CHtml::listData(
 				array(
 					array('id'=>'0','value'=>'No'),
 					array('id'=>'1','value'=>'Yes')
 				)
 				,'id','value'
 			),
 		),		
	),
)); ?>
 <div id="display"
 style="display: none">
 <div class="gridTitle-decoration1">
 	<div class="gridTitle1">
 		Products
 	</div>
 </div>
<?php 
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'price-list-item-grid',
	'dataProvider'=>$modelPriceListItem->searchPriceList(),
 	'filter'=>$modelPriceListItem,
	'summaryText'=>'',
	'columns'=>array(
				array(
 				            'name'=>'code',
				            'value'=>'$data->product->code',
				 
				),
				array(
 				            'name'=>'code_supplier',
				            'value'=>'$data->product->code_supplier',
 
				),
				array(
 				            'name'=>'description_customer',
				            'value'=>'$data->product->description_customer',
 
				),
				array(
					'name'=>'msrp',
					'value'=>'$data->msrp',
					'type'=>'raw',
			        'htmlOptions'=>array('width'=>5),
				),
				array(
					'name'=>'dealer_cost',
					'value'=>'$data->dealer_cost',
					'htmlOptions'=>array('width'=>5),
					),
				array(
					'name'=>'profit_rate',
					'value'=>'$data->profit_rate',
					'htmlOptions'=>array('width'=>5),
					),
			),
)); ?>
</div>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'clone-price-list-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo CHtml::hiddenField('hiddenPriceListId','',array('id'=>'hiddenPriceListId')) ; ?>
	
	<div class="gridTitle-decoration1">
		<div class="gridTitle1">
			New Price List
		</div>
	</div>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<div style="display: inline-block;">
			<?php echo $form->labelEx($model,'date_validity'); ?>
	 		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
		     // additional javascript options for the date picker plugin
	 		'language'=>'en',
	 		'model'=>$model,
	 		'attribute'=>'date_validity',
	 		'options'=>array(
		         'showAnim'=>'fold',
		     ),
		     'htmlOptions'=>array(
		         'style'=>'height:20px;'
		    ),
			));?>
			<?php echo $form->error($model,'date_validity'); ?>
		</div>
	
		<div style="display: inline-block;">
			<?php echo $form->labelEx($model,'description'); ?>
			<?php echo $form->textField($model,'description',array('size'=>30,'maxlength'=>100)); ?>
			<?php echo $form->error($model,'description'); ?>
		</div>
	
		<div style="display: inline-block;">
			<?php echo $form->labelEx($model,'Id_supplier'); ?>
			<?php echo $form->textField($model,'Id_supplier',array('size'=>30,'maxlength'=>100, 'disabled'=>'disabled')); ?>
			<?php echo $form->error($model,'Id_supplier'); ?>
		</div>
	</div>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('id'=>'saveButton','disabled'=>'disabled')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->