<?php
$this->breadcrumbs=array(
	'Areas'=>array('index'),
	'Assing Products',
);
$this->menu=array(
	array('label'=>'List Area', 'url'=>array('index')),
	array('label'=>'Create Area', 'url'=>array('create')),
	array('label'=>'Manage Area', 'url'=>array('admin')),
	array('label'=>'Assign Categories', 'url'=>array('categoryArea')),
	array('label'=>'Assign Services', 'url'=>array('serviceArea')),
);
$this->trashDraggableId = 'ddlAssigment';
?>
<div class="form">
	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'productArea-form',
		'enableAjaxValidation'=>true,
	)); ?>

	<?php 	// Organize the dataProvider data into a Zii-friendly array
	
	
		$items = CHtml::listData($dataProvider->getData(), 'Id', 'description');
		?>
	<div style="row;width:100%;margin:2px;">
		<div style="width:51%;float:left;">

		<?php
		Yii::app()->clientScript->registerScript('update', "
				$('#ProductArea_id_area').change(function(){
					$.fn.yiiGridView.update('productArea-grid', {
						data: $(this).serialize()
					});
					return false;
				});
				");
		 ?>
		
		
		<?php echo $form->labelEx($modelProductArea,'Area'); ?>
		<?php echo $form->dropDownList($modelProductArea, 
			'id_area',
			CHtml::listData($model->findAll(), 'Id', 'description'),
			array('prompt'=>'Select an Area')
		);
		?>
		</div>
				
		</div>

	<div id="products" class="selectablesItems" >
		
	<?php		
	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'product-grid',
		'dataProvider'=>$modelProduct->search(),
		'filter'=>$modelProduct,
		'selectionChanged'=>'js:function(){
			$.get(	"'.AreaController::createUrl('AjaxAddProductArea').'",
					{
						IdArea:$("#ProductArea_id_area :selected").attr("value"),
						IdProduct:$.fn.yiiGridView.getSelection("product-grid")
					}).success(
						function() 
						{
							$.fn.yiiGridView.update("productArea-grid", {
							data: $(this).serialize()
							});
						});
		}',
		'columns'=>array(	
			array('name'=>'Id',
			'value'=>'$data->Id',
			'visible'=>false,
			),
			'id_brand',
			'Id_category',
			'description_customer',
			'description_supplier',
			),
		));		
		?>
		</div>
		<div id="product" class="selectable-items" style="display: yes">
		<?php 				
		$this->widget('zii.widgets.grid.CGridView', array(
			'id'=>'productArea-grid',
			'dataProvider'=>$modelProductArea->search(),
			'filter'=>$modelProductArea,
			'columns'=>array(	
				array('name'=>'Id',
				'value'=>'$data->Id',
				'visible'=>false,
				),
				array('name'=>'product.description_customer',
				'value'=>'$data->product->description_customer',
				),
				'quantity'
			),
			));		
		?>
		</div>
	
	<?php $this->endWidget(); ?>

	<div id="display"></div>
</div><!-- form -->
