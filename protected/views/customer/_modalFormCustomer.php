<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
			<h4 class="modal-title">Agregar Cliente</h4>
		</div>
		<div class="modal-body">
			<form id="form-new-customer" role="form">
				<?php echo CHtml::activeHiddenField($modelCustomer, 'Id');?>
				<div class="form-group row">
					<div class="col-sm-6">
						<?php echo CHtml::activeLabel($modelPerson, 'name'); ?>
						<?php echo CHtml::activeTextField($modelPerson, 'name', array('class'=>'form-control')); ?>
					</div>
					<div class="col-sm-6">
						<?php echo CHtml::activeLabel($modelPerson, 'last_name'); ?>
						<?php echo CHtml::activeTextField($modelPerson, 'last_name', array('class'=>'form-control')); ?>
					</div>
				</div>
				<div class="form-group row">
					<div class="col-sm-4">
						<?php echo CHtml::activeLabel($modelContact, 'telephone_1'); ?>
						<?php 
						$ddlTel = array('Movil'=>'Movil',
											'Trabajo'=>'Trabajo',
											'Personal'=>'Personal',
											'Principal'=>'Principal',
											'Fax Trabajo'=>'Fax Trabajo',
											'Fax Casa'=>'Fax Casa',
											'Google Voice'=>'Google Voice',
											'Pager'=>'Pager',
											);
						echo CHtml::activeDropDownList($modelContact, 'tel1_description',
	    					$ddlTel,array('class'=>'form-control'));
						?>
					</div>
					<div class="col-sm-6">
						<label for="campoTelefono">&nbsp;</label>
						<?php echo CHtml::activeTextField($modelContact, 'telephone_1', array('class'=>'form-control')); ?>
					</div>
				</div>
				<div id="tel2" class="form-group row hidden">
					<div class="col-sm-4">
						<?php 
						echo CHtml::activeDropDownList($modelContact, 'tel2_description',
	    					$ddlTel,array('class'=>'form-control'));
						?>
					</div>
					<div class="col-sm-6">
						<?php echo CHtml::activeTextField($modelContact, 'telephone_2', array('class'=>'form-control')); ?>
					</div>
					<div id="btn-remove-tel-2" class="col-sm-2">
						<button class="btn btn-default btn-sm noMargin form-control" onclick="removeTel(2);" type="button"><i class="fa fa-trash-o"></i> </button>
					</div>
				</div>
				<div id="tel3" class="form-group row hidden">
					<div class="col-sm-4">
						<?php 
						echo CHtml::activeDropDownList($modelContact, 'tel3_description',
	    					$ddlTel,array('class'=>'form-control'));
						?>
					</div>
					<div class="col-sm-6">
						<?php echo CHtml::activeTextField($modelContact, 'telephone_3', array('class'=>'form-control')); ?>					
					</div>
					<div id="btn-remove-tel-3" class="col-sm-2">
						<button class="btn btn-default btn-sm noMargin form-control" onclick="removeTel(3);" type="button"><i class="fa fa-trash-o"></i> </button>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12 align-right">
						<button type="button" onclick="addTelephone();" class="btn btn-default btn-sm"><i class="fa fa-plus"></i> </button>
					</div>
				</div>
				<div class="form-group row">
					<div class="col-sm-4">
						<?php echo CHtml::activeLabel($modelContact, 'email'); ?>
						<?php 
						$ddlEmail = array('Casa'=>'Casa',
											'Trabajo'=>'Trabajo',);
						echo CHtml::activeDropDownList($modelContact, 'email_description',
	    					$ddlEmail,array('class'=>'form-control'));
						?>
					</div>
				<div class="col-sm-6">
						<label for="campoTelefono">&nbsp;</label>				
						<?php echo CHtml::activeTextField($modelContact, 'email', array('class'=>'form-control')); ?>
					</div>
				</div>
				
				<div id="mail2" class="form-group row hidden">
					<div class="col-sm-4">
						<?php 
							echo CHtml::activeDropDownList($modelContact, 'email_2_description',
	    						$ddlEmail,array('class'=>'form-control'));
						?>
					</div>
				<div class="col-sm-6">
						<?php echo CHtml::activeTextField($modelContact, 'email_2', array('class'=>'form-control')); ?>
					</div>
					<div id="btn-remove-mail-2" class="col-sm-2">
						<button class="btn btn-default btn-sm noMargin form-control" onclick="removeMail(2);" type="button"><i class="fa fa-trash-o"></i> </button>
					</div>
				</div>
				
				<div id="mail3" class="form-group row hidden">
					<div class="col-sm-4">
						<?php 
							echo CHtml::activeDropDownList($modelContact, 'email_3_description',
	    						$ddlEmail,array('class'=>'form-control'));
						?>
					
					</div>
					<div class="col-sm-6">
						<?php echo CHtml::activeTextField($modelContact, 'email_3', array('class'=>'form-control')); ?>
					</div>
					<div id="btn-remove-mail-3" class="col-sm-2">
						<button class="btn btn-default btn-sm noMargin form-control" onclick="removeMail(3);" type="button"><i class="fa fa-trash-o"></i> </button>
					</div>
				</div>
				
				
				<div class="row">
					<div class="col-sm-12 align-right">
						<button type="button" onclick="addMail();" class="btn btn-default btn-sm"><i class="fa fa-plus"></i> </button>
					</div>
				</div>
				
				<div class="row">
			  		<?php echo $this->renderPartial('_formAddress',array('modelCustomer'=>$modelCustomer)); ?>
				</div>
				<div class="form-group">
					<?php echo CHtml::activeLabel($modelContact, 'refered'); ?>
					<?php echo CHtml::activeTextField($modelContact, 'refered', array('class'=>'form-control')); ?>
				</div>
				<div class="form-group">
  					<label for="campoTelefono">Notas</label>
    				<?php echo CHtml::activeTextArea($modelContact,'comment',array("class"=>"form-control","rows"=>'8')); ?>
  				</div>
			</form>			
 
 			<div id="summary-error">	 			
 			</div>
		</div>
		<div class="modal-footer">
			<button id="btn-cancel-new-customer" type="button" class="btn btn-default btn-lg" data-dismiss="modal">Cancelar</button>
			<button id="btn-save-new-customer" onclick="save();" type="button" class="btn btn-primary btn-lg"><i class="fa fa-save"></i> Guardar</button>
		</div>
	</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
