<?php
$modelRel = new $modelRelName;
$modelRelDb = $modelRel->findByPk($id);
$this->breadcrumbs=array(
	'Suppliers'=>array($modelRelName.'/index'),
	$modelRelDb->$viewField=>array($modelRelName.'/view', 'id'=>$id),
	'Manage Contacts'=>array('contact/adminContact','modelRelName'=>$modelRelName, 'id'=> $id, 'viewField'=>$viewField),
	$model->description=>array('contact/ViewContact','modelRelName'=>$modelRelName, 'id'=> $id, 'viewField'=>$viewField, 'idContact'=>$idContact),
	'Update',
);

?>

<h1>Update Contact</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>