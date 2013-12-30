  <div class="row">
    <div class="col-sm-12">
    
    <div class="panel panel-success panelPresu">
        <div class="panel-body">
          <h2><?php echo  $model->project->customer->contact->description?> - <?php echo  $model->project->description?><a class="superEdit" data-toggle="modal" data-target="#myModalEditarPresupuesto"><i class="fa fa-pencil"></i></a></h2>

        <?php echo $model->description;?>
<div class="row">
                
    <div class="col-sm-6">
        <table class="table table-striped table-bordered tablaIndividual tablaDatosPanel" width="50%">
        <tbody>
            <tr>
                <td width="30%" class="bold">Estado</td>
                <td><?php echo $model->budgetState->description?></td>
            </tr>
            <tr>
                <td class="bold">Versi&oacute;n</td>
                <td><?php echo $model->version_number?></td>
            </tr>
        </tbody>
      </table>
      </div>
    <div class="col-sm-6">
        <table class="table table-striped table-bordered tablaIndividual tablaDatosPanel" width="50%">
        <tbody>
            <tr>
                <td width="40%" class="bold">Fecha Estimada Inicio</td>
                <td><?php echo  $model->date_estimated_inicialization;?></td>
            </tr>
            <tr>
                <td class="bold">Fecha Estimada Finalizaci&oacute;n</td>
                <td><?php echo  $model->date_estimated_finalization;?></td>
            </tr>
        </tbody>
      </table>
                </div>
               </div>
                <button type="button" class="btn btn-primary marginLeft pull-right"><i class="fa fa-archive fa-fw"></i> Cerrar Versi&oacute;n</button>
                <button type="button" class="btn btn-primary marginLeft pull-right"><i class="fa fa-download fa-fw"></i> Descargar</button>
        </div>
        </div>
    </div>
  </div>
