<?php 
$settings = new Settings();
?>
<div class="row contenedorPresu noBorder">
    <div class="col-sm-12">
      <div class="tituloFinalPresu">Configurar Textos</div>
      <ul class="nav nav-tabs">
        <li class="active"><a id="tabServices" href="#tabDescripciones" data-toggle="tab">Descripciones Servicios</a></li>
        <li><a id="tabServicesNote" href="#tabNotas" data-toggle="tab">Notas Servicios</a></li>
        <li><a id="tabServicesCondiciones" href="#tabCondiciones" data-toggle="tab">Condiciones de Contrataci&oacute;n</a></li>
        </ul>
        <div class="tab-content">
<div class="tab-pane active" id="tabDescripciones">

  <?php 
$projectService = new ProjectService();
$projectService->Id_project = $model->Id_project;
	$this->widget('zii.widgets.grid.CGridView', array(
					'id'=>'project-service-grid',
					'dataProvider'=>$projectService->search(),
					'summaryText'=>'',
					'selectableRows' => 0,
					'itemsCssClass' => 'table table-striped table-bordered tablaIndividual',
					'ajaxUrl'=>BudgetController::createUrl('AjaxUpdateProjectServiceGrid',array("Id"=>$model->Id,"version_number"=>$model->version_number)),
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
									'value'=>function($data){
											return '<button type="button" class="btn btn-default btn-sm" onclick="editProjectService('.$data->Id_project.','.$data->Id_service.');" ><i class="fa fa-pencil"></i> Editar</button>';
									},
									'type'=>'raw',
									'htmlOptions'=>array("style"=>"text-align:right;"),
									'headerHtmlOptions'=>array("style"=>"text-align:right;"),
							),
							),
					));
        ?>
</div> 
    <!-- /.tab1 -->
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
					'ajaxUrl'=>BudgetController::createUrl('AjaxUpdateProjectServiceGrid',array("Id"=>$model->Id,"version_number"=>$model->version_number)),
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
									'value'=>function($data){
										return '<button type="button" class="btn btn-default btn-sm" onclick="editProjectServiceNote('.$data->Id_project.','.$data->Id_service.');" ><i class="fa fa-pencil"></i> Editar</button>';
									},
									'type'=>'raw',
									'htmlOptions'=>array("style"=>"text-align:right;"),
									'headerHtmlOptions'=>array("style"=>"text-align:right;"),
							),
							),
					));
        ?>
</div> 
    <!-- /.tab2 -->
    
<div class="tab-pane" id="tabCondiciones">
<table class="table table-bordered tablaIndividual">

<tbody>
<tr>
<td><input checked="checked" type="checkbox" value="1"> Imprimir en Presupuesto</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>
<div class="clauseScroll">
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vestibulum eleifend mauris, non vehicula leo sagittis eget. Etiam sit amet viverra lectus, a posuere massa. In nec dignissim nisi. In commodo felis vitae purus auctor eleifend. Integer non adipiscing orci. Fusce nunc felis, adipiscing quis nibh a, feugiat adipiscing massa. Duis metus nibh, dignissim ac mollis eleifend, suscipit vel justo. Praesent fermentum vel felis molestie adipiscing. Pellentesque commodo, urna sed eleifend cursus, ipsum eros fermentum mi, eu imperdiet dolor lacus vel mauris. Proin vel neque eget magna fringilla cursus.

Etiam vel leo nunc. Etiam eget suscipit dolor. Mauris eu varius nunc, quis varius orci. Praesent mauris massa, egestas fringilla mauris eu, consectetur convallis purus. Morbi vehicula augue in sagittis imperdiet. Ut aliquet bibendum laoreet. Proin at felis id mauris dapibus mattis eu at arcu. Donec viverra lacus metus, eu volutpat augue vulputate pharetra. Quisque tincidunt nulla tellus, pharetra laoreet nibh lacinia vitae.

Fusce faucibus sem sem, pulvinar scelerisque turpis dictum sit amet. Pellentesque suscipit euismod ligula sed vehicula. Duis in adipiscing leo. Morbi fringilla vulputate risus eget placerat. Nullam vehicula vel nisi vitae semper. Praesent ac ultricies nulla. Fusce tempus aliquet nisl, eget convallis nisi volutpat a. Ut nisi nunc, molestie in magna nec, semper condimentum eros. Etiam fringilla sed massa et pulvinar. Duis quis scelerisque diam. Maecenas malesuada aliquet odio non mollis.

