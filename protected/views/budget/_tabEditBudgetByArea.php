<script type="text/javascript">
function fillAndOpenDD(id)
{
	$(".dropdown-menu").removeClass("open");
	$.post(
			'<?php echo BudgetController::createUrl('ajaxFillDDPriceSelector')?>',
			 {
			 	Id: id,
			 },'json').success(
				function(data) 
				{ 
					if(data!='')
					{
						$("#btn_price_"+id).parent().addClass("open");
						$("#ul_price_"+id).html(data);
					}
				}
			);		
	
 	return false;
}
<!--

//-->
</script>

<table class="table table-striped table-hover table-bordered tablaIndividual" width="100%">
        <thead>
          <tr>
            <th style="text-align:left;">Producto</th>
            <th style="text-align:left;">Cant</th>
            <th style="text-align:left;">Servicio</th>
            <th style="text-align:left;">Precio</th>
            <th style="text-align:left;">Descuento</th>
            <th style="text-align:left;">Total</th>
            <th style="text-align:left;">Horas</th>
            <th style="text-align:left;">Desc Horas</th>
            <th style="text-align:left;">Total Horas</th>
            <th style="text-align:center;">Acciones</th>
          </tr>
        </thead>
        <tbody><tr>
            <td>
            <div class="tableProductName">AD4</div>
            <div class="tableProductBrand">RTI</div>
            <div>PN: 10-2003984</div>
            <div>Stock: 05</div>
            </td>
            <td><input type="model" id="campoCantidad" class="form-control inputSmall"></td>
            <td>
            <select class="form-control" id="campoServicio">
<option value="1">Home Theater</option>
<option value="2">Multiroom Audio</option>
<option value="3">Control de iluminaci�n</option>
              </select>
            </td>
            
            <td class="precioTabla"><div class="precioTablaValor">500 <div class="usd">USD</div></div> <button type="button" class="btn btn-primary btn-xs pull-right dropdown-toggle miniEdit" id="dropdownMenu1" data-toggle="dropdown"><i class="fa fa-pencil"></i></button>
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
    <li role="presentation" class="introProveedor" style="text-align: center;"><button type="button" class="btn btn-default"> Cerrar</button></li>
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
            <td> <div class="bloqueHoras noMargin">
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
            <td style="text-align:center;"> <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button></td>
          </tr>
          <tr>
            <td>
            <div class="tableProductName">ADR RTIPANEL PREMIUM/E</div>
            <div class="tableProductBrand">RTI</div>
            <div>PN: 10-2003984</div>
            <div>Stock: 05</div>
            </td>
            <td><input type="model" id="campoCantidad" class="form-control inputSmall"></td>
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
            <td> <div class="bloqueHoras noMargin">
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
            <td style="text-align:center;"> <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button></td>
          </tr>
          
        </tbody>
      </table>
