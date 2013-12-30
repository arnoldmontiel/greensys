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
            <td><?php echo $model->product->msrp?></td>
            <td style="text-align:center;"><?php echo  $model->product->dealer_cost?></td>
            <td style="text-align:right;"><?php echo $model->product->profit_rate?></td>
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
