<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->username,
);
?>
<div class="well well-small">
<h4>Vista Usuario</h4>
</div>
<?php 
$this->widget('bootstrap.widgets.TbDetailView', array(
		'data'=>$model,
	'attributes'=>array(
		array('label'=>$model->getAttributeLabel('username'),
			'type'=>'raw',
			'value'=>$model->username
		),
		'password',
		array('label'=>$model->getAttributeLabel('userGroupDescription'),
			'type'=>'raw',
			'value'=>$model->userGroup->description
		),
		'email',
		'name',
		'last_name',
		'address',
		'phone_house',
		'phone_mobile',
		'description',
		'dni',
		'cuil',		
	),
));
?>

