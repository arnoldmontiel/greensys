<?php
$this->breadcrumbs=array(
	'Products'=>array('index'),
	$model->code,
);

$this->menu=array(
	array('label'=>'List Product', 'url'=>array('index')),
	array('label'=>'Create Product', 'url'=>array('create')),
	array('label'=>'Update Product', 'url'=>array('update', 'id'=>$model->Id)),
	array('label'=>'Delete Product', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->Id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Product', 'url'=>array('admin')),
	array('label'=>'Assign Groups', 'url'=>array('productGroup')),
	array('label'=>'Assign Requirements', 'url'=>array('productRequirement')),
);
?>
<h1>View Product</h1>

<div class="left">

<?php
$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'cssFile'=>Yii::app()->baseUrl . '/css/detail-view-blue.css',
	'attributes'=>array(
		'code',
		'code_supplier',
		array('label'=>$model->getAttributeLabel('Id_supplier'),
					'type'=>'raw',
					'value'=>$model->supplier->business_name
		),
		array('label'=>$model->getAttributeLabel('Id_brand'),
			'type'=>'raw',
			'value'=>$model->brand->description
		),
		array('label'=>$model->getAttributeLabel('Id_category'),
			'type'=>'raw',
			'value'=>$model->category->description
		),
		array('label'=>$model->getAttributeLabel('Id_nomenclator'),
			'type'=>'raw',
			'value'=>$model->nomenclator->description
		),
		'description_customer',
		'description_supplier',
		array('label'=>$model->getAttributeLabel('discontinued'),
			'type'=>'raw',
			'value'=>CHtml::checkBox("discontinued",$model->discontinued,array("disabled"=>"disabled"))
		),
		'length',
		'width',
		'height',
		array('label'=>$model->getAttributeLabel('Id_measurement_unit_linear'),
			'type'=>'raw',
			'value'=>$model->measurementUnitLinear->short_description
		),
		array('label'=>$model->getAttributeLabel('volume'),
			'type'=>'raw',
			'value'=>$model->getVolume()
		),
		'weight',
		array('label'=>$model->getAttributeLabel('Id_measurement_unit_weight'),
			'type'=>'raw',
			'value'=>$model->measurementUnitWeight->short_description
		),
		'profit_rate',
		'dealer_cost',
		'msrp',
		'time_instalation',
		array('label'=>$model->getAttributeLabel('hide'),
			'type'=>'raw',
			'value'=>CHtml::checkBox("hide",$model->hide,array("disabled"=>"disabled"))
		),
	),
)); 
?>
</div>
<div class="right" style="margin-left:1px; width: 48%; ">
	<b><?php echo CHtml::encode($model->getAttributeLabel('link')); ?>:</b>
	<?php
	$hyperLinks = CHtml::listData(Hyperlink::model()->findAllByAttributes(array('Id_product'=>$model->Id)), 'Id','description');
	
	$this->widget('ext.linkcontainer.linkcontainer', array(
		'id'=>'linkContainer',	// default is class="ui-sortable" id="yw0"
		'items'=>$hyperLinks,
		'mode'=>'show'
	));
	?>
	<br />
	<b><?php echo CHtml::encode($model->getAttributeLabel('image')); ?>:</b>
<?php 
	$multimedia = Multimedia::model()->findByAttributes(array('Id_product'=>$model->Id));
	$this->widget('ext.highslide.highslide', array(
							'id'=>$multimedia->Id,
	)); ?>
	
</div>
<div class="footer">
	<div style="height:5%;background-color: #B7D6E7">
	<b><?php echo CHtml::encode($model->getAttributeLabel('note')); ?>:</b>
	</div>
	<?php
	$note = Note::model()->findByAttributes(array('Id_product'=>$model->Id));

	 $this->widget('ext.richtext.jwysiwyg', array(
 		'id'=>'noteContainer',	// default is class="ui-sortable" id="yw0"	
 		'notes'=> $note->note,
 		'mode'=>'show'
 			));
	?>
</div>		

