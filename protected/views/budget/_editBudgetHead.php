  <div class="row">
    <div class="col-sm-12">
    
    <div class="panel panel-success panelPresu">
        <div class="panel-body">
          <h2><?php echo  $model->project->customer->contact->description?> - <?php echo  $model->project->description?><a class="superEdit" onclick="openUpdateBudget(<?php echo $model->Id . ', '.$model->version_number;?>);" data-toggle="modal" data-target="#myModalEditarPresupuesto"><i class="fa fa-pencil"></i></a></h2>

        <span id="header-budget-description"><?php echo $model->description;?></span>
<div class="row">
                
    <div class="col-sm-6">
        <table class="table table-striped table-bordered tablaIndividual tablaDatosPanel" width="50%">
        <tbody>
            <tr>
                <td width="30%" class="bold">Estado</td>
                <td><span id="header-budget-state"><?php echo $model->budgetState->description?></span></td>
            </tr>
            <tr>
                <td class="bold">Versi&oacute;n</td>
                <td><span id="header-budget-version-number"><?php echo $model->version_number?></span></td>
            </tr>
        </tbody>
      </table>
      </div>
    <div class="col-sm-6">
        <table class="table table-striped table-bordered tablaIndividual tablaDatosPanel" width="50%">
        <tbody>
            <tr>
                <td width="40%" class="bold">Fecha Estimada Inicio</td>
                <td><span id="header-budget-date-est-init"><?php echo  $model->date_estimated_inicialization;?></span></td>
            </tr>
            <tr>
                <td class="bold">Fecha Estimada Finalizaci&oacute;n</td>
                <td><span id="header-budget-date-est-fin"><?php echo  $model->date_estimated_finalization;?></span></td>
            </tr>
        </tbody>
      </table>
                </div>
               </div>
                <button onclick="closeVersion(<?php echo $model->Id . ', '.$model->version_number;?>);" type="button" class="btn btn-primary marginLeft pull-right"><i class="fa fa-archive fa-fw"></i> Cerrar Versi&oacute;n</button>
                <button onclick="exportBudget(<?php echo $model->Id . ', '.$model->version_number;?>);" type="button" class="btn btn-primary marginLeft pull-right"><i class="fa fa-download fa-fw"></i> Descargar</button>
        </div>
        </div>
    </div>
  </div>
