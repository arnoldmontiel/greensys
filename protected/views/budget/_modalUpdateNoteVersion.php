  <script>
$(document).ready (function (){
//$('textarea.form-control').height('350px');
new nicEditor({buttonList : ['title','bold','italic','underline','strikeThrough','ol','ul','indent','outdent']}).panelInstance('Budget_note_version');
$('.nicEdit-panelContain').parent().width('100%');
$('.nicEdit-main').parent().width('98%');
$('.nicEdit-main').width('98%');
$('.nicEdit-main').height('70%')
$('.nicEdit-main').parent().height('70%')
$('.nicEdit-main').parent().addClass('nicEdit-scroll');
});

function saveNoteVersion(id, version)
{	
	var nicE = new nicEditors.findEditor('Budget_note_version');
	description = nicE.getContent();
	
	$.post("<?php echo BudgetController::createUrl('AjaxUpdateNoteVersion'); ?>",
			{
				id:id,
				version:version,
				description:description
			}
		).success(
			function(data){
				$("#budget-note-version").html(description);
				$('#myModalChangeNoteVersion').trigger('click');
			}).error();
		return false;
}

</script>
<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
			<h4 class="modal-title">Editar Nota de versi&oacute;n</h4>
		</div>
		<div class="modal-body">
			<?php echo CHtml::activeTextArea($model, 'note_version',array("class"=>"form-control", 'rows' => "5")); ?>
		</div>
		<div class="modal-footer">
        	<button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Cancelar</button>
        	<button onclick="saveNoteVersion(<?php echo $model->Id;?>, <?php echo $model->version_number;?>);" type="button" class="btn btn-primary btn-lg"><i class="fa fa-save"></i> Guardar</button>
		</div>
	</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->