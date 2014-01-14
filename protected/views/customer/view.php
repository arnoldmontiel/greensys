<div class="container" id="screenMarcas">
  <div class="row">
    <div class="col-sm-6">
  <h1 class="pageTitle">Clientes</h1>
  </div>
    <div class="col-sm-6 align-right">
  <a id="createBrand" class="btn btn-primary superBoton" data-toggle="modal" data-target="#myModalNewClient"><i class="fa fa-plus"></i> Agregar Cliente</a>
  </div>
  </div>
  <div class="row">
    <div class="col-sm-12">

<div id="brand-grid" class="grid-view">
<div class="summary"></div>
<table class="table table-striped table-bordered tablaIndividual">
<thead>
<tr>
<th>Foto</th>
<th>Nombre</th>
<th>Tel&eacute;fonos</th>
<th>E-mail</th>
<th>Direcci&oacute;n</th>
<th class="align-right">Acciones</th>
</tr>
</thead>
<tbody>
<tr>
<td width="70"><img src="images/contactImage.jpg" width="70" height="70"></td>
<td>Delfina Rossi</td>
<td>&bull; Principal: 1559924683
<br/>&bull; Movil: 1559924686
</td>
<td>delfirossi@gmail.com</td>
<td>Olaya 1787 2B</td>
<td style="text-align:right;">
<button type="button" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Editar</button>
<button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button>
</td>
</tr>
</tbody>
</table>
</div>    </div>
    <!-- /.col-sm-12 --> 
  </div>
  <!-- /.row --> 
</div>





<div id="myModalNewClient" class="modal fade in" style="display: none;" aria-hidden="false"><form id="brand-form" action="/GreenCliente/index.php?r=brand/ajaxCreate" method="post">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h4 class="modal-title">Agregar Cliente</h4>
      </div>
      <div class="modal-body">
  <div class="form-group">
  <label for="campoNombre">Nombre</label>
  <input class="form-control" name="campoNombre" type="text" >
  </div>
  <div class="form-group">
  <label for="campoNombre">Foto</label>
  <input type="file" id="exampleInputFile">
  </div>
  <div class="form-group row">
  <div class="col-sm-6"><label for="campoTipoTelefono">Tel&eacute;fono</label>
  <select class="form-control">
            <option value="">M&oacute;vil</option>
            <option value="">Trabajo</option>
            <option value="">Personal</option>
            <option value="">Principal</option>
            <option value="">Fax Trabajo</option>
            <option value="">Fax Casa</option>
            <option value="">Google Voice</option>
            <option value="">Busca</option>
            <option value="">Personalizado</option>
          </select>
          </div>
          <div class="col-sm-6">
          <label for="campoTelefono">&nbsp;</label>
          <input class="form-control" name="campoTelefono" type="text" >
          </div>
  </div>
  <div class="row">
  <div class="col-sm-12 align-right">
          <button type="button" class="btn btn-default btn-sm"><i class="fa fa-plus"></i> Agregar Tel&eacute;fono</button>
          </div>
          </div>
  <div class="form-group">
  <label for="campoEmail">E-mail</label>
  <input class="form-control" name="campoEmail" type="text" >
  </div>
  <div class="form-group">
  <label for="campoDireccion">Direcci&oacute;n</label>
  <input class="form-control" name="campoDireccion" type="text" >
  </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Cancelar</button>
        <button id="saveBrand" type="button" class="btn btn-primary btn-lg"><i class="fa fa-save"></i> Guardar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</form>

</div>