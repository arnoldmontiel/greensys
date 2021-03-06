<?php
$this->breadcrumbs=array(
		'Customers'=>array('index'),
		$model->person->name,
);

Yii::app()->clientScript->registerScript('viewTapiaCustomer-begins', "
function getIdProjectSelected()
{
	var id_project = jQuery('#project-grid').yiiGridView('getSelection');
	if(id_project.length>0)
		id_project = id_project[0];
	else
		id_project = '';
	return id_project;
}

$('#link-export-employee-list').click(function(){
	var href = $(this).attr('bk-href');
	var idProject = $(this).attr('id-project');
		
	href = href + '&Id_project='+ idProject;
	$(this).attr('href',href);
	
});
");

Yii::app()->clientScript->registerScript('viewTapiaCustomer', "
function getIdProjectSelected()
{
	var id_project = jQuery('#project-grid').yiiGridView('getSelection');
	if(id_project.length>0)
		id_project = id_project[0];
	else
		id_project = '';
	return id_project;
}


		jQuery('#btnUpdateGrid').click(function(){
		
		var id_project = jQuery('#project-grid').yiiGridView('getSelection');
		if(id_project.length>0)
			id_project = id_project[0];
		else
			id_project = '';

		jQuery.post(
			'".TCustomerController::createUrl('AjaxUpdatePermissionGrid')."',
			{
				idCustomer: '".$model->Id."',
				idProject: id_project,
			}).success(
				function()
				{
				});
			return false;
		});

		",CClientScript::POS_LOAD);
?>
<div class="well well-small">
<h4>Cliente</h4>
</div>
<div class="left"style="margin-left:1px; width: 48%; ">
<?php 
$this->widget('bootstrap.widgets.TbDetailView', array(
		'data'=>$model,
		'attributes'=>array(
				array('label'=>$modelContact->getAttributeLabel('description'),
						'type'=>'raw',
						'value'=>$modelContact->description
				),
				array('label'=>$modelPerson->getAttributeLabel('name'),
						'type'=>'raw',
						'value'=>$modelPerson->name
				),
				array('label'=>$modelPerson->getAttributeLabel('last_name'),
						'type'=>'raw',
						'value'=>$modelPerson->last_name
				),
				array('label'=>$modelUser->getAttributeLabel('username'),
						'type'=>'raw',
						'value'=>$modelUser->username
				),
				array('label'=>$modelUser->getAttributeLabel('password'),
						'type'=>'raw',
						'value'=>$modelUser->password
				),
				array('label'=>$modelUser->getAttributeLabel('email'),
						'type'=>'raw',
						'value'=>$modelUser->email
				),
				array('label'=>$modelContact->getAttributeLabel('address'),
						'type'=>'raw',
						'value'=>$modelContact->address
				),
				array('label'=>$modelContact->getAttributeLabel('telephone_1'),
						'type'=>'raw',
						'value'=>$modelContact->telephone_1
				),
				array('label'=>$modelContact->getAttributeLabel('telephone_2'),
						'type'=>'raw',
						'value'=>$modelContact->telephone_2
				),				
				array('label'=>$modelUser->getAttributeLabel('send_mail'),
						'type'=>'raw',
						'value'=>CHtml::checkBox("send_mail",$modelUser->send_mail,array("disabled"=>"disabled"))
				),
		),
));
?>
</div>
<div class="right" style="margin-left:1px; width: 48%; ">
	<?php
	$hyperLinks = CHtml::listData($modelHyperlink, 'Id','description');
	
	$this->widget('ext.linkcontainer.linkcontainer', array(
		'id'=>'linkContainer',	// default is class="ui-sortable" id="yw0"
		'items'=>$hyperLinks,
		'mode'=>'show'
	));
	?>

</div>
<div class="customer-assign-title"style="float:left">
		<div style="display: inline-block;">
			Proyectos
		</div>
		<div style="display: inline-block; float: right;margin-right:20px;">
			<?php echo CHtml::link( 'Nuevo','#',array('onclick'=>'jQuery("#CreateProject").dialog("open"); return false;'));?>
		</div>
</div>
<?php
$this->widget('bootstrap.widgets.TbGridView', array(
		'id'=>'project-grid',
		'type'=>'bordered',
		'dataProvider'=>$modelProject->search(),
		'filter'=>$modelProject,
		'template'=>'{items}{pager}',
		'afterAjaxUpdate'=>'js:function(){$.fn.yiiGridView.update("user-group-grid");}',
		'selectionChanged'=>'js:function(id){
			var id_project = jQuery("#project-grid").yiiGridView("getSelection");
			if(id_project.length>0)
				id_project = id_project[0];
			else
				id_project = "";
				
			$.fn.yiiGridView.update("user-customer-grid", {data:
				{
					Project: {Id:id_project}
				}
			});
 			$.fn.yiiGridView.update("user-group-grid", {data:
				{
					Project: {Id:id_project}
				}
			});
			if(id_project!="")
			{
				jQuery(".customer-project-assign-area").animate({opacity: "show"},1000);
				$("#link-export-employee-list").attr("id-project",id_project);
			}
			else
			{
				jQuery(".customer-project-assign-area").animate({opacity: "hide"},1000);
			}

		}',
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
		'columns'=>array(
			array(
		 		'name'=>'description',
					'value'=>'$data->description',
			),
			array(
		 		'name'=>'address',
					'value'=>'$data->address',
			),
			array(
					'class'=>'bootstrap.widgets.TbButtonColumn',
					'template'=>'{delete} {update}',
					'buttons'=>array(
							'delete' => array(
									'url'=>'Yii::app()->createUrl("tCustomer/AjaxRemoveProject", array("IdProject"=>$data->Id))',
									'click'=>'function(){
																$.post($(this).attr("href"), function(data) {
									  							if(data!="")
									  							{
																	alert(data);
																}else{
																	$.fn.yiiGridView.update("project-grid");
																}
																});
																return false;
															}',
							),'update'=>array(
								'url'=>'Yii::app()->controller->createUrl("project/AjaxUpdate",array("id"=>$data->primaryKey))',
								'click'=>"function(){
									$.post($(this).attr('href')).success(function(data){
										$('#update-project').html(data);
										$('#UpdateProject').dialog( 'open' );
									});
									return false;
								}"
							),
					),
			),

	),
));

