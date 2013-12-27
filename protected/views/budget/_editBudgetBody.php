  
   <div class="row contenedorPresu">
    <div class="col-sm-12">
      <div class="tituloFinalPresu">Productos</div>
    
      <ul class="nav nav-tabs">
        <li class="active"><a href="#tabBanio" data-toggle="tab">Ba�o </a><a class="tabEdit"><i class="fa fa-pencil"></i></a></li>
        <li><a href="#tabEsperando" data-toggle="tab">Living</a><a class="tabEdit"><i class="fa fa-pencil"></i></a></li>
        <li><a href="#tabAprobados" data-toggle="tab">Comedor</a><a class="tabEdit"><i class="fa fa-pencil"></i></a></li>
        <li class="pull-right">
          <div class="btn-group btnAlternateView">
  <button type="button" class="btn btn-default active">�reas</button>
  <button type="button" class="btn btn-default">Servicios</button>
</div>
        </li>
                <li class="pull-right"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModalAgregarProductos">Agregar Productos</button></li>
      </ul>
      <div class="tab-content">
  <div class="tab-pane active" id="tabBanio">
<table class="table table-striped table-bordered tablaIndividual" width="100%">
        <thead>
          <tr>
            <th style="text-align:left;">Model</th>
            <th style="text-align:left;">Cant</th>
            <th style="text-align:left;">Part Number</th>
            <th style="text-align:left;">Codigo</th>
            <th style="text-align:left;">Marca</th>
            <th style="text-align:left;">Stock</th>
            <th style="text-align:left;">Servicio</th>
            <th style="text-align:left;">Precio</th>
            <th style="text-align:left;">Descuento</th>
            <th style="text-align:left;">Total</th>
            <th style="text-align:left;">Horas</th>
            <th style="text-align:left;">Desc Horas</th>
            <th style="text-align:left;">Total Horas</th>
            <th style="text-align:right;">Acc</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>AD4</td>
            <td><input type="model" id="campoCantidad" class="form-control inputSmall"></td>
            <td>10-210341-12</td>
            <td>DHRT-01</td>
            <td>RTI</td>
            <td>5</td>
            <td>
            <select class="form-control" id="campoServicio">
<option value="1">Home Theater</option>
<option value="2">Multiroom Audio</option>
<option value="3">Control de iluminaci�n</option>
              </select>
            </td>
            
            <td class="precioTabla"><div class="precioTablaValor">500 <div class="usd">USD</div></div> <button type="button" class="btn btn-primary btn-xs pull-right dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown"><i class="fa fa-pencil"></i></button>
              <ul class="dropdown-menu superDropdown" role="menu" aria-labelledby="dropdownMenu1">
    <li role="presentation" class="introProveedor">
    
    <table class="table tableDatosProd">
        <thead>
          <tr>
            <th>MSRP</th>
            <th style="text-align:center;">Dealer Cost</th>
            <th style="text-align:right;">Profit Rate</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>899.00</td>
            <td style="text-align:center;">450.00</td>
            <td style="text-align:right;">2.00</td>
            </tr>
        </tbody>
      </table>
      </li>
    <li role="presentation" class="introProveedor">
    <div class="titleProveedor">Luis - Electronica </div>
    <table class="table tableOpcionesPrecio">
        <tbody>
          <tr>
            <td> <i class="fa fa-anchor fa-fw"></i>Maritimo</td>
            <td>40 Dias</td>
            <td>$200</td>
            <td style="text-align:right;">    <input type="radio" name="optionsRadios" id="optionProv" value="option1" checked></td>
            </tr>
          <tr>
            <td> <i class="fa fa-plane fa-fw"></i>Aereo</td>
            <td>40 Dias</td>
            <td>$500</td>
            <td style="text-align:right;">    <input type="radio" name="optionsRadios" id="optionProv" value="option1" checked></td>
            </tr>
        </tbody>
      </table>
    </li>
     <li role="presentation" class="introProveedor">
    <div class="titleProveedor">Luis - Muebles </div>
    <table class="table tableOpcionesPrecio">
        <tbody>
          <tr>
            <td> <i class="fa fa-anchor fa-fw"></i>Maritimo</td>
            <td>30 Dias</td>
            <td>$500</td>
            <td style="text-align:right;">    <input type="radio" name="optionsRadios" id="optionProv" value="option1" checked></td>
            </tr>
          <tr>
            <td> <i class="fa fa-plane fa-fw"></i>Aereo</td>
            <td>50 Dias</td>
            <td>$600 </td>
            <td style="text-align:right;">    <input type="radio" name="optionsRadios" id="optionProv" value="option1" checked></td>
            </tr>
        </tbody>
      </table>
    </li>
    <li role="presentation" class="introProveedor">
    <div class="titleProveedor">FOB </div>
    <table class="table tableOpcionesPrecio">
        <tbody>
          <tr>
            <td> <i class="fa fa-sun-o fa-fw"></i>MSRP</td>
            <td>$899.00</td>
            <td style="text-align:right;">    <input type="radio" name="optionsRadios" id="optionProv" value="option1" checked></td>
            </tr>
        </tbody>
      </table>
    </li>
  </ul>
            </td>
            <td>
            <div class="bloqueDescuento"><input type="model" id="campoPrecio" class="form-control inputMed">
                       <div class="radioTipo"><div class="radio">
  <label>
    <input type="radio" name="optionsRadios1" id="optionsRadios1" value="option1" checked>
    <div class="usd">USD</div>
  </label>
