<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->username,
);

$this->menu=array(
	array('label'=>'Crear Usuario', 'url'=>array('create')),
	array('label'=>'Actualizar Usuario', 'url'=>array('update', 'id'=>$model->username)),
	array('label'=>'Administrar Usuario', 'url'=>array('admin')),
);
?>

<h1>Vista Usuario</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
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
	),
)); ?>
