<div class="container" id="screenPresupuestos">
  <h1 class="pageTitle">Presupuestos</h1>
  <div class="row">
    <div class="col-sm-12">
      <ul class="nav nav-tabs">
        <li class="active"><a href="#tabAbiertos" data-toggle="tab">Abiertos <span class="badge">10</span></a></li>
        <li><a href="#tabEsperando" data-toggle="tab">Esperando Respuesta <span class="badge">4</span></a></li>
        <li><a href="#tabAprobados" data-toggle="tab">Aprobados  <span class="badge">200</span></a></li>
        <li><a href="#tabCancelados" data-toggle="tab">Cancelados  <span class="badge">3</span></a></li>
      </ul>
      <div class="tab-content">
  <div class="tab-pane active" id="tabAbiertos">
  <a class="btn btn-primary superBoton" data-toggle="modal" data-target="#myModalCrearPresupuesto"><i class="fa fa-plus"></i> Crear Presupuesto</a>
      <table class="table table-striped table-bordered tablaIndividual" width="100%">
        <thead>
          <tr>
            <th style="text-align:left;">Proyecto</th>
            <th style="text-align:left;">N� Versi&oacute;n</th>
            <th style="text-align:left;">Descripci&oacute;n</th>
            <th style="text-align:left;">Descuento</th>
            <th style="text-align:left;">Fecha Creaci&oacute;n</th>
            <th style="text-align:left;">Fecha Inicio</th>
            <th style="text-align:right;">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Casa Nordelta</td>
            <td>1.0</td>
            <td>Actualizaci&oacute;n de Cine y nuevas persianas.</td>
            <td>0</td>
            <td>2013-08-28 12:20:12</td>
            <td>--</td>
            <td style="text-align:right;">
            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar</button>
            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button>
            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-archive"></i> Cerrar</button>
            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-download"></i> Descargar</button></td>
          </tr>
          <tr>
            <td>Punta del Este Shopping</td>
            <td>1.0</td>
            <td>Automatizaci&oacute;n del hogar.</td>
            <td>0</td>
            <td>2013-08-28 12:20:12</td>
            <td>--</td>
            <td style="text-align:right;">
            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar</button>
            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button>
            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-archive"></i> Cerrar</button>
            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-download"></i> Descargar</button></td>
          </tr>
          <tr>
            <td>Contaco Inicial</td>
            <td>1.0</td>
            <td>Ambientaci&oacute;n de luces.</td>
            <td>0</td>
            <td>2013-08-28 12:20:12</td>
            <td>--</td>
            <td style="text-align:right;">
            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar</button>
            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button>
            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-archive"></i> Cerrar</button>
            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-download"></i> Descargar</button></td>
          </tr>
          <tr>
            <td>Casa Lopez</td>
            <td>1.0</td>
            <td>Actualizaci&oacute;n de Cine y nuevas persianas.</td>
            <td>0</td>
            <td>2013-08-28 12:20:12</td>
            <td>--</td>
            <td style="text-align:right;">
            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar</button>
            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button>
            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-archive"></i> Cerrar</button>
            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-download"></i> Descargar</button>
            </td>
          </tr>
        </tbody>
      </table>
      </div><!-- /.tab1 --> 
     <div class="tab-pane" id="tabEsperando">
      <table class="table table-striped table-bordered tablaIndividual" width="100%">
        <thead>
          <tr>
            <th style="text-align:left;">Proyecto</th>
            <th style="text-align:left;">Cerrado</th>
            <th style="text-align:left;">N� Versi&oacute;n</th>
            <th style="text-align:left;">Descripci&oacute;n</th>
            <th style="text-align:left;">Descuento</th>
            <th style="text-align:left;">Fecha Creaci&oacute;n</th>
            <th style="text-align:left;">Fecha Inicio</th>
            <th style="text-align:right;">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Casa Nordelta</td>
            <td>20 Dic 2013 12:20:12</td>
            <td>1.0</td>
            <td>Actualizaci&oacute;n de Cine y nuevas persianas.</td>
            <td>0</td>
            <td>2013-08-28 12:20:12</td>
            <td>--</td>
            <td style="text-align:right;">
            <div class="btn-group">
    <button data-toggle="dropdown" class="btn btn-default btn-sm dropdown-toggle">Estado <i class="fa fa-caret-down"></i></button>
    <ul class="dropdown-menu">
        <li><a href="#"><i class="fa fa-refresh"></i> Re-Abrir</a></li>
        <li><a href="#"><i class="fa fa-check"></i> Aprobado</a></li>
        <li><a href="#"><i class="fa fa-times-circle"></i> Cancelado</button></a></li>
    </ul></div>
           <button type="button" class="btn btn-default btn-sm"><i class="fa fa-download"></i> Descargar</button> 
          <!-- <button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i> Re-Abrir</button> 
           <button type="button" class="btn btn-default btn-sm"><i class="fa fa-check"></i> Aprobado</button> 
           <button type="button" class="btn btn-default btn-sm"><i class="fa fa-times-circle"></i> Cancelado</button>-->
           </td>
          </tr>
          <tr>
            <td>Punta del Este Shopping</td>
            <td>20 Dic 2013 12:20:12</td>
            <td>1.0</td>
            <td>Automatizaci&oacute;n del hogar.</td>
            <td>0</td>
            <td>2013-08-28 12:20:12</td>
            <td>--</td>
            <td style="text-align:right;">
            <div class="btn-group">
    <button data-toggle="dropdown" class="btn btn-default btn-sm dropdown-toggle">Estado <i class="fa fa-caret-down"></i></button>
    <ul class="dropdown-menu">
        <li><a href="#"><i class="fa fa-refresh"></i> Re-Abrir</a></li>
        <li><a href="#"><i class="fa fa-check"></i> Aprobado</a></li>
        <li><a href="#"><i class="fa fa-times-circle"></i> Cancelado</button></a></li>
    </ul></div>
           <button type="button" class="btn btn-default btn-sm"><i class="fa fa-download"></i> Descargar</button> </td>
          </tr>
          <tr>
            <td>Contaco Inicial</td>
            <td>20 Dic 2013 12:20:12</td>
            <td>1.0</td>
            <td>Ambientaci&oacute;n de luces.</td>
            <td>0</td>
            <td>2013-08-28 12:20:12</td>
            <td>--</td>
            <td style="text-align:right;">
            <div class="btn-group">
    <button data-toggle="dropdown" class="btn btn-default btn-sm dropdown-toggle">Estado <i class="fa fa-caret-down"></i></button>
    <ul class="dropdown-menu">
        <li><a href="#"><i class="fa fa-refresh"></i> Re-Abrir</a></li>
        <li><a href="#"><i class="fa fa-check"></i> Aprobado</a></li>
        <li><a href="#"><i class="fa fa-times-circle"></i> Cancelado</button></a></li>
    </ul></div>
           <button type="button" class="btn btn-default btn-sm"><i class="fa fa-download"></i> Descargar</button> </td>
          </tr>
          <tr>
            <td>Casa Lopez</td>
            <td>20 Dic 2013 12:20:12</td>
            <td>1.0</td>
            <td>Actualizaci&oacute;n de Cine y nuevas persianas.</td>
            <td>0</td>
            <td>2013-08-28 12:20:12</td>
            <td>--</td>
            <td style="text-align:right;">
            <div class="btn-group">
    <button data-toggle="dropdown" class="btn btn-default btn-sm dropdown-toggle">Estado <i class="fa fa-caret-down"></i></button>
    <ul class="dropdown-menu">
        <li><a href="#"><i class="fa fa-refresh"></i> Re-Abrir</a></li>
        <li><a href="#"><i class="fa fa-check"></i> Aprobado</a></li>
        <li><a href="#"><i class="fa fa-times-circle"></i> Cancelado</button></a></li>
    </ul></div>
           <button type="button" class="btn btn-default btn-sm"><i class="fa fa-download"></i> Descargar</button> </td>
          </tr>
        </tbody>
      </table>
      </div><!-- /.tab2 --> 
     <div class="tab-pane" id="tabAprobados">
      <table class="table table-striped table-bordered tablaIndividual" width="100%">
        <thead>
          <tr>
            <th style="text-align:left;">Proyecto</th>
            <th style="text-align:left;">Aprobado</th>
            <th style="text-align:left;">N� Versi&oacute;n</th>
            <th style="text-align:left;">Descripci&oacute;n</th>
            <th style="text-align:left;">Descuento</th>
            <th style="text-align:left;">Fecha Creaci&oacute;n</th>
            <th style="text-align:left;">Fecha Inicio</th>
            <th style="text-align:right;">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Casa Nordelta</td>
            <td>20 Dic 2013 12:20:12</td>
            <td>1.0</td>
            <td>Actualizaci&oacute;n de Cine y nuevas persianas.</td>
            <td>0</td>
            <td>2013-08-28 12:20:12</td>
            <td>--</td>
            <td style="text-align:right;">
           <button type="button" class="btn btn-default btn-sm"><i class="fa fa-download"></i> Descargar</button> 
           </td>
          </tr>
          <tr>
            <td>Punta del Este Shopping</td>
            <td>20 Dic 2013 12:20:12</td>
            <td>1.0</td>
            <td>Automatizaci&oacute;n del hogar.</td>
            <td>0</td>
            <td>2013-08-28 12:20:12</td>
            <td>--</td>
            <td style="text-align:right;">
           <button type="button" class="btn btn-default btn-sm"><i class="fa fa-download"></i> Descargar</button> </td>
          </tr>
          <tr>
            <td>Contaco Inicial</td>
            <td>20 Dic 2013 12:20:12</td>
            <td>1.0</td>
            <td>Ambientaci&oacute;n de luces.</td>
            <td>0</td>
            <td>2013-08-28 12:20:12</td>
            <td>--</td>
            <td style="text-align:right;">
           <button type="button" class="btn btn-default btn-sm"><i class="fa fa-download"></i> Descargar</button> </td>
          </tr>
          <tr>
            <td>Casa Lopez</td>
            <td>20 Dic 2013 12:20:12</td>
            <td>1.0</td>
            <td>Actualizaci&oacute;n de Cine y nuevas persianas.</td>
            <td>0</td>
            <td>2013-08-28 12:20:12</td>
            <td>--</td>
            <td style="text-align:right;">
           <button type="button" class="btn btn-default btn-sm"><i class="fa fa-download"></i> Descargar</button> </td>
          </tr>
        </tbody>
      </table>
      </div><!-- /.tab3 --> 
     <div class="tab-pane" id="tabCancelados">
      <table class="table table-striped table-bordered tablaIndividual" width="100%">
        <thead>
          <tr>
            <th style="text-align:left;">Proyecto</th>
            <th style="text-align:left;">Cancelado</th>
            <th style="text-align:left;">N� Versi&oacute;n</th>
            <th style="text-align:left;">Descripci&oacute;n</th>
            <th style="text-align:left;">Raz&oacute;n</th>
            <th style="text-align:right;">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Casa Nordelta</td>
            <td>20 Dic 2013 12:20:12</td>
            <td>4.0</td>
            <td>Actualizaci&oacute;n de Cine y nuevas persianas.</td>
            <td><span class="label label-info">El cliente contrato a otra empresa.</span></td>
            <td style="text-align:right;">
    <button class="btn btn-default btn-sm"><i class="fa fa-refresh"></i> Re-Abrir</button>
    <button class="btn btn-default btn-sm"><i class="fa fa-download"></i> Descargar</button>
           </td>
          </tr>
          <tr>
            <td>Punta del Este Shopping</td>
            <td>20 Dic 2013 12:20:12</td>
            <td>1.0</td>
            <td>Automatizaci&oacute;n del hogar.</td>
            <td><span class="label label-info">No teniamos disponible los equipos.</span></td>
            <td style="text-align:right;">
    <button class="btn btn-default btn-sm"><i class="fa fa-refresh"></i> Re-Abrir</button>
    <button class="btn btn-default btn-sm"><i class="fa fa-download"></i> Descargar</button>
           </td>
          </tr>
          <tr>
            <td>Contaco Inicial</td>
            <td>20 Dic 2013 12:20:12</td>
            <td>1.0</td>
            <td>Ambientaci&oacute;n de luces.</td>
            <td><span class="label label-info">Desacuerdos por precio.</span></td>
            <td style="text-align:right;">
    <button class="btn btn-default btn-sm"><i class="fa fa-refresh"></i> Re-Abrir</button>
    <button class="btn btn-default btn-sm"><i class="fa fa-download"></i> Descargar</button>
           </td>
          </tr>
        </tbody>
      </table>
      </div><!-- /.tab4 --> 
      </div><!-- /.tab-content -->
    </div>
    <!-- /.col-sm-12 --> 
  </div>
  <!-- /.row --> 
</div>
<!-- /container --> 
