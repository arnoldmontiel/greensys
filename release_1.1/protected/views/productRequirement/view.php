<?php
$this->breadcrumbs=array(
	'Product Requirements'=>array('index'),
	$model->description_short,
);

$this->menu=array(
	array('label'=>'List ProductRequirement', 'url'=>array('index')),
	array('label'=>'Create ProductRequirement', 'url'=>array('create')),
	array('label'=>'Update ProductRequirement', 'url'=>array('update', 'id'=>$model->Id)),
	array('label'=>'Delete ProductRequirement', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->Id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ProductRequirement', 'url'=>array('admin')),
);
?>

<h1>View Product Requirement</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		array(
		 			'name'=>'internal',
					'value'=>CHtml::checkBox("internal",$model->internal,array("disabled"=>"disabled")),
					'type'=>'raw',
		),
		'description_short',
		array(
		 			'name'=>'guild_description',
					'value'=>$model->guild->description,
		),
	),
)); ?>
<br>
	<div class="footer">
		<div style="height:5%;background-color: #B7D6E7">
		<b><?php echo CHtml::encode($model->getAttributeLabel('note')); ?>:</b>
		</div>
		<?php
	
		 $this->widget('ext.richtext.jwysiwyg', array(
	 		'id'=>'noteContainer',	// default is class="ui-sortable" id="yw0"	
	 		'notes'=> $modelNote->note,
	 		'mode'=>'show'
	 			));
		?>
	</div>		
