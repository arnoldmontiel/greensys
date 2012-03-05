<?php
$this->breadcrumbs=array(
	'Suppliers'=>array($modelRelName.'/index'),
	$viewField=>array($modelRelName.'/view', 'id'=>$id),
	'Manage Contacts'=>array('contact/AjaxAdminContact','modelRelName'=>$modelRelName, 'id'=> $id, 'viewField'=>$viewField),
	$model->description=>array('contact/AjaxViewContact','modelRelName'=>$modelRelName, 'id'=> $id, 'viewField'=>$viewField, 'idContact'=>$idContact),
	'Update',
);

?>

<h1>Update Contact</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>