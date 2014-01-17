<?php 
$settings = new Settings();
?>

<?php
$selectPrice='"<div class=\"precioTabla\"><div class=\"precioTablaValor\">".$data->price." "."<div class=\"usd\">'.$settings->getEscapedCurrencyShortDescription().'</div></div>'.
	'<button id=\"btn_price_".$data->Id."\" type=\"button\" class=\"btn btn-primary btn-xs pull-right dropdown-toggle miniEdit\" onclick=\"fillAndOpenDD(".$data->Id.");\">
             <i class=\"fa fa-pencil\"></i>
             </button>".'.
	'"<ul id=\"ul_price_".$data->Id."\" class=\"popover right dropdown-menu superDropdown\" role=\"menu\" aria-labelledby=\"dropdownMenu1\">
 </ul>"';

	$idService = 0;
	if(isset($modelBudgetItem->Id_service))
	{
		$dataProvider =$modelBudgetItem->search();				
		$idService = $modelBudgetItem->Id_service;
	}
	else
	{
		$dataProvider =$modelBudgetItem->searchGeneralService();
	}
	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'budget-item-grid_'.$idService,
		'dataProvider'=>$dataProvider,
		'selectableRows' => 0,
		'emptyText' => 'A&uacute;n sin productos.',
		'summaryText'=>'',	
		'afterAjaxUpdate'=>'js:function(id, data){setTotals();}',				
		'itemsCssClass' => 'table table-striped table-bordered tablaIndividual',
		'columns'=>array(
					array(
							'name'=>'Producto',
							'value'=>'CHtml::openTag("div",array("class"=>"tableProductName")).$data->product->model."</div>"
							.CHtml::openTag("div",array("class"=>"tableProductBrand")).$data->product->brand->description."</div>"
							.CHtml::openTag("div")."PN: ".$data->product->part_number."</div>"',
							'type'=>'raw',
							'footer'=>'Totales'
					),
					array(
							'name'=>'quantity',
							'value'=>'CHtml::textField("quantity",$data->quantity,array("class"=>"form-control inputMed align-right","onchange"=>"changeQuantity(".$data->Id.",this)"))',
							'type'=>'raw',
							'htmlOptions'=>array("class"=>"align-center"),
							'headerHtmlOptions'=>array("class"=>"align-center"),
					),
					array(
							'name'=>'Área',
							'value'=>'(isset($data->areaProject->description)?$data->areaProject->description:$data->area->description)',
							'type'=>'raw',
							'htmlOptions'=>array("class"=>"align-center"),
							'headerHtmlOptions'=>array("class"=>"align-center"),
					),
					array(
							'name'=>'price',
							'value'=>$selectPrice,
							'type'=>'raw',
							'htmlOptions'=>array("class"=>"align-right"),
							'headerHtmlOptions'=>array("class"=>"align-right"),
					),
					array(
							'name'=>'discount',
							'value'=>
							'"<div class=\"bloqueDescuento\"> ".CHtml::textField("txtDiscount","$data->discount",array("id"=>"discount_".$data->Id,"onchange"=>"changeDiscount(".$data->Id.",this)","class"=>"form-control inputMed align-right",))."<div class=\"radioTipo\"><div class=\"radio\">
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
							'htmlOptions'=>array("class"=>"align-center"),
							'headerHtmlOptions'=>array("class"=>"align-center"),
					),
					array(
							'name'=>'Total',
							'value'=>
								'CHtml::openTag("span",array("id"=>"total_price_".$data->Id, "class"=>"label label-primary labelPrecio")).$data->totalPrice." ".'.
								'CHtml::openTag("div",array("class"=>"usd"))."'.$settings->getEscapedCurrencyShortDescription().'".CHtml::closeTag("div").CHtml::closeTag("span")',
							'type'=>'raw',
							'htmlOptions'=>array("class"=>"align-right"),
							'headerHtmlOptions'=>array("class"=>"align-right"),
							'footerHtmlOptions'=>array("class"=>"align-right"),
							'footer'=>'<span id="total_price" class="label label-primary labelPrecio"> '.number_format($model->getTotalPriceByService($modelBudgetItem->Id_service), 2).' <div class="usd">U$D</div></span>',
								
					),
					array(
							'name'=>'Horas',
							'value'=>
							'CHtml::openTag("div",array("class"=>"bloqueHoras noMargin")).CHtml::openTag("span",array("class"=>"label label-default"))."P"."</span>".CHtml::textField("time_programation",$data->time_programation,array("class"=>"form-control inputMed align-right","onchange"=>"changeTimeProgramation(".$data->Id.",this,\"budget-item-grid_'.$idService.'\" )"))."</div>".'.
							'CHtml::openTag("div",array("class"=>"bloqueHoras noMargin")).CHtml::openTag("span",array("class"=>"label label-default"))."I"."</span>".CHtml::textField("time_instalation",$data->time_instalation,array("class"=>"form-control inputMed align-right","onchange"=>"changeTimeInstalation(".$data->Id.",this,\"budget-item-grid_'.$idService.'\" )"  ))."</div>"',
							'type'=>'raw',
							'htmlOptions'=>array("class"=>"align-center"),
							'footerHtmlOptions'=>array("class"=>"align-center"),
							'headerHtmlOptions'=>array("class"=>"align-center"),
							'footer'=>'<div class="bloqueHoras noMargin">
								<span class="label label-default">P</span>
								'.number_format($model->getTotalTimeProgramationByService($modelBudgetItem->Id_service), 2).'='.number_format($model->getTotalPriceTimeProgramationByService($modelBudgetItem->Id_service), 2).'
								</div>
							<div class="bloqueHoras noMargin">
								<span class="label label-default">I</span>
								'.number_format($model->getTotalTimeInstalationByService($modelBudgetItem->Id_service), 2).'='.number_format($model->getTotalPriceTimeInstalationByService($modelBudgetItem->Id_service), 2).'
								</div>'
							),
					array(
							'name'=>'Acciones',
							'value'=>'"<button type=\"button\" class=\"btn btn-default btn-sm\" onclick=\"deleteBudgetItemByService(".$data->Id.",'.$idService.');\" ><i class=\"fa fa-trash-o\"></i> Borrar</button>"',
							'type'=>'raw',
							'htmlOptions'=>array("style"=>"text-align:center;"),
							'headerHtmlOptions'=>array("style"=>"text-align:center;"),
					),
			),
		));		
Yii::app()->clientScript->registerScript(__CLASS__.'add-item-budget', "
");
?>

<div class="tituloFinalPresu" style="margin-top:20px;font-size:1.4em;">Subtotales por Servicio</div>
<table class="table table-striped table-bordered tablaIndividual">
<thead>
<tr>
<th>Servicio</th>
<th class="align-right">Totales</th>
<th class="align-right">Horas Totales</th>
</tr>
</thead>
<tbody>
<tr>
<td>General</td>
<td style="text-align:right;">
USD 50009
</td>
<td style="text-align:right;">
500 x 8.50 =  USD 300
</td>
</tr>
<tr>
<td>Home Theater</td>
<td style="text-align:right;">
USD 50009
</td>
<td style="text-align:right;">
500 x 8.50 =  USD 300
</td>
</tr>
</tbody>
</table>

