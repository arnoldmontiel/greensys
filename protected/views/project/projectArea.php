<?php
$this->breadcrumbs=array(
	'Project'=>array('index'),
	'Assing Area',
);
$this->menu=array(
	array('label'=>'Create Project', 'url'=>array('create')),
	array('label'=>'Manage Project', 'url'=>array('admin')),
);

Yii::app()->clientScript->registerScript(__CLASS__.'#assign_area_project', "

jQuery( document ).ready(function( $ ) {
$.fn.yiiGridView.update('area-project-grid', {
							data: $(this).serialize()
							});
});


");
?>



<div class="form">
	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'ProjectArea-form',
		'enableAjaxValidation'=>true,
	)); ?>
	
	<div id="Display">
		<div class="gridTitle-decoration1" style="float: left; width: 50%;">
			<div class="gridTitle1">
				Assigned (check centralized area)
			</div>
		</div>
		<div class="gridTitle-decoration1" >
			<div class="gridTitle1" >
				Areas
			</div>
		</div>
		<div id="ProjectArea"class="assigned-items" style="float: left; width: 45%;">
			<?php 	// Organize the dataProvider data into a Zii-friendly array
					$this->widget('zii.widgets.grid.CGridView', array(
					'id'=>'area-project-grid',
					'dataProvider'=>$modelAssignedArea->search(),
					'filter'=>$modelAssignedArea,
					'summaryText'=>'',	
					'selectableRows'=>0,
					'afterAjaxUpdate'=>'function(id, data){
							$("#area-project-grid").find("input.txtRelDescription").each(
										function(index, item){
									
													$(item).change(function(){
														var target = $(this);
														
														$.post(
															"'.PriceListController::createUrl('AjaxUpdateRelDescription').'",
															 {
															 	idAreaProject: $(this).attr("id"),
																relDescription:$(this).val()
															 }).success(
																 	function() 
																 		{ 
																 			$(target).parent().parent().find("#saveok1-sale").animate({opacity: "show"},4000,
																			function(){$(target).parent().parent().find("#saveok1-sale").animate({opacity: "hide"},4000);});																						
																		});
															
													});
											});
							$("#area-project-grid").find("input.chkCentralized").each(
										function(index, item){
									
													$(item).click(function(){
														var target = $(this);
														
														$.post(
															"'.PriceListController::createUrl('AjaxUpdateCentralized').'",
															 {
															 	idAreaProject: $(this).attr("id"),
																isCentralized:$(this).is(":checked")
															 }).success(
																 	function() 
																 		{ 
																 			$(target).parent().parent().find("#saveok2-sale").animate({opacity: "show"},4000,
																			function(){$(target).parent().parent().find("#saveok2-sale").animate({opacity: "hide"},4000);});																						
																		});
															
													});
											});	
					}',
					'columns'=>array(	
									array(
										'name'=>'descripionArea',
									    'value'=>'$data->area->description',				 
									),
									array(
										'name'=>'description',
										'value'=>
		                                    	'CHtml::textField("txtRelDescription",
														$data->description,
														array(
																"id"=>$data->Id,
																"class"=>"txtRelDescription",
																"maxlength"=>200,
																"style"=>"width:150px;text-align:left;",
															)
													)',
					
										'type'=>'raw',
									),
									array(
										'value'=>'CHtml::image("images/save_ok.png","",array("id"=>"saveok1-sale", "style"=>"display:none", "width"=>"20px", "height"=>"20px"))',
										'type'=>'raw',
										'htmlOptions'=>array('width'=>25),
									),
									array(
										'name'=>'centralized',
										'value'=>
							            		'CHtml::checkBox("chkCentralized",
														$data->centralized,
														array(
																"id"=>$data->Id,
																"class"=>"chkCentralized",
															)
													)',
	
										'type'=>'raw',
									),
									array(
										'value'=>'CHtml::image("images/save_ok.png","",array("id"=>"saveok2-sale", "style"=>"display:none", "width"=>"20px", "height"=>"20px"))',
										'type'=>'raw',
										'htmlOptions'=>array('width'=>25),
									),
									array(
										'class'=>'CButtonColumn',
										'template'=>'{delete}',
										'buttons'=>array
													(
													'delete' => array
																(
														        	'url'=>'Yii::app()->createUrl("project/AjaxRemoveProjectArea", array("IdArea"=>$data->Id_area,
														        																		"IdProject"=>$data->Id_project,
														        																		"centralized"=>$data->centralized))',
																),
													),
									),
								),
						));
					?>
		</div>
		<div id="Area" class="selectable-items" style="float: right; width: 45%;">
				<?php 	// Organize the dataProvider data into a Zii-friendly array
					$this->widget('zii.widgets.grid.CGridView', array(
					'id'=>'area-grid',
					'dataProvider'=>$modelArea->search(),
					'filter'=>$modelArea,
					'summaryText'=>'',	
					'selectionChanged'=>'js:function(id){
							$.post(	"'.ProjectController::createUrl('AjaxAddProjectArea').'",
							{
								IdProject:'.$idProject.',
								IdArea:$.fn.yiiGridView.getSelection("area-grid")
							}).success(
								function() 
								{
									markAddedRow("area-grid");
									
									$.fn.yiiGridView.update("area-project-grid", {
									data: $(this).serialize()
									});
									
									unselectRow("area-grid");		
								})
							.error(
								function(data)
								{
									unselectRow("area-grid");
								});
						}',
					'columns'=>array(	
									array(
										'name'=>'description',
									    'value'=>'$data->description',				 
									),
									array(
										'name'=>'main',
										'value'=>
							            		'CHtml::checkBox("chkMain",
														$data->main,
														array(
																"disabled"=>"disabled",
															)
													)',
	
										'type'=>'raw',
									),
								),
						));
					?>
		</div>
	</div>	
	<?php $this->endWidget(); ?>
	<div id="display"></div>
</div><!-- form -->
