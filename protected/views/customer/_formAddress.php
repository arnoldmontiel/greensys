<div class="col-sm-12 form-group">
	<label>  Agregar direcciones:</label>
  	<table class="table table-condensed tablaIndividual noMargin">
  		<thead>
			<tr>
  				<th>Direcci&oacute;n</th>
  				<th>Alias</th>
  				<th class="align-right">Accion</th>
			</tr>
		</thead>
		<tbody>
  			<tr>
  				<td><input id="address-value" class="form-control" placeholder="Direcci&oacute;n"></td>
  				<td><input id="address-nickname" class="form-control" placeholder="Alias"></td>
  				<td class="align-right"><button onclick="addAddress();" type="button" class="btn btn-primary btn-sm noMargin"><i class="fa fa-plus"></i> Agregar</button></td>
			</tr>
		</tbody>
	</table>
</div>
<div class="col-sm-12 form-group">
	<div>
		<div class="summary"></div>
		<table id="body-address" class="table table-condensed tablaIndividual noMargin">
			<tbody>
			<?php 
			$modelProjects = Project::model()->findAllByAttributes(array('Id_customer'=>$modelCustomer->Id));
			$addressIndex = 1;
			foreach($modelProjects as $modelProj)
			{
				$hiddenId = '<input type="hidden" name="address['.$addressIndex.'][Id]" value="'.$modelProj->Id.'">';
				$addressField = '<input name="address['.$addressIndex.'][value]" class="form-control" placeholder="Direcci&oacute;n" value="'.$modelProj->address.'">';
				$nicknameField = '<input name="address['.$addressIndex.'][nickname]" class="form-control" placeholder="Alias" value="'.$modelProj->description.'">';
				
				echo '<tr>';
					echo $hiddenId;
					echo '<td>'.$addressIndex.'</td>';
					echo '<td>'.$addressField.'</td>';
					echo '<td>'.$nicknameField.'</td>';
					echo '<td class="align-right">';
						echo '<button onclick="removeAddress(this,'.$modelProj->Id.' );" type="button" class="btn btn-default btn-sm noMargin"><i class="fa fa-trash-o"></i> Borrar</button>';
					echo '</td>';
				echo '</tr>';
				$addressIndex++;
			}
			?>
			</tbody>
		</table>
	</div> 
	<div id="error-div" style="display:none" class="alert alert-danger"><i class="fa fa-warning"></i><span id="error-msg"></span></div>
</div>
<script type="text/javascript">
function addAddress()
{
	var addressNum = $("#body-address > tbody > tr").length + 1;
	var addressDesc = $("#address-value").val();

	var addressNick = $("#address-nickname").val();
			
	if(addressDesc != '')
	{
		var addressField = '<input class="form-control" placeholder="Direcci&oacute;n" name="address['+ addressNum +'][value]" value="'+ addressDesc +'">';
		var nicknameField = '<input class="form-control" placeholder="Alias" name="address['+ addressNum +'][nickname]" value="'+ addressNick +'">';
		
		var newTr = '<tr>' +
						'<td>'+ addressNum +'</td>' +
						'<td>'+ addressField + '</td>' +
						'<td>'+ nicknameField + '</td>' +
						'<td class="align-right">' +
							'<button onclick="removeAddress(this, 0);" type="button" class="btn btn-default btn-sm noMargin"><i class="fa fa-trash-o"></i> Borrar</button>' +
						'</td>' +
					'</tr>';
		
		$("#body-address > tbody").append(newTr);
		$("#address-value").val('');
		$("#address-nickname").val('');
		$("#error-div").hide();
	}
	else		
	{
		$("#error-msg").html(" La direcci&oacute;n no puede estar vac&iacute;a");
		$("#error-div").show();
	}
	
}

function removeAddress(obj, id)
{	
	if(id > 0)
	{
	$.post("<?php echo CustomerController::createUrl('AjaxCanRemoveAddress'); ?>",
			{
				idProject:id
			}
		).success(
			function(data){
				if(data == 0)
				{
					$("#error-msg").html(" La direcci&oacute;n posee una relaci&oacute;n con un presupuesto");
					$("#error-div").show();
				}
				else
				{
					$(obj).parent().parent().remove();
					var index = 1;
					$("#body-address > tbody > tr").each(function(){
						var tdNum = $(this).children()[0];
						$(tdNum).text(index);
						index++;
					});
				}
			});
		return false;	
	}
	else
	{
		$(obj).parent().parent().remove();
		var index = 1;
		$("#body-address > tbody > tr").each(function(){
			var tdNum = $(this).children()[0];
			$(tdNum).text(index);
			index++;
		});
	}
}
</script>