</div>
<div class="radio">
  <label>
    <input type="radio" name="optionsRadios1" id="optionsRadios2" value="option2">
    %
  </label>
</div></div></div>
            <td><span class="label label-primary labelPrecio">500 <div class="usd">USD</div></span></td>
            <td> <div class="bloqueHoras">
          <span class="label label-default">P</span>  
          <input type="model" id="campoCantHoras" class="form-control inputSmall">
            x 
            <input type="model" id="campoPrecioHora" class="form-control inputMed" > <div class="usd">USD</div></div>
             <div class="bloqueHoras">
          <span class="label label-default">I</span>  
          <input type="model" id="campoCantHoras" class="form-control inputSmall">
            x 
            <input type="model" id="campoPrecioHora" class="form-control inputMed" > <div class="usd">USD</div></div>
            </td>
            <td>
            <div class="bloqueDescuentoHoras"><span class="label label-default">P</span><input type="model" id="campoPrecio" class="form-control inputMed">
              <div class="radioTipo"><div class="radio">
  <label>
    <input type="radio" name="optionsRadios2" id="optionsRadios1" value="option1" checked>
    <div class="usd">USD</div>
  </label>
</div>
<div class="radio">
  <label>
    <input type="radio" name="optionsRadios2" id="optionsRadios2" value="option2">
    %
  </label>
</div></div></div>
             <div class="bloqueDescuentoHoras"><span class="label label-default">I</span><input type="model" id="campoPrecio" class="form-control inputMed">
              <div class="radioTipo"><div class="radio">
  <label>
    <input type="radio" name="optionsRadios3" id="optionsRadios1" value="option1" checked>
    <div class="usd">USD</div>
  </label>
</div>
<div class="radio">
  <label>
    <input type="radio" name="optionsRadios3" id="optionsRadios2" value="option2">
    %
  </label>
</div></div></div>
            </td>
              <td>
              <div class="bloqueTotalHoras"><span class="label label-default">P</span> 500 <div class="usd">USD</div></div>
              <div class="bloqueTotalHoras"><span class="label label-default">I</span> 300 <div class="usd">USD</div></div>
              
              </td>
            <td style="text-align:right;"> <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button></td>
          </tr>
          <tr>
            <td>AD4</td>
            <td><input type="model" id="campoCantidad" class="form-control inputSmall"></td>
            <td>10-210341-12</td>
            <td>DHRT-01</td>
            <td>RTI</td>
            <td>5</td>
            <td>
            <select class="form-control" id="campoServicio">
