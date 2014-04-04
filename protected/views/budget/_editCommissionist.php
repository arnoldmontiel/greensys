<script type="text/javascript">
function addCommissionist()
{	
	var value = $("#commissionist_value").val();
	if(value > 0)
	{
		$.post("<?php echo BudgetController::createUrl('AjaxAddCommissionist'); ?>",
			{
				idBudget:<?php echo $modelBudget->Id;?>,
				version:<?php echo $modelBudget->version_number;?>,
				name:$("#commissionist_name").val(),
				last_name:$("#commissionist_last_name").val(),
				value:value
			}
		).success(
			function(data){
				$("#commissionist_name").val(''),
				$("#commissionist_last_name").val(''),
				$("#commissionist_value").val(''),
				$.fn.yiiGridView.update('commissionist-grid');
				$('#btn-add-commissionist').addClass("disabled");
			});
		return false;
	}
}
function removeCommissionist(obj)
{		
	if(confirm("¿Seguro desea eliminar el comisionista?"))
	{
		
		$.post("<?php echo BudgetController::createUrl('AjaxRemoveCommissionist'); ?>",
			{
				idBudget:<?php echo $modelBudget->Id;?>,
				version:<?php echo $modelBudget->version_number;?>,
				idPerson:$(obj).attr("idperson")
			}
		).success(
			function(data){
				$.fn.yiiGridView.update('commissionist-grid');
			});
		return false;
	}
}

function checkAddEnabled()
{
	var name = $("#commissionist_name").val();
	var last_name = $("#commissionist_last_name").val();
	var value = $("#commissionist_value").val();

	if(name != "" && last_name != "" && value != "")
		$('#btn-add-commissionist').removeClass("disabled");
	else
		$('#btn-add-commissionist').addClass("disabled");		
}

function saveNewCommission(idBudget, version, idPerson, obj)
{
	var value = $(obj).val();
	if(value > 0)
	{
		var chkChanged = $("#chk-changed-"+idBudget+"-"+version+"-"+idPerson);
		var divCommission = $("#div-commission-value-"+idBudget+"-"+version+"-"+idPerson);		
		$.post("<?php echo BudgetController::createUrl('AjaxUpdateCommission'); ?>",
			{
				idBudget:idBudget,
				version:version,
				idPerson:idPerson,
				value:value
			}
		).success(
			function(data){
				divCommission.hide();				
				
				chkChanged.animate({opacity: 'show'},240);
				chkChanged.animate({opacity: 'hide'},3000, function(){
					divCommission.show();
				});
			});
		return false;
	}
}

function checkNumber(obj)
{
	var value=$(obj).val();
	if(value=="")
	{
    	$(obj).val("0");
	}
    var orignalValue=value;
    value=value.replace(/[0-9]*/g, "");			
   	var msg="Only Decimal Values allowed."; 						
   	value=value.replace(/\./, "");
    if (value!=""){
    	orignalValue=orignalValue.replace(value, "");
    	$(obj).val(orignalValue);
    	//alert(msg);
    }
}
</script>

<div class="row">
  <div class="col-sm-12">
  <table class="table table-condensed tablaIndividual">
  <thead>
  <tr>
  <th colspan="2">Comisionista</th>
  <th class="align-center">Porcentaje</th>
  <th class="align-right">Acciones</th>
  </tr>
  </thead>
  <tbody>
  <tr>
  <td width="210"><input onchange="checkAddEnabled();" id="commissionist_name" class="form-control" placeholder="Nombre"></td>
  <td width="210"><input onchange="checkAddEnabled();" id="commissionist_last_name" class="form-control" placeholder="Apellido"></td>
  <td class="align-center" width="110"><input onchange="checkAddEnabled();" onkeyup="checkNumber(this);" id="commissionist_value" class="form-control align-right formHasLabel inputSmall" placeholder="0.00">%</td>
  <td class="align-right"><button id="btn-add-commissionist" type="button" onclick="addCommissionist();" class="btn btn-primary btn-sm noMargin disabled"><i class="fa fa-plus"></i> Agregar</button></td>
  </tr>

  
  </tbody>
  </table>
  </div>
  <div class="col-sm-12">
  <?php
  $this->widget('zii.widgets.grid.CGridView', array(
  		'id'=>'commissionist-grid',
  		'dataProvider'=>$modelCommissionists->search(),
  		'selectableRows' => 0,
  		'summaryText'=>'',
		'hideHeader'=>true,
		'emptyText' => 'Este presupuesto a&uacute;n no tiene comisionistas.',
  		'itemsCssClass' => 'table table-condensed tablaIndividual',
		'ajaxUrl'=>BudgetController::createUrl('AjaxUpdateCommissionistGrid',array("Id"=>$modelBudget->Id,"version_number"=>$modelBudget->version_number)),
  		'columns'=>array(
  				array(
  						'value'=>'$data->person->name',
						'htmlOptions'=>array("width"=>"210"),
  				),
  				array(
  						'value'=>'$data->person->last_name',
						'htmlOptions'=>array("width"=>"210"),
  				),
  				array(
						'value'=>function($data){
							return '<div class="checkGuardado" id="chk-changed-'.$data->Id_budget.'-'.$data->version_number.'-'.$data->Id_person.'"><i class="fa fa-check"></i> Guardado</div>
								<div id="div-commission-value-'.$data->Id_budget.'-'.$data->version_number.'-'.$data->Id_person.'"><input onchange="saveNewCommission('.$data->Id_budget.','.$data->version_number.','.$data->Id_person.', this);" onkeyup="checkNumber(this);" class="form-control align-right formHasLabel inputSmall" placeholder="0.00" value="'.$data->percent_commission.'">%</div>';
						},
						'type'=>'raw',
						'htmlOptions'=>array("class"=>"align-center","width"=>"110"),
  				),  				
  				array(  						
  						'value'=>function($data){
  							return '<button type="button" idperson="'.$data->Id_person.'" onclick="removeCommissionist(this);" class="btn btn-default btn-sm noMargin"><i class="fa fa-trash-o"></i> Borrar</button>';
  						},
  						'type'=>'raw',
						'htmlOptions'=>array("class"=>"align-right"),
  		),
  		),
  ));
  ?>
  </div>
  </div>