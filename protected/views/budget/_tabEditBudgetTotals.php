<?php 
$settings = new Settings();
?>



  <div class="row panelPresuFinal">
  <div class="col-sm-6"></div>
  <div class="col-sm-6">
  <div class="tituloFinalPresu">Total</div>
 <!-- <button type="button" class="btn btn-primary btn-sm agregarImp" data-toggle="modal" data-target="#myModalAgregarImp"><i class="fa fa-plus"></i> Agregar Impuesto</button> --> 
<table class="table table-striped tablePresuTotal">
        <tbody>
          <tr>
            <td width="20%" valign="middle"  width="20%">Subtotal</td>
            <td width="30%">&nbsp;</td>
            <td valign="middle"  align="right" class="bold">
            	<div class=" label label-default label-subtotal">
            			<?php echo $settings->getCurrencyShortDescription()." ";?>
            			<span id="totals_total_price"><?php echo $model->totalPrice?></span>
            	</div>
            </td>
          </tr>
          <tr>
            <td valign="middle" >Discount</td>
            <td><input type="model" id="totals_percent_discount" class="form-control formHasLabel inputSmall align-right" value="<?php echo $model->percent_discount?>"> %</td>
            <td align="right" valign="middle" class="bold"> <div class="usd"><?php echo $settings->getCurrencyShortDescription()." ";?></div> <span id="totals_discount"><?php echo $model->TotalDiscount?></span></td>
          </tr>
          <tr class="superTotal">
            <td valign="middle" >Total</td>
            <td>&nbsp;</td>
            <td valign="middle"  align="right" class="bold">
            	<div class=" label label-primary label-total">
            		<?php echo $settings->getCurrencyShortDescription()." "?>
            		<span id="totals_price_w_discount"><?php echo $model->TotalPriceWithDiscount;?> </span>
            	</div>
            </td>
          </tr>
        </tbody>
      </table>
  </div>
  </div>
 <script type="text/javascript">
 
 </script> 