<option value="1">Home Theater</option>
<option value="2">Multiroom Audio</option>
<option value="3">Control de iluminaci�n</option>
              </select>
            </td>
            <td>500 <div class="usd">USD</div></td>
            <td>
            <div class="bloqueDescuento"><input type="model" id="campoPrecio" class="form-control inputMed">
                       <div class="radioTipo"><div class="radio">
  <label>
    <input type="radio" name="optionsRadios4" id="optionsRadios1" value="option1" checked>
    <div class="usd">USD</div>
  </label>
</div>
<div class="radio">
  <label>
    <input type="radio" name="optionsRadios4" id="optionsRadios2" value="option2">
    %
  </label>
</div></div></div>
            </td>
            <td><span class="label label-primary labelPrecio">500 <div class="usd">USD</div></span></td>
            <td> <div class="bloqueHoras">
          <span class="label label-default">P</span>  
          <input type="model" id="campoCantHoras" class="form-control inputSmall">
            x 
            <input type="model" id="campoPrecioHora" class="form-control inputMed" > <div class="usd">USD</div></div>
             <div class="bloqueHoras">
          <span class="label label-default">I</span>  
          <input type="model" id="campoCantHoras" class="form-control inputSmall">
            x 
            <input type="model" id="campoPrecioHora" class="form-control inputMed" > <div class="usd">USD</div></div>
            </td>
            <td>
            <div class="bloqueDescuentoHoras"><span class="label label-default">P</span><input type="model" id="campoPrecio" class="form-control inputMed">
              <div class="radioTipo"><div class="radio">
  <label>
    <input type="radio" name="optionsRadios5" id="optionsRadios1" value="option1" checked>
    USD
  </label>
</div>
<div class="radio">
  <label>
    <input type="radio" name="optionsRadios5" id="optionsRadios2" value="option2">
    %
  </label>
</div></div></div>
             <div class="bloqueDescuentoHoras"><span class="label label-default">I</span><input type="model" id="campoPrecio" class="form-control inputMed">
             <div class="radioTipo"><div class="radio">
  <label>
    <input type="radio" name="optionsRadios6" id="optionsRadios1" value="option1" checked>
    <div class="usd">USD</div>
  </label>
</div>
<div class="radio">
  <label>
    <input type="radio" name="optionsRadios6" id="optionsRadios2" value="option2">
    %
  </label>
</div></div></div>
            </td>
              <td>
              <div class="bloqueTotalHoras"><span class="label label-default">P</span> 500 <div class="usd">USD</div></div>
              <div class="bloqueTotalHoras"><span class="label label-default">I</span> 300 <div class="usd">USD</div></div>
              
              </td>
            <td style="text-align:right;"> <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button></td>
          </tr>
        </tbody>
      </table>
   </div>
   
   </div>
    </div>
    </div>
    <div class="row contenedorPresu">
  <div class="col-sm-6">
  </div>
  <div class="col-sm-6">
  <div class="tituloFinalPresu">Total</div>
<table class="table tablePresuTotal">
        <tbody>
          <tr>
            <td width="20%" valign="middle"  width="20%">Subtotal</td>
            <td width="30%">&nbsp;</td>
            <td valign="middle"  align="right" class="bold"><div class="usd">USD</div> 2000</td>
          </tr>
          <tr>
            <td valign="middle" >Discount</td>
            <td><input type="model" id="campoPrecio" class="form-control" value="0"> %</td>
            <td align="right" valign="middle" class="bold"> <div class="usd">USD</div> 2000</td>
          </tr>
          <tr class="superTotal">
            <td valign="middle" >Total</td>
            <td>&nbsp;</td>
            <td valign="middle"  align="right" class="bold">USD 2000</td>
          </tr>
        </tbody>
      </table>
  </div>
  </div>
    
  <div class="row navbar-fixed-bottom">
    <div class="col-sm-12">
      <div class="buttonsFloatBottom">
        <button type="button" class="btn btn-default"> Cancelar</button>
        <button type="button" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
      </div>
    </div>
    <!-- /.col-sm-12 --> 
  </div>
  <!-- /.row --> 