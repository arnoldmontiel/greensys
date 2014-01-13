  <div class="row panelPresu">
    <div class="col-sm-12">
    
          <h2><?php echo  $model->project->customer->contact->description?> - <?php echo  $model->project->description?><a class="superEdit" onclick="openUpdateBudget(<?php echo $model->Id . ', '.$model->version_number;?>);" data-toggle="modal" data-target="#myModalEditarPresupuesto"><i class="fa fa-pencil"></i></a></h2>
<div class="dropdown">
        <a class="versionDrop dropdown-toggle" data-toggle="dropdown" href="#" id="header-budget-version-number">Versi&oacute;n <?php echo $model->version_number?> (abierta) <i class="fa fa-caret-down fa-fw"></i></a>

  <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Versi&oacute;n 1</a></li>
        <li role="presentation" class="divider"></li>
    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Versi&oacute;n 2</a></li>
        <li role="presentation" class="divider"></li>
    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Versi&oacute;n 3</a></li>
  </ul>
</div>

        
<div class="row">
                
    <div class="col-sm-8">
        <table class="table" width="50%">
        <tbody>
            <tr>
                <td width="30%" class="bold">Descripci&oacute;n</td>
                <td><span id="header-budget-state"><?php echo $model->description;?></span></td>
            </tr>
            <tr>
                <td width="30%" class="bold">Estado</td>
                <td><span id="header-budget-state"><?php echo $model->budgetState->description?></span></td>
            </tr>
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
    <div class="col-sm-4">
    <form role="form">
  <div class="form-group">
    <label for="exampleInputEmail1">Moneda para descarga</label>
    <?php 
    	echo CHtml::activeDropDownList($model, 'Id_currency_view',
    		CHtml::listData(Currency::model()->findAll(), 'Id', 'description'),array('class'=>'form-control', 'onchange'=>'changeCurrencyView(this,'.$model->Id.', '.$model->version_number.')'));
    ?>
</div></form>
    </div>
               </div>
                <button onclick="closeVersion(<?php echo $model->Id . ', '.$model->version_number;?>);" type="button" class="btn btn-primary marginLeft pull-right"><i class="fa fa-archive fa-fw"></i> Cerrar Versi&oacute;n</button>
                <button onclick="exportBudget(<?php echo $model->Id . ', '.$model->version_number;?>);" type="button" class="btn btn-primary marginLeft pull-right"><i class="fa fa-download fa-fw"></i> Descargar</button>
        
    </div>
  </div>
