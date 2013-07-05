<?php
$this->breadcrumbs=array(
	'User Groups'=>array('index'),
	'Manage',
);

?>

<h1>Administrar Perfiles</h1>



<?php 
$columns =array(
		'description',
		array(
				'name'=>"is_administrator",
				'type'=>'raw',
				'value'=>'CHtml::checkBox("is_administrator",$data->is_administrator,array("disabled"=>"disabled"))',
				'filter'=>CHtml::listData(
						array(
								array('id'=>'0','value'=>'No'),
								array('id'=>'1','value'=>'Si')
						)
						,'id','value'
				),
		),
		array(
				'name'=>"is_internal",
				'type'=>'raw',
				'value'=>'CHtml::checkBox("is_internal",$data->is_internal,array("disabled"=>"disabled"))',
				'filter'=>CHtml::listData(
						array(
								array('id'=>'0','value'=>'No'),
								array('id'=>'1','value'=>'Si')
						)
						,'id','value'
				),
		),
		array(
				'class'=>'bootstrap.widgets.TbButtonColumn',
				'template'=>'{view} {update}',
		),
);
$this->widget('bootstrap.widgets.TbGridView', array(
		'type'=>'bordered',
		'dataProvider'=>$model->search(),
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