<script type="text/javascript">
var mailIndex = 2;
<?php if(!empty($modelContact->email_2)):?>
addMail();
<?php endif;?>
<?php if(!empty($modelContact->email_3)):?>
addMail();
<?php endif;?>
function addMail()
{
	if(mailIndex <= 3)
	{
		var prevIndex = mailIndex - 1; 
		var mailId = 'mail'+mailIndex;
		$('#'+mailId).removeClass('hidden');
	
		var previousId = 'btn-remove-mail-' + prevIndex;
		$('#'+previousId).addClass('hidden');
	
		mailIndex++;
	}	
}
function removeMail(id)
{
	var mailId = 'mail'+id;
	$('#'+mailId).addClass('hidden');
	$('#Contact_email_'+id).val('');
	$('#Contact_email_'+id+'_description').val('');
	
	mailIndex--;

	var prev = id - 1;	
	var previousId = 'btn-remove-mail-' + prev;
	$('#'+previousId).removeClass('hidden');
}

var telIndex = 2;
<?php if(!empty($modelContact->telephone_2)):?>
addTelephone();
<?php endif;?>
<?php if(!empty($modelContact->telephone_3)):?>
addTelephone();
<?php endif;?>
function addTelephone()
{
	if(telIndex <= 3)
	{
		var prevIndex = telIndex - 1; 
		var telId = 'tel'+telIndex;
		$('#'+telId).removeClass('hidden');
	
		var previousId = 'btn-remove-tel-' + prevIndex;
		$('#'+previousId).addClass('hidden');
	
		telIndex++;
	}	
}
function removeTel(id)
{
	var telId = 'tel'+id;
	$('#'+telId).addClass('hidden');
	$('#Contact_telephone_'+id).val('');
	
	telIndex--;

	var prev = id - 1;	
	var previousId = 'btn-remove-tel-' + prev;
	$('#'+previousId).removeClass('hidden');
}

function save()
{				
	$('#form-new-customer').submit();
}

$("#form-new-customer").submit(function(e)
{

	$("#btn-save-new-customer").addClass("disabled");
	$("#btn-cancel-new-customer").addClass("disabled");

	<?php if($modelCustomer->isNewRecord):?>
    	var formURL = "<?php echo CustomerController::createUrl("AjaxSaveNewCustomer"); ?>";
    	var formData = new FormData(this);	
    <?php else:?>
		var formURL = "<?php echo BudgetController::createUrl("AjaxSaveUpdatedCustomer"); ?>";
    	var formData = new FormData(this);
	<?php endif;?>
	
    $.ajax({
        url: formURL,
    type: 'POST',
        data:  formData,
    mimeType:"multipart/form-data",
    contentType: false,
        cache: false,
        processData:false,
    success: function(data, textStatus, jqXHR)
    {		
	    var obj = jQuery.parseJSON(data);				
		if(obj != null)
		{
			if(obj.hasError == 0)
			{
				$.fn.yiiGridView.update("customer-grid");
		   		$('#myModalFormCustomer').trigger('click');
			}
			else
			{
				var errors = '';
				for(var k in obj.contactError) 
				{			
					errors += '<div class="estadoModal">'+
								'<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i>'+
									'<span> '+obj.contactError[k]+'</span>'+
								'</div>'+
							'</div>';
					
				}

				for(var k in obj.personError) 
				{			
					errors += '<div class="estadoModal">'+
								'<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i>'+
									'<span> '+obj.personError[k]+'</span>'+
								'</div>'+
							'</div>';
					
				}

				$("#summary-error").html(errors);
				
			}		
		}
		$("#btn-save-new-customer").removeClass("disabled");
		$("#btn-cancel-new-customer").removeClass("disabled");
    },
	error: function(jqXHR, textStatus, errorThrown)
	{
		$("#btn-save-new-customer").removeClass("disabled");
		$("#btn-cancel-new-customer").removeClass("disabled");
	}         
	});
	e.preventDefault(); //Prevent Default action.
});

</script>