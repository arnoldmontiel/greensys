<?php
$this->breadcrumbs=array(
	'Customers'=>array('index'),
	'Manage',
);

?>
<div class="well well-small">
<h4>Administrar Clientes</h4>
</div>

<?php
$columns=array(
		array(
				'name'=>'contact_description',
				'value'=>'$data->contact->description',
		),
		array(
				'name'=>'name',
				'value'=>'$data->person->name',
		),
		array(
				'name'=>'last_name',
				'value'=>'$data->person->last_name',
		),
		array(
				'name'=>'telephone_1',
				'value'=>'$data->contact->telephone_1',
		),
		array(
				'name'=>'email',
				'value'=>'$data->contact->email',
		),
		array(
				'class'=>'bootstrap.widgets.TbButtonColumn',
				'template'=>'{view} {update} {delete}',
				'buttons'=>array(
						'delete' => array
						(
								'options'=>array(), //HTML options for the button tag.
								'url'=>'Yii::app()->createUrl("initCustomer/AjaxDelete", array("Id"=>$data->Id))',
								'click'=>'function(){
							$.get($(this).attr("href"), function(data) {
  							if(data!="")
  							{
								alert(data);
							}
							else
							{
								$.fn.yiiGridView.update("customer-grid");
							}
							});
							return false;
						}',
						)
				),
		),
);
$this->widget('bootstrap.widgets.TbGridView', array(
		'id'=>'customer-grid',
		'type'=>'bordered',
		'dataProvider'=>$model->searchInitCustomer(),
		'filter'=>$model,
		'template'=>'{items}{pager}',
		'pager'=>array(
				'hiddenPageCssClass'=>'disabled',
				'selectedPageCssClass'=>'active',
				'cssFile'=>'css/bootstrap-combined.no-icons.min.css',
				'header'         => '',

		),
		'columns'=>$columns,
));
?>
