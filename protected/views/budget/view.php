<?php
$this->breadcrumbs=array(
	'Budgets'=>array('index'),
	$model->project->description,
);

$this->menu=array(
	array('label'=>'List Budget', 'url'=>array('index')),
	array('label'=>'Create Budget', 'url'=>array('create')),
	array('label'=>'Update Budget', 'url'=>array('update', 'id'=>$model->Id, 'version'=>$model->version_number)),
	array('label'=>'Delete Budget', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->Id, 'version'=>$model->version_number),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Add Items Budget', 'url'=>array('addItem', 'id'=>$model->Id, 'version'=>$model->version_number)),
	array('label'=>'Manage Budget', 'url'=>array('admin')),
);
?>

<h1>View Budget <?php echo CHtml::link( CHtml::image('images/new_version.png','Generate new version' ,array(
																   'title'=>'Generate new version',
												                   'style'=>'width:30px;',
												                   'id'=>'addBack',
)
),BudgetController::createUrl('AjaxNewVersion', array('id'=>$model->Id, 'version'=>$model->version_number)));
?>
</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		array('label'=>$model->getAttributeLabel('Id_project'),
			'type'=>'raw',
			'value'=>$model->project->description
		),
		array('label'=>$model->getAttributeLabel('version_number'),
						'type'=>'raw',
						'value'=>$model->version_number . ' ( ' . CHtml::link('view all versions', BudgetController::createUrl('adminAllVersion',array('id'=>$model->Id, 'version'=>$model->version_number))) . ' )'
		),
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
				'price',
			),
)); ?>