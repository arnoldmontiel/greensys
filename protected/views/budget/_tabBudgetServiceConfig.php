<?php 
$settings = new Settings();
?>
<div class="row contenedorPresu noBorder">
    <div class="col-sm-12">
      <div class="tituloFinalPresu">Configurar Servicios</div>
      <ul class="nav nav-tabs">
        <li class="active"><a id="tabServices" href="#tabDescripciones" data-toggle="tab">Descripciones</a></li>
        <li><a id="tabServicesNote" href="#tabNotas" data-toggle="tab">Notas</a></li>
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
									'value'=>'"<button type=\"button\" class=\"btn btn-default btn-sm\" onclick=\"editProjectServiceNote(".$data->Id_project.",".$data->Id_service.");\" ><i class=\"fa fa-pencil\"></i> Editar</button>"',
									'type'=>'raw',
									'htmlOptions'=>array("style"=>"text-align:right;"),
									'headerHtmlOptions'=>array("style"=>"text-align:right;"),
							),
							),
					));
        ?>
</div> 
    <!-- /.tab3 -->
</div>
    <!-- /.tab-content -->
      </div>
    <!-- /.col-sm-12 -->
  </div>
  
 <script type="text/javascript">
 
 </script> 