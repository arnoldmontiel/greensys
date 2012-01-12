<?php
$rel = strtolower($modelRelName);
$modelRel = new $modelRelName;
$modelRelDb = $modelRel->findByPk($id);
$this->breadcrumbs=array(
	$modelRelName=>array($modelRelName.'/index'),
	$modelRelDb->$viewField=>array($modelRelName.'/view', 'id'=>$id),
	'Create Contact',
);

?>

<h1>Create Contact</h1>

<?php echo $this->renderPartial('_form', array(
												'model'=>$model
											)); ?>