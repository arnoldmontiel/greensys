<?php
$this->breadcrumbs=array(
	'Customers'=>array('index'),
	$model->person->last_name,
);

$this->menu=array(
	array('label'=>'List Customer', 'url'=>array('index')),
	array('label'=>'Create Customer', 'url'=>array('create')),
	array('label'=>'Update Customer', 'url'=>array('update', 'id'=>$model->Id)),
	array('label'=>'Delete Customer', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->Id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Customer', 'url'=>array('admin')),
);
?>

<h1>View Customer</h1>

<div class="left">

	<?php
	$this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'cssFile'=>Yii::app()->baseUrl . '/css/detail-view-blue.css',
		'attributes'=>array(
			array('label'=>$model->getAttributeLabel('name'),
				'type'=>'raw',
				'value'=>$model->person->name
			),
			array('label'=>$model->getAttributeLabel('last_name'),
				'type'=>'raw',
				'value'=>$model->person->last_name
			),
			array('label'=>$model->getAttributeLabel('uid'),
				'type'=>'raw',
				'value'=>$model->person->uid
			),
			array('label'=>$model->getAttributeLabel('date_birth'),
				'type'=>'raw',
				'value'=>$model->person->date_birth
			),
			array('label'=>$model->getAttributeLabel('description'),
				'type'=>'raw',
				'value'=>$model->contact->description
			),
			array('label'=>$model->getAttributeLabel('email'),
				'type'=>'raw',
				'value'=>$model->contact->email
			),
			array('label'=>$model->getAttributeLabel('telephone_1'),
				'type'=>'raw',
				'value'=>$model->contact->telephone_1
			),
			array('label'=>$model->getAttributeLabel('telephone_2'),
				'type'=>'raw',
				'value'=>$model->contact->telephone_2
			),
			array('label'=>$model->getAttributeLabel('telephone_3'),
				'type'=>'raw',
				'value'=>$model->contact->telephone_3
			),
			array('label'=>$model->getAttributeLabel('address'),
				'type'=>'raw',
				'value'=>$model->contact->address
			),
		),
	)); 
	?>
</div>

<div class="right" style="margin-left:1px; width: 48%; ">
	<b><?php echo CHtml::encode($model->getAttributeLabel('link')); ?>:</b>
	<?php
	$hyperLinks = CHtml::listData($modelHyperlink, 'Id','description');
	
	$this->widget('ext.linkcontainer.linkcontainer', array(
		'id'=>'linkContainer',	// default is class="ui-sortable" id="yw0"
		'items'=>$hyperLinks,
		'mode'=>'show'
	));
	?>
</div>
