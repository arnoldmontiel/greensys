<h1>Auditoria de Logueo</h1>

<div class="search-form" style="display:none">
</div><!-- search-form -->

<?php 
$userGroup = UserGroup::model()->findAll();
$userGroupList = CHtml::listData($userGroup,'Id','description');
$dataProvider = $model->search();
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'audit-login-grid',
	'dataProvider'=>$dataProvider,
	'filter'=>$model,
	'columns'=>array(
		'date',
		'username',
		array(
 			'name'=>'email',
			'value'=>'$data->user->email',
		),
		array(
 			'name'=>'user_group_desc',
			'value'=>'$data->user->userGroup->description',
			'filter'=>$userGroupList,
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
)); ?>
