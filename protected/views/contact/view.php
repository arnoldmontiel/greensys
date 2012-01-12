<?php

$modelRel = new $modelRelName;
$modelRelDb = $modelRel->findByPk($id);
$this->breadcrumbs=array(
	$modelRelName=>array($modelRelName.'/index'),
 	$modelRelDb->$viewField=>array($modelRelName.'/view', 'id'=>$id),
	'Manage Contacts'=>array('contact/adminContact','modelRelName'=>$modelRelName, 'id'=> $id, 'viewField'=>$viewField),
	$model->description
);

?>

<h1>View Contact</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'description',
		'telephone_1',
		'telephone_2',
		'telephone_3',
		'email',
		'address',
	),
)); ?>
<br>

<div class="row buttons">
	<?php
// 	Yii::app()->request->urlReferrer)
		echo CHtml::link( CHtml::image('images/back.png','Back to Manage' ,array(
																   'title'=>'Back to Manage',
												                   'style'=>'width:30px;',
												                   'id'=>'addBack',
                                									)
                            ),array('contact/adminContact','modelRelName'=>$modelRelName, 'id'=> $id, 'viewField'=>$viewField));
		?>
</div>
