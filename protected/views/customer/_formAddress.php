<div class="col-sm-12 form-group">
	<label>  Agregar direcciones:</label>
  	<table class="table table-condensed tablaIndividual noMargin">
		<tbody>
  			<tr>
  				<td><input id="address-nickname" class="form-control" placeholder="Alias"></td>
  				<td><input id="address-value" class="form-control" placeholder="Direcci&oacute;n"></td>
  				<td class="align-right"><button onclick="addAddress();" type="button" class="btn btn-primary btn-sm noMargin"><i class="fa fa-plus"></i> </button></td>
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
				$nicknameField = '<input name="address['.$addressIndex.'][nickname]" class="form-control" placeholder="Alias" value="'.$modelProj->description.'">';
				$addressField = '<input name="address['.$addressIndex.'][value]" class="form-control" placeholder="Direcci&oacute;n" value="'.$modelProj->address.'">';
				
				echo '<tr>';
					echo $hiddenId;
					echo '<td>'.$addressIndex.'</td>';
					echo '<td>'.$nicknameField.'</td>';
					echo '<td>'.$addressField.'</td>';
					echo '<td class="align-right">';
						echo '<button onclick="removeAddress(this,'.$modelProj->Id.' );" type="button" class="btn btn-default btn-sm noMargin"><i class="fa fa-trash-o"></i> </button>';
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
						'<td>'+ nicknameField + '</td>' +
						'<td>'+ addressField + '</td>' +
						'<td class="align-right">' +
							'<button onclick="removeAddress(this, 0);" type="button" class="btn btn-default btn-sm noMargin"><i class="fa fa-trash-o"></i> </button>' +
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
					
					var hiddenRemoveId = '<input type="hidden" name="remove_address['+id+'][Id]" value="'+id+'">';
					$("#body-address > tbody").append(hiddenRemoveId);
					
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