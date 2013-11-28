<?php
$this->breadcrumbs=array(
		'Customers'=>array('index'),
		$model->person->name,
);


?>
<div class="well well-small">
<h4>Cliente</h4>
</div>
<div class="left"style="margin-left:1px; width: 48%; ">
<?php 
$this->widget('bootstrap.widgets.TbDetailView', array(
		'data'=>$model,
		'attributes'=>array(
				array('label'=>$model->getAttributeLabel('description'),
						'type'=>'raw',
						'value'=>$model->contact->description
				),
				array('label'=>$model->getAttributeLabel('name'),
						'type'=>'raw',
						'value'=>$model->person->name
				),
				array('label'=>$model->getAttributeLabel('last_name'),
						'type'=>'raw',
						'value'=>$model->person->last_name
				),
				array('label'=>$model->getAttributeLabel('email'),
						'type'=>'raw',
						'value'=>$model->contact->email
				),
				array('label'=>$model->getAttributeLabel('address'),
						'type'=>'raw',
						'value'=>$model->contact->address
				),
				array('label'=>$model->getAttributeLabel('telephone_1'),
						'type'=>'raw',
						'value'=>$model->contact->telephone_1
				),
				array('label'=>$model->getAttributeLabel('tel1_description'),
						'type'=>'raw',
						'value'=>$model->contact->tel1_description
				),
				array('label'=>$model->getAttributeLabel('telephone_2'),
						'type'=>'raw',
						'value'=>$model->contact->telephone_2
				),
				array('label'=>$model->getAttributeLabel('tel2_description'),
						'type'=>'raw',
						'value'=>$model->contact->tel2_description
				),				
				array('label'=>$model->getAttributeLabel('telephone_3'),
										'type'=>'raw',
										'value'=>$model->contact->telephone_3
				),
				array('label'=>$model->getAttributeLabel('tel3_description'),
										'type'=>'raw',
										'value'=>$model->contact->tel3_description
				),
				array('label'=>$model->getAttributeLabel('comment'),
						'type'=>'raw',
						'value'=>$model->contact->comment
				),
		),
));
?>
</div>
<div class="right" style="margin-left:1px; width: 48%; ">
	<?php
	$hyperLinks = CHtml::listData($modelHyperlink, 'Id','description');
	
	$this->widget('ext.linkcontainer.linkcontainer', array(
		'id'=>'linkContainer',	// default is class="ui-sortable" id="yw0"
		'items'=>$hyperLinks,
		'mode'=>'show'
	));
	?>

</div>




