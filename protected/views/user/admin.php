<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Manage',
);
?>
<div class="well well-small">
<h4>Administrar Usuarios</h4>
</div>

<?php 
$columns = array(
		'username',
		'password',
		'email',
		'name',
		'last_name',
		array(
 			'name'=>'userGroupDescription',
			'value'=>'$data->userGroup->description',
		),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template'=>'{view} {update}',
		),
	);
$this->widget('bootstrap.widgets.TbGridView', array(
		'type'=>'bordered',
		'dataProvider'=>$model->searchAdmin(),
		'filter'=>$model,
		'template'=>'{items}{pager}',
		'pager'=>array(
				'hiddenPageCssClass'=>'disabled',
				'selectedPageCssClass'=>'active',
				'cssFile'=>'css/bootstrap-combined.no-icons.min.css',
				'header'         => '',
				'firstPageLabel' => '&lt;&lt;',
				'prevPageLabel' => '←',
				'nextPageLabel' => '→',
				'lastPageLabel'  => '&gt;&gt;',
		),
		'columns'=>$columns,
));

?>
