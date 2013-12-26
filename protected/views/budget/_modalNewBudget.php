<div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Crear Presupuesto</h4>
      </div>
      <div class="modal-body">

<form role="form">
  <div class="form-group">
    <label for="campoProyecto">Proyecto</label>
	<select class="form-control" id="campoProyecto">
                <option>Alvear Tower - Contacto Inicial</option>
                <option>Ariel Wasserman - Contacto Inicial</option>
                <option>RTI</option>
              </select>
  </div>
  <div class="form-group">
    <label for="campoEstado">Estado</label>
	<select class="form-control" id="campoEstado">
                <option>Nuevo</option>
              </select>
  </div>
  <div class="form-group">
    <label for="campoDescuento">Descuento</label>
	<input type="text" id="campoDescuento" class="form-control">
  </div>
  <div class="form-group">
    <label for="campoDescripcion">Descripci&oacute;n</label>
	<textarea class="form-control" rows="3" id="campoDescripcion"></textarea>
  </div>
  <div class="form-group col-sm-6 limpiarPadding paddingRight">
    <label for="campoEstInicial">Fecha Estimada Inicio</label>
	<input type="text" id="campoEstInicial" class="form-control">
  </div>
  <div class="form-group col-sm-6 limpiarPadding paddingLeft">
    <label for="campoEstFinal">Fecha Estimada Finalizaci&oacute;n</label>
	<input type="text" id="campoEstFinal" class="form-control">
  </div>
  <div class="form-group col-sm-6 limpiarPadding paddingRight">
    <label for="campoInicio">Fecha Inicio</label>
	<input type="text" id="campoInicio" class="form-control">
  </div>
  <div class="form-group col-sm-6 limpiarPadding paddingLeft">
    <label for="campoFinal">Fecha Finalizaci&oacute;n</label>
	<input type="text" id="campoFinal" class="form-control">
  </div>
</form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary btn-lg"><i class="fa fa-save"></i> Guardar</button>
        <a href="crearPresupuesto.php" class="btn btn-primary btn-lg"><i class="fa fa-save"></i> Guardar y Agregar Prods.</a>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->