  <script>
$(document).ready (function (){
new nicEditor({buttonList : ['title','bold','italic','underline','strikeThrough','ol','ul','indent','outdent','h1']}).panelInstance('Budget_clause_description');
$('.nicEdit-panelContain').parent().width('100%');
$('.nicEdit-main').parent().width('98%');
$('.nicEdit-main').width('98%');

});

function saveClause(id, version)
{	
	var nicE = new nicEditors.findEditor('Budget_clause_description');
	description = nicE.getContent();
	
	$.post("<?php echo BudgetController::createUrl('AjaxUpdateClause'); ?>",
			{
				id:id,
				version:version,
				description:description
			}
		).success(
			function(data){
				$("#budget-clause-description").html(description);
				$('#myModalChangeClause').trigger('click');
			}).error();
		return false;
}

</script>
<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
			<h4 class="modal-title">Editar Condiciones</h4>
		</div>
		<div class="modal-body">
			<?php echo CHtml::activeTextArea($model, 'clause_description',array("class"=>"form-control", 'rows' => 15)); ?>
		</div>
		<div class="modal-footer">
			<button  type="button" class="btn btn-primary btn-lg pull-left"><i class="fa fa-reply"></i> Actualizar</button>
        	<button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Cancelar</button>
        	<button onclick="saveClause(<?php echo $model->Id;?>, <?php echo $model->version_number;?>);" type="button" class="btn btn-primary btn-lg"><i class="fa fa-save"></i> Guardar</button>
		</div>
	</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->