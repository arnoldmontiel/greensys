<?php
$this->breadcrumbs=array(
	$modelRelName=>array($modelRelName.'/index'),
	$viewField=>array($modelRelName.'/view', 'id'=>$id),
	'Create Contact',
);

?>

<h1>Create Contact</h1>

<?php echo $this->renderPartial('_form', array(
												'model'=>$model
											)); ?>