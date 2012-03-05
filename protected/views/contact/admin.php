<?php
$this->breadcrumbs=array(
	$modelRelName=>array($modelRelName.'/index'),
	$viewField=>array($modelRelName.'/view', 'id'=>$id),
	'Manage Contacts',
);


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('contact-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Contacts</h1>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'contact-grid',
	'dataProvider'=>$model->searchContact(),
	'filter'=>$model,
	'columns'=>array(
		array(
 			'name'=>'description',
			'value'=>'$data->contact->description',
		),
		array(
 			'name'=>'telephone_1',
			'value'=>'$data->contact->telephone_1',
		),
		array(
 			'name'=>'telephone_2',
			'value'=>'$data->contact->telephone_2',
		),
		array(
 			'name'=>'address',
			'value'=>'$data->contact->address',
		),
		array(
 			'name'=>'email',
			'value'=>'$data->contact->email',
		),
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view}{update}{delete}',
			'buttons'=>array
			(
			        'delete' => array
					(
			            'url'=>'Yii::app()->createUrl("contact/AjaxRemoveContact", array("id"=>'.$id.',"idContact"=>$data->Id_contact, "modelRelName"=>'.$modelRelName.'))',
					),
					'update' => array
					(
						'url'=>'Yii::app()->createUrl("contact/AjaxUpdateContact", array("id"=>'.$id.',"idContact"=>$data->Id_contact, "viewField"=>"'.$viewField.'", "modelRelName"=>'.$modelRelName.'))',
					),
					'view' => array
					(
			            'url'=>'Yii::app()->createUrl("contact/AjaxViewContact", array("id"=>'.$id.',"idContact"=>$data->Id_contact, "viewField"=>"'.$viewField.'", "modelRelName"=>'.$modelRelName.'))',
					),
			),
		),
	),
)); ?>
<br>
<div class="row buttons">
	<?php
		echo CHtml::link( CHtml::image('images/back.png','Back to '. $relation ,array(
																   'title'=>'Back to '. $relation,
												                   'style'=>'width:30px;',
												                   'id'=>'addBack',
                                									)
                            ),ContactController::createUrl('AjaxBackPrevious', array('modelRelName'=>$modelRelName, 'id'=>$id)));
		?>
</div>
