<?php
$this->breadcrumbs=array(
	'Budgets'=>array('index'),
	$model->project->description=>array('view','id'=>$model->Id, 'version'=>$model->currentVersion),
	'All Versions'=>array('adminAllVersion','id'=>$model->Id, 'version'=>$model->currentVersion),
	'Version '. $model->version_number
);

$this->menu=array(
	array('label'=>'List Budget', 'url'=>array('index')),
	array('label'=>'Create Budget', 'url'=>array('create')),	
	array('label'=>'Manage Budget', 'url'=>array('admin')),
);
?>

<h1>View Budget Version</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		array('label'=>$model->getAttributeLabel('Id_project'),
			'type'=>'raw',
			'value'=>$model->project->description
		),
		'version_number',
		array('label'=>$model->getAttributeLabel('Id_budget_state'),
			'type'=>'raw',
			'value'=>$model->budgetState->description
		),
		'description',
		'percent_discount',
		'date_creation',
		'date_inicialization',
		'date_finalization',
		'date_estimated_inicialization',
		'date_estimated_finalization',
		'note',
		'totalPrice',
	),
)); ?>

	<div class="gridTitle-decoration1" style="display: inline-block; width: 97%;height: 35px;margin-top: 10px;">
		<div class="gridTitle1" style="display: inline-block;position: relative; width: 90%;vertical-align: top; margin-top: 4px;">
			Items
		</div>
	</div>
			<?php 

			$creteria = new CDbCriteria();
			$creteria->join = " INNER JOIN area_project ap on (ap.Id_area = t.Id)";
			$area = Area::model()->findAll($creteria);
			$areaList = CHtml::listData($area,'Id','description');
			
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'stock-item-grid',
	'dataProvider'=>$modelBudgetItem->search(),
 	'filter'=>$modelBudgetItem,
	'summaryText'=>'',
	'columns'=>array(
				array(
		 			'name'=>"Id_area",
		 			'type'=>'raw',
		 			'value'=>'$data->area->description',
		 			'filter'=>$areaList,
				),
				array(
					'name'=>'product_code',
				    'value'=>'$data->product->code',
				),
				array(
					'name'=>'parent_product_code',
				    'value'=>'$data->budgetItem->product->code',
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
 					'name'=>'price',
				    'value'=>'$data->price',
					'type'=>'raw',
			        'htmlOptions'=>array('style'=>'text-align: right;'),
				),
			),
)); ?>