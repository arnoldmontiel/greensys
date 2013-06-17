<?php
$this->breadcrumbs=array(
	'Review Types'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Crear Formulario', 'url'=>array('create')),
);

?>

<h1>Administrar Formularios</h1>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'review-type-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'description',		
		array(
 			'name'=>"with_tag_tracking",
 			'type'=>'raw',
 			'value'=>'CHtml::checkBox("with_tag_tracking",( TagReviewType::model()->countByAttributes(array("Id_review_type"=>$data->Id))>1)?true:false,array("disabled"=>"disabled"))',
	 			'filter'=>CHtml::listData(
					array(
						array('id'=>'1','value'=>'No'),
						array('id'=>'2','value'=>'Si')
					)
			,'id','value'
			),
		),
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view}{update}{delete}',
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
											
										
							$('#delete-review-type').html(data);
							$('#DeleteReviewType').dialog( 'open' );
						});
						return false;
					}"
			)
			),
		),
	),
)); ?>

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