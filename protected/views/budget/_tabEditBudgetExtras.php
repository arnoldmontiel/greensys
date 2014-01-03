<?php 
$settings = new Settings();
?>
<div class="row contenedorPresu">
    <div class="col-sm-6">
      <div class="tituloFinalPresu">Extra</div>
      <ul class="nav nav-tabs">
        <li class="active"><a href="#tabRecargos" data-toggle="tab">Recargos</a></li>
        <li><a href="#tabDescripciones" data-toggle="tab">Descripci&oacute;n de Servicios</a></li>
        <li class="pull-right"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModalAgregarDesc"><i class="fa fa-plus"></i> Agregar</button></li>
        </ul>
        <div class="tab-content">
        <div class="tab-pane active" id="tabRecargos">
        <?php
	$selectPrice='"<div class=\"precioTabla\"><div class=\"precioTablaValor\">".$data->price." "."<div class=\"usd\">'.$settings->getEscapedCurrencyShortDescription().'</div></div></div>"';
	
	$this->widget('zii.widgets.grid.CGridView', array(
					'afterAjaxUpdate'=>'function(id, data){setTotals();}',
					'id'=>'budget-item-generic',
					'dataProvider'=>$modelBudgetItem->searchGenericItem(),
					'summaryText'=>'',
					'selectableRows' => 0,
					'itemsCssClass' => 'table table-striped table-bordered tablaIndividual',
					'columns'=>array(
							'description',
							array(
									'name'=>'quantity',
									'value'=>'CHtml::textField("quantity",$data->quantity,array("class"=>"form-control inputSmall","onchange"=>"changeQuantity(".$data->Id.",this)"))',
									'type'=>'raw'
							),					array(
							'name'=>'price',
							'value'=>$selectPrice,
							'type'=>'raw',
					),
					array(
						'name'=>'discount',
						'value'=>
						'"<div class=\"bloqueDescuento\"> ".CHtml::textField("txtDiscount","$data->discount",array("id"=>"discount_".$data->Id,"onchange"=>"changeDiscount(".$data->Id.",this)","class"=>"form-control inputMed",))."<div class=\"radioTipo\"><div class=\"radio\">
				  <label>
				    <input type=\"radio\" name=\"optionsRadios_".$data->Id."\" id=\"discount_type_".$data->Id."\" value=\"0\" onclick=\"changeDiscountType(".$data->Id.",this);\" ".($data->discount_type==0?"checked":"").">
				    <div class=\"usd\">%</div>
				  </label>
				</div>
				<div class=\"radio\">
				  <label>
				    <input type=\"radio\" name=\"optionsRadios_".$data->Id."\" id=\"discount_type_".$data->Id."\" value=\"1\" onclick=\"changeDiscountType(".$data->Id.",this);\" ".($data->discount_type==1?"checked":"").">
				    <div class=\"usd\">USD</div>
				  </label>
				</div></div></div>"',
						'type'=>'raw',
						'htmlOptions'=>array(),
				),
							
					array(
							'name'=>'Total',
							'value'=>
							'CHtml::openTag("span",array("id"=>"total_price_".$data->Id, "class"=>"label label-primary labelPrecio")).$data->totalPrice." ".'.
							'CHtml::openTag("div",array("class"=>"usd"))."'.$settings->getEscapedCurrencyShortDescription().'".CHtml::closeTag("div").CHtml::closeTag("span")',
							'type'=>'raw',
					),

							),
					));
        ?>

</div> 
    <!-- /.tab1 -->
<div class="tab-pane" id="tabDescripciones">
<table class="table table-striped table-bordered tablaIndividual">
<thead>
<tr>
<th>Servicio</th>
<th>Descripcion</th>
<th style="text-align:center;">Acciones</th>
</tr></thead>
<tbody>
<tr>
<td>Home Theater</td>
<td>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed aliquet placerat volutpat....</td>
<td style="text-align:center;">
<a class="btn btn-default btn-sm" data-toggle="modal" data-target="#myModalEditarDesc"><i class="fa fa-pencil"></i> </a>
</td>
</tr>
<tr>
<td>Multiroom Audio</td>
<td>Nam sit amet dolor at nisi dapibus lobortis. Curabitur elementum dolor a turpis...</td>
<td style="text-align:center;">
<a class="btn btn-default btn-sm" data-toggle="modal" data-target="#myModalEditarDesc"><i class="fa fa-pencil"></i> </a>
</td>
</tr>
<tr>
<td>Control de Iluminaci&oacute;n</td>
<td>Donec nec turpis</td>
<td style="text-align:center;"> 
<a class="btn btn-default btn-sm" data-toggle="modal" data-target="#myModalEditarDesc"><i class="fa fa-pencil"></i> </a>
</td>
</tr></tbody>
</table>
</div> 
    <!-- /.tab2 -->
</div>
    <!-- /.tab-content -->
      </div>
    <!-- /.col-sm-6 -->
  <div class="col-sm-6">
  </div>
  <div class="col-sm-6">
  <div class="tituloFinalPresu">Total</div>
<table class="table tablePresuTotal">
        <tbody>
          <tr>
            <td width="20%" valign="middle"  width="20%">Subtotal</td>
            <td width="30%">&nbsp;</td>
            <td valign="middle"  align="right" class="bold"><div class="usd"><?php echo $settings->getCurrencyShortDescription();?></div><span id="totals_total_price"><?php echo " ".$model->totalPrice?></span></td>
          </tr>
          <tr>
            <td valign="middle" >Discount</td>
            <td><input type="model" id="totals_percent_discount" class="form-control formHasLabel" value="<?php echo $model->percent_discount?>"> %</td>
            <td align="right" valign="middle" class="bold"> <div class="usd"><?php echo $settings->getCurrencyShortDescription();?></div> <span id="totals_discount"><?php echo " ".$model->TotalDiscount?></span></td>
          </tr>
          <tr class="superTotal">
            <td valign="middle" >Total</td>
            <td>&nbsp;</td>
            <td valign="middle"  align="right" class="bold"><?php echo $settings->getCurrencyShortDescription()." "?><span id="totals_price_w_discount"><?php echo $model->TotalPriceWithDiscount;?> </span></td>
          </tr>
        </tbody>
      </table>
  </div>
  </div>