<?php
$settings = new Settings();
$selectPrice='"<div class=\"precioTablaValor\">".$data->price." "."<div class=\"usd\">'.$settings->getEscapedCurrencyShortDescription().'</div></div>'.
	'<button id=\"btn_price_".$data->Id."\" type=\"button\" class=\"btn btn-primary btn-xs pull-right dropdown-toggle\" onclick=\"fillAndOpenDD(".$data->Id.");\">
             <i class=\"fa fa-pencil\"></i>
             </button>".'.
	'"<ul id=\"ul_price_".$data->Id."\" class=\"dropdown-menu superDropdown\" role=\"menu\" aria-labelledby=\"dropdownMenu1\">
  </ul>"';

	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'budget-grid-approved',
		'dataProvider'=>$modelBudgetItem->search(),
		'selectableRows' => 0,
		'summaryText'=>'',	
		'itemsCssClass' => 'table table-striped table-bordered tablaIndividual',
		'columns'=>array(
					array(
							'name'=>'Producto',
							'value'=>'CHtml::openTag("div",array("class"=>"tableProductName")).$data->product->model."</div>"
							.CHtml::openTag("div",array("class"=>"tableProductBrand")).$data->product->brand->description."</div>"
							.CHtml::openTag("div")."PN: ".$data->product->part_number."</div>"
							.CHtml::openTag("div")."Stock: ".$data->product->stockCount."</div>"',
							'type'=>'raw'
					),
					array(
							'name'=>'quantity',
							'value'=>'CHtml::textField("quantity",$data->quantity,array("class"=>"form-control inputSmall"))',
							'type'=>'raw'
					),
// 					array(
// 							'name'=>'stock',	
// 							'value'=>'$data->hasStockAssigned?
// 									    		 CHtml::button("View Stock Assign",
// 									    					array("class"=>"btn-View-Assign",
// 									    							"idBudgetItem"=>$data->Id,
// 									    							"idProduct"=>$data->Id_product,
// 									    							"idArea"=>$data->Id_area,"idAreaProject"=>$data->Id_area_project,))
// 									    		:
// 									    		 CHtml::button(($data->product->stockCount)>0?"Assign from stock":"No Stock",
// 									    					array("class"=>"btn-Assign-From-Stock",
// 									    							"idBudgetItem"=>$data->Id,
// 									    							"idProduct"=>$data->Id_product,
// 									    							"idArea"=>$data->Id_area,"idAreaProject"=>$data->Id_area_project,
// 									    							"disabled"=>($data->product->stockCount > 0)?"":"disabled", ))'
// 							,
// 							'type'=>'raw'
// 					),
					array(
							'name'=>'service',
							'value'=>'
											CHtml::dropDownList("Id_service", $data->Id_service,CHtml::listData(Service::model()->findAll(), "Id", "description"),array(
											"prompt"=>"Servicios","id"=>$data->Id,"class"=>"form-control campoServicio"
											) );',
							'type'=>'raw',
					),
					array(
							'name'=>'price',
							'value'=>$selectPrice,
							'type'=>'raw',
							'htmlOptions'=>array("class"=>"precioTabla"),
					),
					array(
							'name'=>'discount',
							'value'=>
							'CHtml::textField("txtDiscount",
																'.('(	(($data->discount_type==0)?"% ":"'.$settings->getEscapedCurrencyShortDescription().' ").$data->discount)').',
																		array(
																				"id"=>$data->Id,
																				"class"=>"txtDiscount",
																				"disabled"=>"",
																				"style"=>"width:'.('50px').';text-align:right;",
																			)
																	)',
					
							'type'=>'raw',
					
							'htmlOptions'=>array(),
					),
// 					array(
// 							'name'=>'total_price',
// 							'value'=>
// 							'CHtml::textField("txtTotalPrice",
// 																								"'.$settings->getEscapedCurrencyShortDescription().' ".$data->totalPrice,
// 																								array(
// 																										"id"=>$data->Id,
// 																										"class"=>"txtTotalPrice",
// 																										"disabled"=>"disbled",
// 																										"style"=>"width:90px;text-align:right;",
// 																									)
// 																							)',
								
// 							'type'=>'raw',
								
// 							'htmlOptions'=>array(),
// 					),
					array(
							'name'=>'Total',
							'value'=>
								'CHtml::openTag("span",array("class"=>"label label-primary labelPrecio")).$data->totalPrice." ".'.
								'CHtml::openTag("div",array("class"=>"usd"))."'.$settings->getEscapedCurrencyShortDescription().'".CHtml::closeTag("div").CHtml::closeTag("span")',
							'type'=>'raw',
					),
					
					array(
							'name'=>'discount_type',
							'value'=>'CHtml::dropDownList("discount_type", $data->discount_type,array("%","'.$settings->getEscapedCurrencyShortDescription().'"),array(
													"id"=>$data->Id,"class"=>"ddl_discount_type","style"=>"width:50px"
													) );',
							'type'=>'raw',
							'htmlOptions'=>array('style'=>"width:20px"),
					)
					,
					array(
							'value'=>
							'CHtml::image("images/grid_warning.png","",
													array("title"=>"Pending check products",
														"style"=>!$data->DoNotWarning?"display":"display:none",
														"id"=>$data->Id, "idArea"=>$data->Id_area, "idAreaProject"=>$data->Id_area_project, "idProduct"=>$data->Id_product, "class"=>"link-popup"
													)
												)',
							'type'=>'raw',
							'htmlOptions'=>array(),
					),
					
					array(
							'class'=>'CButtonColumn',
							'template'=>'{delete}',
							'deleteConfirmation'=>"js:'Are you sure you want to delete this item?'",
							'buttons'=>array
							(
									'delete' => array
									(
											'url'=>'Yii::app()->createUrl("budget/AjaxDeleteBudgetItem", array("id"=>$data->Id))',
									),
							),
					),
),
		));		
Yii::app()->clientScript->registerScript(__CLASS__.'add-item-budget', "
");
?>