?>
<div class="customer-project-assign-area" style="display: none">
<div class="customer-assign-title">
	Usuarios Asignados	
	<div class="send-mail">
	<?php
	$image = CHtml::image('images/export_plain_text.png','Export',
					array(
							'style'=>'width:25px;margin-top:6px;'
					)
			);
	$url = Yii::app()->createUrl('GenerateEmployeeList',array('Id_customer'=>$model->Id));
	echo CHtml::link($image,
			$url,
			array('title'=>'Exportar N&oacute;mina empleados','id'=>'link-export-employee-list',
			'bk-href'=>$url)
	);
	?>		
	</div>
	<div class="customer-button-box">
	<?php echo CHtml::button('Asignar Usuarios',array('id'=>'btn-assign-user',
				'onclick'=>
				'
				jQuery("#customer-assign-area").toggle();
				if(jQuery("#customer-assign-area").is(":hidden"))
				{
					jQuery(this).val("Asignar Usuarios");
				}
				else
				{
					jQuery(this).val("Terminar");			
				}
				return false;',
	)); ?>
	</div>
</div>

<div id="customer-assign-area" style="display: none">

<div class="customer-assign-title">
Usuarios Disponibles
<div class="customer-button-box">
<?php 
echo CHtml::button('Nuevo Usuario', array('class'=>'customer-new-user',
					'onclick'=>'jQuery("#CreateUser").dialog("open"); return false;',
));

?>
		</div>

	</div>

	<?php 
	$creteria = new CDbCriteria();
	//$creteria->addCondition('is_internal = 0');
	$creteria->addNotInCondition('Id', array('1','3'));
	$userGroup = UserGroup::model()->findAll($creteria);
	$userGroupList = CHtml::listData($userGroup,'Id','description');
	$this->widget('bootstrap.widgets.TbGridView', array(
			'id'=>'user-group-grid',
			'type'=>'bordered',
			'dataProvider'=>$modelUserGrid->searchUnassigned(),
			'filter'=>$modelUserGrid,
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
'selectionChanged'=>'js:function(id){
			var id_project = jQuery("#project-grid").yiiGridView("getSelection");
			if(id_project.length>0)
				id_project = id_project[0];
			else
				id_project = "";

			$.get(	"'.TCustomerController::createUrl('AjaxAddUserCustomer').'",
			{
			IdCustomer:'.$model->Id.',
			IdProject:id_project,
			username:$.fn.yiiGridView.getSelection("user-group-grid")
			}).success(
			function()
			{
				var id_project = jQuery("#project-grid").yiiGridView("getSelection");
				if(id_project.length>0)
					id_project = id_project[0];
				else
					id_project = "";
				$.fn.yiiGridView.update("user-group-grid", {
					//data: $(this).serialize()
					data:{ Project: {Id:id_project}}
				});
		
				$.fn.yiiGridView.update("user-customer-grid", {
					data:{ Project: {Id:id_project}}
				});

})
			.error(
			function()
			{
			$(".messageError").animate({opacity: "show"},2000);
			$(".messageError").animate({opacity: "hide"},2000);
});
}',
'columns'=>array(
		array(
				'name'=>"Id_user_group",
				'type'=>'raw',
				'value'=>'$data->userGroup->description',
				'filter'=>$userGroupList,
		),
		'name',
		'last_name',
		'email',
		'phone_house',
		'phone_mobile',
),
	));
	
	?>


	<?php 
	$this->widget('ext.processingDialog.processingDialog', array(
			'buttons'=>array('save'),
			'idDialog'=>'wating',
	));
	$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
			'id'=>'CreateUser',
			// additional javascript options for the dialog plugin
			'options'=>array(
					'title'=>'Crear Usuario',
					'autoOpen'=>false,
					'modal'=>true,
					'width'=> '500',
					'buttons'=>	array(							
							'Grabar'=>'js:function()
							{
							jQuery("#wating").dialog("open");
					
							jQuery.post("'.Yii::app()->createUrl("user/create").'", $("#user-form").serialize(),
							function(data) {
							var id_project = jQuery("#project-grid").yiiGridView("getSelection");
							if(id_project.length>0)
								id_project = id_project[0];
							else
								id_project = "";
	
							$.fn.yiiGridView.update("user-group-grid", {
							Project: {Id:id_project}
							});

							jQuery("#wating").dialog("close");
							jQuery("#CreateUser").dialog( "close" );
}
					);

}',
						'Cancelar'=>'js:function(){jQuery("#CreateUser").dialog( "close" );}'),
			),
	));
	$modelUserCreate = new User;
	$criteria=new CDbCriteria;
	$criteria->condition='Id <> 3'; // clients
	$ddlUserGroup = UserGroup::model()->findAll($criteria);
	echo $this->renderPartial('_formUser', array('model'=>$modelUserCreate ,'ddlUserGroup'=>$ddlUserGroup));

	$this->endWidget('zii.widgets.jui.CJuiDialog');
	?>
