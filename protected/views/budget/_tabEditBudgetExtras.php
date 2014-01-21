<?php 
$settings = new Settings();
?>
<div class="row contenedorPresu noBorder">
    <div class="col-sm-12">
      <div class="tituloFinalPresu">Configurar Servicios</div>
      <ul class="nav nav-tabs">
        <li class="active"><a id="tabExtraItems" href="#tabRecargos" data-toggle="tab">Recargos</a></li>
        <li><a id="tabServices" href="#tabDescripciones" data-toggle="tab">Descripciones</a></li>
        <li><a id="tabServicesNote" href="#tabNotas" data-toggle="tab">Notas</a></li>
        <li class="pull-right"><button id="addExtraItem" type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModalAgregarRec" onclick="addExtraItem(<?php echo $model->Id?>,<?php echo $model->version_number?>);"><i class="fa fa-plus"></i> Agregar</button></li>
        </ul>
        <div class="tab-content">
        <div class="tab-pane active" id="tabRecargos">
        <?php
	$selectPrice='$data->price." "."<div class=\"usd\">'.$settings->getEscapedCurrencyShortDescription().'</div>"';
	
	$this->widget('zii.widgets.grid.CGridView', array(
					'id'=>'budget-item-generic',
					'dataProvider'=>$modelBudgetItem->searchGenericItem(),
					'summaryText'=>'',
					'selectableRows' => 0,
					'itemsCssClass' => 'table table-striped table-bordered tablaIndividual',
					'afterAjaxUpdate'=>'js:function(id, data){setTotals();}',
					'emptyText' => 'A&uacute;n sin recargos.',				
					'columns'=>array(
							'description',
							array(
									'name'=>'quantity',
									'value'=>function($data){
										if($data->description=="Horas de programación"||$data->description=="Horas de instalación")
										{
											return $data->quantity;
												
										}else {
											return CHtml::textField("quantity",$data->quantity,array("class"=>"form-control inputMed align-right","onchange"=>"changeQuantity(".$data->Id.",this)"));
												
										}
									},
									'type'=>'raw',
							'htmlOptions'=>array("class"=>"align-center"),
							'headerHtmlOptions'=>array("class"=>"align-center"),
							),					array(
							'name'=>'price',
							'value'=>$selectPrice,
							'type'=>'raw',
							'htmlOptions'=>array("class"=>"align-right"),
							'headerHtmlOptions'=>array("class"=>"align-right"),
					),
					array(
						'name'=>'discount',
						'value'=>
						'"<div class=\"bloqueDescuento\"> ".CHtml::textField("txtDiscount","$data->discount",array("id"=>"discount_".$data->Id,"onchange"=>"changeDiscount(".$data->Id.",this)","class"=>"form-control inputMed align-right",))."<div class=\"radioTipo\"><div class=\"radio\">
				  <label>
				    <input type=\"radio\" name=\"optionsRadios_".$data->Id."\" id=\"discount_type_".$data->Id."\" value=\"0\" onclick=\"changeDiscountType(".$data->Id.",this);\" ".($data->discount_type==0?"checked":"").">
				    <div class=\"usd\">%</div>
				  </label>
				</div>
				<div class=\"radio\">
				  <label>
				    <input type=\"radio\" name=\"optionsRadios_".$data->Id."\" id=\"discount_type_".$data->Id."\" value=\"1\" onclick=\"changeDiscountType(".$data->Id.",this);\" ".($data->discount_type==1?"checked":"").">
				    <div class=\"usd\">USD</div>
				  </label>
				</div></div></div>"',
						'type'=>'raw',
							'htmlOptions'=>array("class"=>"align-center"),
							'headerHtmlOptions'=>array("class"=>"align-center"),
				),
							
					array(
							'name'=>'Total',
							'value'=>
							'CHtml::openTag("span",array("id"=>"total_price_".$data->Id, "class"=>"label label-primary labelPrecio")).$data->totalPrice." ".'.
							'CHtml::openTag("div",array("class"=>"usd"))."'.$settings->getEscapedCurrencyShortDescription().'".CHtml::closeTag("div").CHtml::closeTag("span")',
							'type'=>'raw',
'htmlOptions'=>array("class"=>"align-right"),
'headerHtmlOptions'=>array("class"=>"align-right"),
					),
							array(
									'name'=>'Acciones',
									'value'=>'"<button type=\"button\" class=\"btn btn-default btn-sm\" onclick=\"removeBudgetItem(".$data->Id.");\" ><i class=\"fa fa-trash-o\"></i> Borrar</button>"',
									'type'=>'raw',
									'htmlOptions'=>array("style"=>"text-align:right;"),
									'headerHtmlOptions'=>array("style"=>"text-align:right;"),
							),

							),
					));
        ?>

</div> 
    <!-- /.tab1 -->
<div class="tab-pane" id="tabDescripciones">

  <?php 
$projectService = new ProjectService();
$projectService->Id_project = $model->Id_project;
	$this->widget('zii.widgets.grid.CGridView', array(
					'id'=>'project-service-grid',
					'dataProvider'=>$projectService->search(),
					'summaryText'=>'',
					'selectableRows' => 0,
					'itemsCssClass' => 'table table-striped table-bordered tablaIndividual',
					'columns'=>array(
							array(
									'header'=>'Servicios',
									'value'=>'$data->service->description',
									'type'=>'raw'
							),					
							array(
									'header'=>'Descripci&oacute;n',
									'value'=>'GreenHelper::cutString($data->long_description==""?$data->service->long_description:$data->long_description,130)',
									'type'=>'raw'
							),
							array(
									'name'=>'Acciones',
									'value'=>'"<button type=\"button\" class=\"btn btn-default btn-sm\" onclick=\"editProjectService(".$data->Id_project.",".$data->Id_service.");\" ><i class=\"fa fa-pencil\"></i> Editar</button>"',
									'type'=>'raw',
									'htmlOptions'=>array("style"=>"text-align:right;"),
									'headerHtmlOptions'=>array("style"=>"text-align:right;"),
							),
							),
					));
        ?>
</div> 
    <!-- /.tab2 -->
<div class="tab-pane" id="tabNotas">

  <?php 
$projectService = new ProjectService();
$projectService->Id_project = $model->Id_project;
	$this->widget('zii.widgets.grid.CGridView', array(
					'id'=>'project-service-note-grid',
					'dataProvider'=>$projectService->search(),
					'summaryText'=>'',
					'selectableRows' => 0,
					'itemsCssClass' => 'table table-striped table-bordered tablaIndividual',
					'columns'=>array(
							array(
									'header'=>'Servicios',
									'value'=>'$data->service->description',
									'type'=>'raw'
							),					
							array(
									'header'=>'Notas',
									'value'=>'GreenHelper::cutString($data->note==""?$data->service->note:$data->note,130)',
									'type'=>'raw'
							),
							array(
									'name'=>'Acciones',
									'value'=>'"<button type=\"button\" class=\"btn btn-default btn-sm\" onclick=\"editProjectServiceNote(".$data->Id_project.",".$data->Id_service.");\" ><i class=\"fa fa-pencil\"></i> Editar</button>"',
									'type'=>'raw',
									'htmlOptions'=>array("style"=>"text-align:right;"),
									'headerHtmlOptions'=>array("style"=>"text-align:right;"),
							),
							),
					));
        ?>
</div> 
    <!-- /.tab3 -->
</div>
    <!-- /.tab-content -->
      </div>
    <!-- /.col-sm-12 -->
  </div>
  
 <script type="text/javascript">
 
 </script> 