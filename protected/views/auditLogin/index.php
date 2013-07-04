<h1>Auditoria de Logueo</h1>

<div class="search-form" style="display:none">
</div><!-- search-form -->

<?php 
$userGroup = UserGroup::model()->findAll();
$userGroupList = CHtml::listData($userGroup,'Id','description');
$dataProvider = $model->search();

$this->widget('bootstrap.widgets.TbGridView', array(
		'type'=>'bordered',
		'dataProvider'=>$dataProvider,
		'filter'=>$model,
		'pager'=>array(
				'header'         => '',
				'firstPageLabel' => '&lt;&lt;',
				'lastPageLabel'  => '&gt;&gt;',
		),
		
		'template'=>'{items}{pager}',
	'columns'=>array(
		array('name'=>'date', 'htmlOptions'=>array('style'=>'width: 140px')),
		'username',
		array(
 			'name'=>'email',
			'value'=>'$data->user->email',
		),
		array(
 			'name'=>'user_group_desc',
			'value'=>'$data->user->userGroup->description',
			'filter'=>$userGroupList,
			'htmlOptions' => array('style'=>'min-width: 90px')
		),
		array(
 			'name'=>'user_name',
			'value'=>'$data->user->name',
		),
		array(
 			'name'=>'user_last_name',
			'value'=>'$data->user->last_name',
		),
	),
		));

?>
