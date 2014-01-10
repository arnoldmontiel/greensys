<?php 
$settings = new Settings();
?>
<div class="row contenedorPresu noBorder">
    <div class="col-sm-12">
      <div class="tituloFinalPresu">Extra</div>
      <ul class="nav nav-tabs">
        <li class="active"><a id="tabExtraItems" href="#tabRecargos" data-toggle="tab">Recargos</a></li>
        <li><a id="tabServices" href="#tabDescripciones" data-toggle="tab">Descripci&oacute;n de Servicios</a></li>
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
									'value'=>'CHtml::textField("quantity",$data->quantity,array("class"=>"form-control inputSmall align-right","onchange"=>"changeQuantity(".$data->Id.",this)"))',
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
</div>
    <!-- /.tab-content -->
      </div>
    <!-- /.col-sm-12 -->
  </div>
  <div class="row panelPresuFinal">
  <div class="col-sm-6"></div>
  <div class="col-sm-6">
  <div class="tituloFinalPresu">Total</div>
  <button type="button" class="btn btn-primary btn-sm agregarImp" data-toggle="modal" data-target="#myModalAgregarImp"><i class="fa fa-plus"></i> Agregar Impuesto</button>
<table class="table table-striped tablePresuTotal">
        <tbody>
          <tr>
            <td width="20%" valign="middle"  width="20%">Subtotal</td>
            <td width="30%">&nbsp;</td>
            <td valign="middle"  align="right" class="bold">
            	<div class=" label label-default label-subtotal">
            			<?php echo $settings->getCurrencyShortDescription()." ";?>
            			<span id="totals_total_price"><?php echo $model->totalPrice?></span>
            	</div>
            </td>
          </tr>
          <tr>
            <td valign="middle" >Discount</td>
            <td><input type="model" id="totals_percent_discount" class="form-control formHasLabel inputSmall align-right" value="<?php echo $model->percent_discount?>"> %</td>
            <td align="right" valign="middle" class="bold"> <div class="usd"><?php echo $settings->getCurrencyShortDescription()." ";?></div> <span id="totals_discount"><?php echo $model->TotalDiscount?></span></td>
          </tr>
          <tr class="superTotal">
            <td valign="middle" >Total</td>
            <td>&nbsp;</td>
            <td valign="middle"  align="right" class="bold">
            	<div class=" label label-primary label-total">
            		<?php echo $settings->getCurrencyShortDescription()." "?>
            		<span id="totals_price_w_discount"><?php echo $model->TotalPriceWithDiscount;?> </span>
            	</div>
            </td>
          </tr>
        </tbody>
      </table>
  </div>
  </div>
 <script type="text/javascript">
 function removeBudgetItem(id)
 {
	 if(confirm("¿Seguro desea eliminar este ítem?"))
	 {
		 
	 	$.post(
	 			'<?php echo BudgetController::createUrl('budget/AjaxRemoveBudgetItem')?>',
	 			 {
	 			 	id: id,
	 			 },'json').success(
	 				function(data) 
	 				{ 
						$.fn.yiiGridView.update('budget-item-generic');		 		
	 				}
	 			).error(function(){});
	 }			
		 
 }
 function addExtraItem(idBudget,versionNumber)
 {
 	$.post(
 			'<?php echo BudgetController::createUrl('budget/AjaxShowCreateModalBudgetItem')?>',
 			 {
 			 	id: idBudget,
 			 	version_number: versionNumber,
 	 			field_caller:'budget-item-generic'
 			 },'json').success(
 				function(data) 
 				{ 
 					if(data!='')
 					{
 						$('#modalPlaceHolder').html(data);
 						$('#modalPlaceHolder').modal('show');					
 					}
 				}
 			).error(function(){});			
 }
  
 function editProjectService(idProject,idService)
 {
 	$.post(
 			'<?php echo BudgetController::createUrl('project/AjaxShowUpdateModalProjectService')?>',
 			 {
 			 	Id_project: idProject,
 			 	Id_service: idService,
 			 	field_caller:'project-service-grid'
 			 },'json').success(
 				function(data) 
 				{ 
 					if(data!='')
 					{
 						$('#modalPlaceHolder').html(data);
 						$('#modalPlaceHolder').modal('show');					
 					}
 				}
 			).error(function(){});			
 }

 $("#tabServices").click(function()
 {
	 $("#addExtraItem").hide();
 });
 $("#tabExtraItems").click(function()
 {
	 $("#addExtraItem").show();
 });
 </script> 