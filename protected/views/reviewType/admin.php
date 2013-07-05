<?php
$this->breadcrumbs=array(
	'Review Types'=>array('index'),
	'Manage',
);

?>
<div class="well well-small">
<h4>Administrar Formularios</h4>
</div>

<?php
$columns =array(
		array('name'=>'description','htmlOptions' => array('style'=>'width:180px;')),
		array(
		    'name'=>'long_description',
		    'value'=>'$data->long_description',
		    'htmlOptions'=>array(),
		),
		array(
 			'name'=>"has_tag_tracking",
				'htmlOptions' => array('style'=>'width:100px;'),
	 			'type'=>'raw',
	 			'value'=>'CHtml::checkBox("has_tag_tracking",$data->has_tag_tracking,array("disabled"=>"disabled"))',
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
			'template'=>'{view} {update} {delete}',
			'buttons'=>array(
			'delete' => array
			(
					'options'=>array(), //HTML options for the button tag.					
					'click'=>'function(){
							jQuery("#DeleteReviewType").dialog("open"); return false;
							$("#Id_to_delete").val($.fn.yiiGridView.getSelection("review-type-grid"));
						}',
					
					'url'=>'Yii::app()->controller->createUrl("reviewType/AjaxDelete",array("id"=>$data->Id))',
					'click'=>"function(){
						$.post($(this).attr('href')).success(function(data){
											
							if(data != '')
							{			
								$('#delete-review-type').html(data);
								$('#DeleteReviewType').dialog( 'open' );
							}
							else
								alert('Para eliminar un formulario es necesario tener al menos uno del mismo tipo (Con Seguimiento / Sin Seguimiento)')
						});
						return false;
					}"
			)
			),
		),
	);
$this->widget('bootstrap.widgets.TbGridView', array(
		'id'=>'review-type-grid',
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

<?php 

//Project update
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
			'id'=>'DeleteReviewType',
// additional javascript options for the dialog plugin
			'options'=>array(
					'title'=>'Reemplazar tipo de formulario',
					'autoOpen'=>false,
					'modal'=>true,
					'width'=> '600',
					'buttons'=>	array(
							
							'Reemplazar'=>'js:function()
							{
							jQuery("#waiting").dialog("open");
							jQuery.post("'.Yii::app()->createUrl("ReviewType/AjaxReplace").'", $("#delete-reviewType-form").serialize(),
							function(data) {	
									//actualizar
									$.fn.yiiGridView.update("review-type-grid")
									jQuery("#DeleteReviewType").dialog( "close" );
							
							jQuery("#waiting").dialog("close");
						},"json"
					);

				}',
				'Cancelar'=>'js:function(){jQuery("#DeleteReviewType").dialog( "close" );}'),
),
));

//echo $this->renderPartial('_deletePopUp');
echo CHtml::openTag('div',array('id'=>'delete-review-type'));
//place holder
echo CHtml::closeTag('div');

$this->endWidget('zii.widgets.jui.CJuiDialog');
?>