<script>
$(document).ready (function (){
new nicEditor({buttonList : ['title','bold','italic','underline','strikeThrough','ol','ul','indent','outdent','h1']}).panelInstance('Clause_description');
});

function statusStartSaving()
{
	$("#statusSaved").hide();
	$("#statusSaving").fadeIn();				        	
}

function statusSaved()
{
	$("#statusSaving").fadeOut(function(){$("#statusSaved").fadeIn();});							
}

function statusSavedError()
{
	$("#statusSaving").fadeOut();				
}

function save()
{	
	statusStartSaving();
	var nicE = new nicEditors.findEditor('Clause_description');
	description = nicE.getContent();
	
	$.post("<?php echo ClauseController::createUrl('AjaxSave'); ?>",
			{
				description:description
			}
		).success(
			function(data){
				statusSaved();
			}).error(function(){statusSavedError();});
		return false;
}

function reset()
{	
	var descriptionBkp = $("#descriptionBkp").val();
	nicEditors.findEditor( "Clause_description" ).setContent( descriptionBkp );	
}

</script>

<div class="container" id="screenClausulas">
  <div class="row">
    <div class="col-sm-12">
  <h1 class="pageTitle">Condiciones de contrataci&oacute;n</h1>
  </div>
  </div>
  <div class="row">
    <div class="col-sm-12">
    <?php echo CHtml::hiddenField('descriptionBkp',$model->description,array('id'=>'descriptionBkp')); ?>
    <?php echo CHtml::activeTextArea($model, 'description',array("class"=>"form-control",'maxlength' => 2000, 'rows' => 20)); ?>
    
  
 <div class="buttonGroup">
        <button type="button" class="btn btn-default" onClick="reset();"><i class="fa fa-reply"></i> Reset</button>
        <button type="submit" class="btn btn-primary" onClick="save();"><i class="fa fa-save"></i> Guardar</button>
 </div>
   </div>    
    <!-- /.col-sm-12 --> 
  </div>
  <!-- /.row --> 
  <div class="row navbar-fixed-bottom">
    <div class="col-sm-12">
      <div id="statusSaving" class="statusFloatSaving" style="display:none">
        <i class="fa fa-spinner fa-spin fa-fw"></i> Guardando
      </div>
      <div id="statusSaved" class="statusFloatSaved" style="display:none">
        <i class="fa fa-check fa-fw"></i> Guardado
        </div>
    </div>
    <!-- /.col-sm-12 --> 
  </div>
  <!-- /.row -->
  </div>
  <!-- /.container --> 
  