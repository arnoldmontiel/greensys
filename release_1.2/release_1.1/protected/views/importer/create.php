<?php
$this->breadcrumbs=array(
	'Importers'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Importer', 'url'=>array('index')),
	array('label'=>'Manage Importer', 'url'=>array('admin')),
);
?>

<h1>Create Importer</h1>

<?php echo $this->renderPartial('_form', 
	array(
		'model'=>$model,
		'modelContact'=>$modelContact,
		'modelShippingParameter'=>$modelShippingParameter,
		'modelShippingParameterAir'=>$modelShippingParameterAir,
		'modelShippingParameterMaritime'=>$modelShippingParameterMaritime,
)
); ?>