<?php
$this->breadcrumbs=array(
	'Importers'=>array('index'),
	$model->contact->description,
);

$this->menu=array(
	array('label'=>'List Importer', 'url'=>array('index')),
	array('label'=>'Create Importer', 'url'=>array('create')),
	array('label'=>'Update Importer', 'url'=>array('update', 'id'=>$model->Id)),
	array('label'=>'Delete Importer', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->Id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Importer', 'url'=>array('admin')),
);
?>

<h1>Importer </h1>
<div class="left">

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'cssFile'=>Yii::app()->baseUrl . '/css/detail-view-blue.css',
	'attributes'=>array(
		array('label'=>$modelContact->getAttributeLabel('description'),
			'type'=>'raw',
			'value'=>$modelContact->description
		),
 		array('label'=>$modelContact->getAttributeLabel('telephone_1'),
			'type'=>'raw',
			'value'=>$modelContact->telephone_1
		),
		array('label'=>$modelContact->getAttributeLabel('telephone_2'),
			'type'=>'raw',
			'value'=>$modelContact->telephone_2
		),
		array('label'=>$modelContact->getAttributeLabel('telephone_3'),
			'type'=>'raw',
			'value'=>$modelContact->telephone_3
		),
		array('label'=>$modelContact->getAttributeLabel('email'),
			'type'=>'raw',
			'value'=>$modelContact->email
		),
		array('label'=>$modelContact->getAttributeLabel('address'),
			'type'=>'raw',
			'value'=>$modelContact->address
		),
	),
)); ?>
</div>
<div class="left">

<h2>Shipping Information </h2>
</div>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'cssFile'=>Yii::app()->baseUrl . '/css/detail-view-blue.css',
	'attributes'=>array(
		array('label'=>$modelShippingParameter->getAttributeLabel('description'),
			'type'=>'raw',
			'value'=>$modelShippingParameter->description
		),
	),
))
?>

<div class="left">
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'cssFile'=>Yii::app()->baseUrl . '/css/detail-view-blue.css',
	'attributes'=>array(
		array('label'=>$modelShippingParameterAir->getAttributeLabel('cost_measurement_unit'),
			'type'=>'raw',
			'value'=>$modelShippingParameterAir->cost_measurement_unit
		),
		array('label'=>$modelShippingParameterAir->getAttributeLabel('cost_measurement_unit'),
			'type'=>'raw',
			'value'=>MeasurementUnit::model()->findByPk($modelShippingParameterAir->Id_measurement_unit_cost)->description
		),
		array('label'=>$modelShippingParameterAir->getAttributeLabel('weight_max'),
			'type'=>'raw',
			'value'=>$modelShippingParameterAir->weight_max
		),
		array('label'=>$modelShippingParameterAir->getAttributeLabel('length_max'),
			'type'=>'raw',
			'value'=>$modelShippingParameterAir->length_max
		),
		array('label'=>$modelShippingParameterAir->getAttributeLabel('width_max'),
			'type'=>'raw',
			'value'=>$modelShippingParameterAir->width_max
		),
		array('label'=>$modelShippingParameterAir->getAttributeLabel('height_max'),
			'type'=>'raw',
			'value'=>$modelShippingParameterAir->height_max
		),
		array('label'=>$modelShippingParameterAir->getAttributeLabel('volume_max'),
			'type'=>'raw',
			'value'=>$modelShippingParameterAir->volume_max
		),
		array('label'=>$modelShippingParameterAir->getAttributeLabel('Id_measurement_unit_sizes_max'),
			'type'=>'raw',
			'value'=>MeasurementUnit::model()->findByPk($modelShippingParameterAir->Id_measurement_unit_sizes_max)->description
		),
		array('label'=>$modelShippingParameterAir->getAttributeLabel('days'),
			'type'=>'raw',
			'value'=>$modelShippingParameterAir->days
		),

),
)); ?>

</div>

<div class="right">
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'cssFile'=>Yii::app()->baseUrl . '/css/detail-view-blue.css',
	'attributes'=>array(
		array('label'=>$modelShippingParameterMaritime->getAttributeLabel('cost_measurement_unit'),
			'type'=>'raw',
			'value'=>$modelShippingParameterMaritime->cost_measurement_unit
		),
		array('label'=>$modelShippingParameterMaritime->getAttributeLabel('cost_measurement_unit'),
			'type'=>'raw',
			'value'=>MeasurementUnit::model()->findByPk($modelShippingParameterMaritime->Id_measurement_unit_cost)->description
		),
		array('label'=>$modelShippingParameterAir->getAttributeLabel('days'),
			'type'=>'raw',
			'value'=>$modelShippingParameterAir->days
		),

),
)); ?>

</div>