</div>
<?php 
$this->widget('bootstrap.widgets.TbGridView', array(
		'id'=>'user-customer-grid',
		'type'=>'bordered',
		'dataProvider'=>$modelUserCustomer->search(),
		'filter'=>$modelUserCustomer,
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
		'afterAjaxUpdate'=>'js:function(){
			var id_project = jQuery("#project-grid").yiiGridView("getSelection");
			if(id_project.length>0)
				id_project = id_project[0];
			else
				id_project = "";

			$.fn.yiiGridView.update("user-group-grid", {
			data:{Project: {Id:id_project}}
			});

			//$.fn.yiiGridView.update("user-group-grid");
		}',

'columns'=>array(
		array(
				'name'=>"Id_user_group",
				'type'=>'raw',
				'value'=>'$data->user->userGroup->description',
				'filter'=>$userGroupList,
		),
		array(
				'name'=>'name',
				'value'=>'$data->user->name',
		),
		array(
				'name'=>'last_name',
				'value'=>'$data->user->last_name',
		),
		array(
				'name'=>'email',
				'value'=>'$data->user->email',
		),
		array(
				'name'=>'phone_house',
				'value'=>'$data->user->phone_house',
		),
		array(
				'name'=>'phone_mobile',
				'value'=>'$data->user->phone_mobile',
		),
		array(
				'class'=>'bootstrap.widgets.TbButtonColumn',
				'template'=>'{delete}',
				'buttons'=>array(
						'delete' => array(
								'url'=>'Yii::app()->createUrl("tCustomer/AjaxRemoveUserCustomer", array("IdCustomer"=>$data->Id_customer,"username"=>$data->username))',
						),
				),
		),

),
));
?>

</div>
<?php 
//Project create
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
			'id'=>'CreateProject',
// additional javascript options for the dialog plugin
			'options'=>array(
					'title'=>'Crear Proyecto',
					'autoOpen'=>false,
					'modal'=>true,
					'width'=> '600',
					'buttons'=>	array(							
							'Grabar'=>'js:function()
							{
							jQuery("#waiting").dialog("open");
							jQuery.post("'.Yii::app()->createUrl("project/ajaxCreate").'", $("#project-form").serialize(),
							function(data) {
								if(data!=null)
								{
									//actualizar
									$.fn.yiiGridView.update("project-grid")
									jQuery("#CreateProject").dialog( "close" );
								}
							jQuery("#waiting").dialog("close");
						},"json"
					);

				}',
				'Cancelar'=>'js:function(){jQuery("#CreateProject").dialog( "close" );}'),
),
));
$modelProjectPopUp = new Project;
$modelProjectPopUp->Id_customer = $model->Id;
echo $this->renderPartial('../project/_formPopUp', array('model'=>$modelProjectPopUp));

$this->endWidget('zii.widgets.jui.CJuiDialog');
//Project update
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
			'id'=>'UpdateProject',
// additional javascript options for the dialog plugin
			'options'=>array(
					'title'=>'Actualizar Proyecto',
					'autoOpen'=>false,
					'modal'=>true,
					'width'=> '600',
					'buttons'=>	array(							
							'Grabar'=>'js:function()
							{
							jQuery("#waiting").dialog("open");
							jQuery.post("'.Yii::app()->createUrl("project/ajaxSave").'", $("#project-update-form").serialize(),
							function(data) {
								if(data!=null)
								{
									//actualizar
									$.fn.yiiGridView.update("project-grid")
									jQuery("#UpdateProject").dialog( "close" );
								}
							jQuery("#waiting").dialog("close");
						},"json"
					);

				}',
				'Cancelar'=>'js:function(){jQuery("#UpdateProject").dialog( "close" );}'),
),
));
$modelProjectPopUp = new Project;
$modelProjectPopUp->Id_customer = $model->Id;
echo CHtml::openTag('div',array('id'=>'update-project'));
//place holder
echo CHtml::closeTag('div');

$this->endWidget('zii.widgets.jui.CJuiDialog');

?>

