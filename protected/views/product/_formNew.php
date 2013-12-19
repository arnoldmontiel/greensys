<div class="container" id="screenAgregarProductos">
  <h1 class="pageTitle">Agregar Producto</h1>
  <div class="row">
    <div class="col-sm-4">
      <div class="rowSeparator noTopMargin">Informaci&oacute;n B&aacute;sica</div>
      <table class="table table-striped table-bordered tablaIndividual form-inline" width="100%">
        <tbody>
          <tr>
            <td width="20%" style="text-align:right;"><label for="campoModel">Model</label></td>
            <td width="80%"><input type="model" id="campoModel" class="form-control"></td>
          </tr>
          <tr>
            <td style="text-align:right;"><label for="campoPartNumber">Part Number</label></td>
            <td><input type="model" id="campoPartNumber" class="form-control"></td>
          </tr>
          <tr>
            <td style="text-align:right;"><label for="campoMarca">Marca</label></td>
            <td class="combined"><select class="form-control" id="campoMarca">
                <option>Vantage</option>
                <option>RTI</option>
              </select>
              <button type="submit" class="btn btn-default pull-right" data-toggle="modal" data-target="#myModalRapido"><i class="fa fa-plus"></i> Marca</button></td>
          </tr>
          <tr>
            <td style="text-align:right;"><label for="campoProveedor">Proveedor</label></td>
            <td class="combined"><select class="form-control" id="campoProveedor">
                <option>Vantage</option>
                <option>RTI</option>
              </select>
              <button type="submit" class="btn btn-default pull-right" data-toggle="modal" data-target="#myModalRapido"><i class="fa fa-plus"></i> Proveedor</button></td>
          </tr>
          <tr>
            <td style="text-align:right;"><label for="campoCategoria">Categor&iacute;a</label></td>
            <td class="combined"><select class="form-control" id="campoCategoria">
                <option>Home Theater</option>
                <option>Tele</option>
              </select>
              <button type="submit" class="btn btn-default pull-right" data-toggle="modal" data-target="#myModalRapido"><i class="fa fa-plus"></i> Categor&iacute;a</button></td>
          </tr>
          <tr>
            <td style="text-align:right;"><label for="campoSubcategoria">Subcategor&iacute;a</label></td>
            <td class="combined"><select class="form-control" id="campoSubcategoria">
                <option>Audio</option>
                <option>Video</option>
              </select>
              <button type="submit" class="btn btn-default pull-right" data-toggle="modal" data-target="#myModalRapido"><i class="fa fa-plus"></i> Subcat.</button></td>
          </tr>
          <tr>
            <td style="text-align:right;"><label for="campoNomenclatura">Nomenclatura</label></td>
            <td class="combined"><select class="form-control" id="campoNomenclatura">
                <option>Sin Asignar</option>
                <option>DTools</option>
              </select>
              <button type="submit" class="btn btn-default pull-right" data-toggle="modal" data-target="#myModalRapido"><i class="fa fa-plus"></i> Nomenc.</button></td>
          </tr>
          <tr>
            <td style="text-align:right;"><label for="campoTipo">Tipo</label></td>
            <td class="combined"><select class="form-control" id="campoTipo">
                <option>Controller</option>
                <option>Dimmer</option>
              </select>
              <button type="submit" class="btn btn-default pull-right" data-toggle="modal" data-target="#myModalRapido"><i class="fa fa-plus"></i> Tipo</button></td>
          </tr>
        </tbody>
      </table>
    </div>
    <!-- /.col-sm-4 -->
    <div class="col-sm-4">
      <div class="rowSeparator noTopMargin">MEDIDAS</div>
      <table class="table table-striped table-bordered tablaIndividual" width="100%">
        <tbody>
          <tr>
            <td width="20%" style="text-align:right;"><label for="campoLargo">Largo</label></td>
            <td width="80%"><input type="model" id="campoLargo" class="form-control" placeholder="0.0"></td>
          </tr>
          <tr>
            <td style="text-align:right;"><label for="campoAncho">Ancho</label></td>
            <td><input type="model" id="campoAncho" class="form-control" placeholder="0.0"></td>
          </tr>
          <tr>
            <td style="text-align:right;"><label for="campoAlto">Alto</label></td>
            <td><input type="model" id="campoAlto" class="form-control" placeholder="0.0"></td>
          </tr>
          <tr>
            <td style="text-align:right;"><label for="campoMeasureLinear">Measure Linear</label></td>
            <td><select class="form-control" id="campoMeasureLinear">
                <option>ml</option>
                <option>in</option>
                <option>ft</option>
                <option>mm</option>
                <option>cm</option>
              </select></td>
          </tr>
          <tr>
            <td style="text-align:right;"><label for="campoVolumen">Volumen</label></td>
            <td><input type="model" id="campoVolumen" class="form-control" placeholder="000m3"></td>
          </tr>
          <tr>
            <td style="text-align:right;"><label for="campoMedidaPeso">Medida Peso</label></td>
            <td><select class="form-control" id="campoMedidaPeso">
                <option>kg</option>
                <option>lb</option>
              </select></td>
          </tr>
          <tr>
            <td style="text-align:right;"><label for="campoPeso">Peso</label></td>
            <td><input type="model" id="campoPeso" class="form-control" placeholder="000m3"></td>
          </tr>
        </tbody>
      </table>
    </div>
    <!-- /.col-sm-4 --> 
    <div class="col-sm-4">
      <div class="rowSeparator noTopMargin">EXTRA</div>
      <table class="table table-striped table-bordered tablaIndividual form-inline" width="100%">
        <tbody>
          <tr>
            <td width="20%" style="text-align:right;"><label for="campoOcultar">Ocultar</label></td>
            <td width="80%"><div class="checkbox">
                <label>
                  <input type="checkbox" id="campoOcultar">
                  S&iacute; </label>
              </div></td>
          </tr>
          <tr>
            <td style="text-align:right;"><label for="campoDiscontinuado">Discontinuado</label></td>
            <td><div class="checkbox">
                <label>
                  <input type="checkbox" id="campoDiscontinuado">
                  S&iacute; </label>
              </div></td>
          </tr>
          <tr>
            <td style="text-align:right;"><label for="campoVolts">Volts</label></td>
            <td><select class="form-control" id="campoVolts">
                <option>110</option>
                <option>220</option>
                <option>0</option>
              </select></td>
          </tr>
          <tr>
            <td style="text-align:right;"><label for="campoRack">Necesita Rack</label></td>
            <td><div class="checkbox">
                <label>
                  <input type="checkbox" id="campoRack">
                  S&iacute; </label>
              </div></td>
          </tr>
          <tr>
            <td style="text-align:right;"><label for="campoCantRack">Cantidad Rack</label></td>
            <td><select class="form-control" id="campoCantRack">
                <option>0</option>
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
                <option>6</option>
                <option>7</option>
                <option>8</option>
                <option>9</option>
                <option>10</option>
              </select></td>
          </tr>
          <tr>
            <td style="text-align:right;"><label for="campoCantVent">Cantidad Ventiladores</label></td>
            <td><select class="form-control" id="campoCantVent">
                <option>0</option>
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
                <option>6</option>
                <option>7</option>
                <option>8</option>
                <option>9</option>
                <option>10</option>
              </select></td>
          </tr>
          <tr>
            <td style="text-align:right;"><label for="campoColor">Color</label></td>
            <td><input type="model" id="campoColor" class="form-control" placeholder=""></td>
          </tr>
          <tr>
            <td style="text-align:right;"><label for="campoIcono">&Iacute;cono</label></td>
            <td><input type="file" id="campoIcono"></td>
          </tr>
        </tbody>
      </table>
    </div>
    <!-- /.col-sm-4 -->
  </div>
  <!-- /.row -->
  <div class="row">
    <div class="col-sm-4">
      <div class="rowSeparator noTopMargin">INPUTS</div>
      <table class="table table-striped table-bordered tablaIndividual" width="100%">
        <tbody>
          <tr>
            <td width="20%" style="text-align:right;"><label for="campoITermianles">Input Terminales</label></td>
            <td width="80%"><textarea class="form-control" rows="2" id="campoITermianles"></textarea></td>
          </tr>
          <tr>
            <td style="text-align:right;"><label for="campoISenales">Input Se�ales</label></td>
            <td><textarea class="form-control" rows="2" id="campoISenales"></textarea></td>
          </tr>
          <tr>
            <td style="text-align:right;"><label for="campoILabels">Input Labels</label></td>
            <td><textarea class="form-control" rows="2" id="campoILabels"></textarea></td>
          </tr>
        </tbody>
      </table>
    </div>
    <!-- /.col-sm-4 -->
    <div class="col-sm-4">
      <div class="rowSeparator noTopMargin">OUTPUTS</div>
      <table class="table table-striped table-bordered tablaIndividual" width="100%">
        <tbody>
          <tr>
            <td width="20%" style="text-align:right;"><label for="campoOTermianles">Output Terminales</label></td>
            <td width="80%"><textarea class="form-control" rows="2" id="campoOTermianles"></textarea></td>
          </tr>
          <tr>
            <td style="text-align:right;"><label for="campoOSenales">Output Se&ntilde;ales</label></td>
            <td><textarea class="form-control" rows="2" id="campoOSenales"></textarea></td>
          </tr>
          <tr>
            <td style="text-align:right;"><label for="campoOLabels">Output Labels</label></td>
            <td><textarea class="form-control" rows="2" id="campoOLabels"></textarea></td>
          </tr>
        </tbody>
      </table>
    </div>
    <!-- /.col-sm-4 -->
    <div class="col-sm-4">
      <div class="rowSeparator noTopMargin">HORAS</div>
      <table class="table table-striped table-bordered tablaIndividual" width="100%">
        <tbody>
          <tr>
            <td width="20%" style="text-align:right;"><label for="campoInstalacion">Tiempo Instalaci&oacute;n</label></td>
            <td width="80%"><input type="model" id="campoInstalacion" class="form-control" placeholder="0.0"></td>
          </tr>
          <tr>
            <td style="text-align:right;"><label for="campoProgramacion">Tiempo Programaci&oacute;n</label></td>
            <td><input type="model" id="campoProgramacion" class="form-control" placeholder="0.0"></td>
          </tr>
        </tbody>
      </table>  
    </div>
    <!-- /.col-sm-4 -->
    </div>
    <!-- /.row -->
   <div class="row">
    <div class="col-sm-4">
      <div class="rowSeparator noTopMargin">PRECIOS</div>
      <table class="table table-striped table-bordered tablaIndividual form-inline" width="100%">
        <tbody>
          <tr>
            <td width="20%" style="text-align:right;"><label for="campoMSRP">MSRP</label></td>
            <td width="80%"><input type="model" id="campoMSRP" class="form-control" placeholder="0.00 USD"></td>
          </tr>
          <tr>
            <td style="text-align:right;"><label for="campoDealerCost">Dealer Cost</label></td>
            <td><input type="model" id="campoDealerCost" class="form-control" placeholder="0.00 USD"></td>
          </tr>
          <tr>
            <td style="text-align:right;"><label for="campoProfit">Profit Rate</label></td>
            <td><input type="model" id="campoProfit" class="form-control" placeholder="0.00 %"></td>
          </tr>
        </tbody>
      </table>
    </div>
    <!-- /.col-sm-4 -->
    <div class="col-sm-4">
      <div class="rowSeparator noTopMargin">COSTOS UNIDAD</div>
      <table class="table table-striped table-bordered tablaIndividual form-inline" width="100%">
        <tbody>
          <tr>
            <td width="20%" style="text-align:right;"><label for="campoCostoA">Costo Unidad A</label></td>
            <td width="80%"><input type="model" id="campoCostoA" class="form-control" placeholder="0.00"></td>
          </tr>
          <tr>
            <td style="text-align:right;"><label for="campoCostoB">Costo Unidad B</label></td>
            <td><input type="model" id="campoCostoB" class="form-control" placeholder="0.00"></td>
          </tr>
          <tr>
            <td style="text-align:right;"><label for="campoCostoC">Costo Unidad C</label></td>
            <td><input type="model" id="campoCostoC" class="form-control" placeholder="0.00"></td>
          </tr>
        </tbody>
      </table>
    </div>
    <!-- /.col-sm-4 -->
    <div class="col-sm-4">
      <div class="rowSeparator noTopMargin">PRECIOS UNIDAD</div>
      <table class="table table-striped table-bordered tablaIndividual" width="100%">
        <tbody>
          <tr>
            <td width="20%" style="text-align:right;"><label for="campoPrecioA">Precio Unidad A</label></td>
            <td width="80%"><input type="model" id="campoPrecioA" class="form-control" placeholder="0.00"></td>
          </tr>
          <tr>
            <td style="text-align:right;"><label for="campoPrecioB">Precio Unidad B</label></td>
            <td><input type="model" id="campoPrecioB" class="form-control" placeholder="0.00"></td>
          </tr>
          <tr>
            <td style="text-align:right;"><label for="campoPrecioC">Precio Unidad C</label></td>
            <td><input type="model" id="campoPrecioC" class="form-control" placeholder="0.00"></td>
          </tr>
        </tbody>
      </table>  
    </div>
    <!-- /.col-sm-4 -->
    </div>
    <!-- /.row -->
   <div class="row">
    <div class="col-sm-4">
      <div class="rowSeparator noTopMargin">ENV&iacute;O</div>
      <table class="table table-striped table-bordered tablaIndividual" width="100%">
        <tbody>
          <tr>
            <td width="20%" style="text-align:right;"><label for="campoDespachante">Despachante por defecto</label></td>
            <td width="80%"><input type="model" id="campoDespachante" class="form-control"></td>
          </tr>
          <tr>
            <td style="text-align:right;"><label for="campoEnvio">Env&iacute;o por defecto</label></td>
            <td><input type="model" id="campoEnvio" class="form-control"></td>
          </tr>
          <tr>
            <td style="text-align:right;"><label for="campoEnvio2">Env&iacute;o por defecto</label></td>
            <td><input type="model" id="campoEnvio2" class="form-control"></td>
          </tr>
        </tbody>
      </table>
    </div>
    <!-- /.col-sm-4 -->
    <div class="col-sm-4">
      <div class="rowSeparator noTopMargin">MEDIDAS CAJA ENV&iacute;O</div>
      <table class="table table-striped table-bordered tablaIndividual" width="100%">
        <tbody>
          <tr>
            <td width="20%" style="text-align:right;"><label for="campoDescCorta">Largo</label></td>
            <td width="80%"><input type="model" id="campoDespachante" class="form-control" placeholder="0.00"></td>
          </tr>
          <tr>
            <td style="text-align:right;"><label for="campoDescLarga">Ancho</label></td>
            <td><input type="model" id="campoEnvio" class="form-control" placeholder="0.00"></td>
          </tr>
          <tr>
            <td style="text-align:right;"><label for="campoDescClientes">Alto</label></td>
            <td><input type="model" id="campoEnvio" class="form-control" placeholder="0.00"></td>
          </tr>
          <tr>
            <td style="text-align:right;"><label for="campoDescClientes">Volumen</label></td>
            <td><input type="model" id="campoEnvio" class="form-control" placeholder="0.00"></td>
          </tr>
          <tr>
            <td style="text-align:right;"><label for="campoDescClientes">Peso</label></td>
            <td><input type="model" id="campoEnvio" class="form-control" placeholder="0.00"></td>
          </tr>
        </tbody>
      </table>
    </div>
    <!-- /.col-sm-4 -->
    <div class="col-sm-4">
      <div class="rowSeparator noTopMargin">PESOS DIMENSIONALES</div>
      <table class="table table-striped table-bordered tablaIndividual" width="100%">
        <tbody>
          <tr>
            <td width="20%" style="text-align:right;"><label for="campoLata">Lata</label></td>
            <td width="80%"><input type="model" id="campoLata" class="form-control" placeholder="0.00"></td>
          </tr>
          <tr>
            <td style="text-align:right;"><label for="campoFedex">Fedex</label></td>
            <td><input type="model" id="campoFedex" class="form-control" placeholder="0.00"></td>
          </tr>
          <tr>
            <td style="text-align:right;"><label for="campoDHL">DHL</label></td>
            <td><input type="model" id="campoDHL" class="form-control" placeholder="0.00"></td>
          </tr>
          <tr>
            <td style="text-align:right;"><label for="campoUps">Ups</label></td>
            <td><input type="model" id="campoUps" class="form-control" placeholder="0.00"></td>
          </tr>
          <tr>
            <td style="text-align:right;"><label for="campoCustom1">Custom 1</label></td>
            <td><input type="model" id="campoCustom1" class="form-control" placeholder="0.00"></td>
          </tr>
          <tr>
            <td style="text-align:right;"><label for="campoCustom2">Custom 2</label></td>
            <td><input type="model" id="campoCustom2" class="form-control" placeholder="0.00"></td>
          </tr>
          <tr>
            <td style="text-align:right;"><label for="campoCustom3">Custom 3</label></td>
            <td><input type="model" id="campoCustom3" class="form-control" placeholder="0.00"></td>
          </tr>
        </tbody>
      </table>
    </div>
    <!-- /.col-sm-4 -->
    </div>
    <!-- /.row -->
    
   <div class="row">
    <div class="col-sm-4">
      <div class="rowSeparator noTopMargin">EXTRA ENV&Iacute;O</div>
      <table class="table table-striped table-bordered tablaIndividual" width="100%">
        <tbody>
          <tr>
            <td width="20%" style="text-align:right;"><label for="campoNecesitaUps">Necesita Ups</label></td>
            <td><div class="checkbox">
                <label>
                  <input type="checkbox" id="campoNecesitaUps">
                  S&iacute; </label>
              </div></td>
          </tr>
          <tr>
            <td style="text-align:right;"><label for="campoDeale">Deale Distributor Price</label></td>
            <td><input type="model" id="campoDeale" class="form-control" placeholder="0.00"></td>
          </tr>
          <tr>
            <td style="text-align:right;"><label for="campoNomComercial">Nombre Comercial</label></td>
            <td><input type="model" id="campoNomComercial" class="form-control"></td>
          </tr>
          <tr>
            <td style="text-align:right;"><label for="campoDescComercial">Descripcion Comercial</label></td>
            <td><input type="model" id="campoDescComercial" class="form-control"></td>
          </tr>
        </tbody>
      </table>
    </div>
    <!-- /.col-sm-4 -->
    <div class="col-sm-4">
      <div class="rowSeparator noTopMargin">DESCUENTOS</div>
      <table class="table table-striped table-bordered tablaIndividual" width="100%">
        <tbody>
          <tr>
            <td width="20%" style="text-align:right;"><label for="campoDescuento">Descuento</label></td>
            <td width="80%"><input type="model" id="campoDescuento" class="form-control" placeholder="0.00"></td>
          </tr>
          <tr>
            <td style="text-align:right;"><label for="campoDescuentoA">Descuento Cat A</label></td>
            <td><input type="model" id="campoDescuentoA" class="form-control" placeholder="0.00"></td>
          </tr>
          <tr>
            <td style="text-align:right;"><label for="campoDescuentoB">Descuento Cat B</label></td>
            <td><input type="model" id="campoDescuentoB" class="form-control" placeholder="0.00"></td>
          </tr>
          <tr>
            <td style="text-align:right;"><label for="campoDescuentoC">Descuento Cat C</label></td>
            <td><input type="model" id="campoDescuentoC" class="form-control" placeholder="0.00"></td>
          </tr>
          <tr>
            <td style="text-align:right;"><label for="campoDescuentoD">Descuento Cat D</label></td>
            <td><input type="model" id="campoEcampoDescuentoDnvio" class="form-control" placeholder="0.00"></td>
          </tr>
        </tbody>
      </table>
    </div>
    <!-- /.col-sm-4 -->
    <div class="col-sm-4">
      <div class="rowSeparator noTopMargin">ACCESORIOS</div>
      <table class="table table-striped table-bordered tablaIndividual" width="100%">
        <tbody>
          <tr>
            <td width="20%" style="text-align:right;"><label for="campoAccesorioA">Accesorio A</label></td>
            <td width="80%"><input type="model" id="campoAccesorioA" class="form-control"></td>
          </tr>
          <tr>
            <td style="text-align:right;"><label for="campoAccesorioB">Accesorio B</label></td>
            <td><input type="model" id="campoAccesorioB" class="form-control"></td>
          </tr>
          <tr>
            <td style="text-align:right;"><label for="campoAccesorioC">Accesorio C</label></td>
            <td><input type="model" id="campoAccesorioC" class="form-control"></td>
          </tr>
          <tr>
            <td style="text-align:right;"><label for="campoAccesorioD">Accesorio D</label></td>
            <td><input type="model" id="campoAccesorioD" class="form-control"></td>
          </tr>
        </tbody>
      </table>
    </div>
    <!-- /.col-sm-4 -->
    </div>
    <!-- /.row -->
  
   <div class="row">
   
    <div class="col-sm-4">
      <div class="rowSeparator noTopMargin">DESCRIPCIONES</div>
      <table class="table table-striped table-bordered tablaIndividual" width="100%">
        <tbody>
          <tr>
            <td width="20%" style="text-align:right;"><label for="campoDescCorta">Corta</label></td>
            <td width="80%"><textarea class="form-control" rows="2" id="campoDescCorta"></textarea></td>
          </tr>
          <tr>
            <td style="text-align:right;"><label for="campoDescLarga">Larga</label></td>
            <td><textarea class="form-control" rows="4" id="campoDescLarga"></textarea></td>
          </tr>
          <tr>
            <td style="text-align:right;"><label for="campoDescClientes">Clientes</label></td>
            <td><textarea class="form-control" rows="2" id="campoDescClientes"></textarea></td>
          </tr>
          <tr>
            <td style="text-align:right;"><label for="campoProveedores">Proveedores</label></td>
            <td><textarea class="form-control" rows="2" id="campoProveedores"></textarea></td>
          </tr>
        </tbody>
      </table>
    </div>
    <!-- /.col-sm-4 --> 
    </div>
    <!-- /.row -->
    
    
  <div class="row navbar-fixed-bottom">
    <div class="col-sm-12">
      <div class="buttonsBottom">
        <button type="button" class="btn btn-default btn-lg"> Cancelar</button>
        <button type="button" class="btn btn-primary btn-lg"><i class="fa fa-save"></i> Guardar</button>
        <button type="button" class="btn btn-primary btn-lg"><i class="fa fa-save"></i> Guardar y Cargar Nuevo</button>
      </div>
    </div>
    <!-- /.col-sm-12 --> 
  </div>
  <!-- /.row --> 
</div>
<!-- /container --> 