Cras laoreet tincidunt mauris, vitae vestibulum massa. Ut placerat a nulla eget tempor. Pellentesque eu tristique lectus, nec tempor turpis. Cras volutpat molestie tristique. Donec et porttitor orci, quis auctor diam. Aenean vitae quam nibh. Nam nec facilisis nunc, quis tincidunt justo. Donec vel varius mi, vel vestibulum augue. Nunc dignissim dictum diam et rutrum. Duis pharetra fringilla bibendum. Phasellus tempor diam justo, et tincidunt mi aliquam sit amet. Aliquam turpis magna, dictum quis laoreet vel, viverra vitae nisl. Nunc scelerisque neque eget leo consectetur, sit amet mattis nisl posuere. Maecenas sollicitudin, arcu non auctor sodales, quam tortor rutrum nulla, in lacinia massa neque hendrerit lectus. Proin facilisis hendrerit tempus. Suspendisse eu odio neque.

Sed porttitor feugiat dictum. Nullam nec bibendum nunc, ac elementum tortor. Ut quis orci venenatis, volutpat sem vel, ornare nisl. Suspendisse cursus nulla ut quam euismod mollis. Aenean ultricies nec augue vel sollicitudin. Quisque ultricies at dui nec consequat. Phasellus rhoncus fringilla vehicula. Mauris eleifend faucibus lacus eu convallis. Aliquam volutpat hendrerit pretium. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nullam eu convallis tellus.
</div></td>
<td valign="top">
<div class="buttonsPresuClause">
<button class="btn btn-default btn-sm" data-toggle="modal" data-target="#myModalChangeClause"><i class="fa fa-pencil"></i> Editar</button>
<button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i> Actualizar</button></div>
</td>
</tr>
</tbody>
</table>

</div> 
    <!-- /.tab3 -->
</div>
    <!-- /.tab-content -->
      </div>
    <!-- /.col-sm-12 -->
  </div>
  
  
  <script>
$(document).ready (function (){
new nicEditor({buttonList : ['title','bold','italic','underline','strikeThrough','ol','ul','indent','outdent','h1']}).panelInstance('clause_new_description');
$('.nicEdit-panelContain').parent().width('100%');
$('.nicEdit-main').parent().width('98%');
$('.nicEdit-main').width('98%');

});
</script>

  <div id="myModalChangeClause" class="modal fade in" aria-hidden="false"><form id="brand-form" action="/GreenCliente/index.php?r=brand/ajaxCreate" method="post">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h4 class="modal-title">Editar Condiciones</h4>
      </div>
      <div class="modal-body">
      <textarea class="form-control" rows="15" id="clause_new_description">
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc et purus quis neque rhoncus consequat. Nunc tempus tempor mi sit amet elementum. Fusce tristique hendrerit faucibus. Proin ut lorem pellentesque, aliquam risus a, elementum arcu. Nullam in dolor nec leo sagittis vestibulum nec a enim. Nulla interdum libero ut justo varius posuere. Nunc eu magna nibh.

Morbi eget ante est. Proin aliquet viverra metus quis iaculis. Donec in odio eget nunc pretium hendrerit. Donec facilisis odio id dolor porttitor pellentesque. In congue felis vitae dapibus volutpat. Etiam consectetur odio ornare, fringilla felis quis, consectetur metus. In quis purus eros. Proin tincidunt auctor nisl eu sodales. Ut aliquam urna congue tincidunt tincidunt. Nam vel risus enim. Integer varius ante nec turpis fermentum, id fringilla nibh pellentesque. Etiam lorem libero, mattis ac est non, ultricies vestibulum enim. Mauris sit amet elit a dui volutpat ultrices ac ut arcu.

Praesent auctor consectetur metus eu suscipit. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec vel elit cursus, aliquet est iaculis, consectetur lacus. <br/><br/>Vivamus vitae nibh adipiscing, fermentum lectus nec, pulvinar mi. Cras vestibulum egestas velit, ac tincidunt ante hendrerit vel. Integer dictum condimentum lorem. Nulla mi enim, condimentum ac dignissim a, vehicula vel lacus. Praesent id sodales massa, et ultricies dui. Sed ac ornare dolor, eget tempor risus. Fusce dignissim enim a venenatis tristique.

Nullam eu nisl dignissim ipsum egestas facilisis. Donec pharetra, dui non rhoncus gravida, velit est ullamcorper lacus, ac adipiscing elit mauris ac nisi. Nam at consequat elit. Donec hendrerit nec arcu ac ultrices. Praesent pretium orci in justo tincidunt interdum. In et dolor id neque elementum porta. Aenean sit amet ultrices mi, vel pharetra metus. Nunc fermentum aliquam lectus sed pulvinar. Curabitur neque nisi, interdum ac fermentum eu, sagittis vitae turpis. Proin vulputate dapibus augue, ut tempor metus ornare in. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Maecenas bibendum facilisis lorem, posuere viverra metus mattis et. Suspendisse eget magna in nulla volutpat placerat. Praesent dignissim hendrerit orci, eu scelerisque neque elementum at.

</textarea> 
  
          </div>
      <div class="modal-footer">
        <button  type="button" class="btn btn-primary btn-lg pull-left"><i class="fa fa-reply"></i> Actualizar</button>
        <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary btn-lg"><i class="fa fa-save"></i> Guardar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</form>

</div>
  