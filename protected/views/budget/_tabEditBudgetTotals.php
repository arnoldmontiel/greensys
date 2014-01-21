<?php 
$settings = new Settings();
?>

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

 function editProjectServiceNote(idProject,idService)
 {
 	$.post(
 			'<?php echo BudgetController::createUrl('project/AjaxShowUpdateModalProjectServiceNote')?>',
 			 {
 			 	Id_project: idProject,
 			 	Id_service: idService,
 			 	field_caller:'project-service-note-grid'
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
 $("#tabServicesNote").click(function()
 {
	 $("#addExtraItem").hide();
 });
 $("#tabExtraItems").click(function()
 {
	 $("#addExtraItem").show();
 });
 </script> 