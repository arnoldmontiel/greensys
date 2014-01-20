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
					),
					array(
							'name'=>'Horas',
							'value'=>
							'CHtml::openTag("div",array("class"=>"bloqueHoras noMargin")).CHtml::openTag("span",array("class"=>"label label-default"))."P"."</span>".CHtml::textField("time_programation",$data->time_programation,array("class"=>"form-control inputMed align-right","onchange"=>"changeTimeProgramation(".$data->Id.",this,\"totals-services-grid\" )"))."</div>".'.
							'CHtml::openTag("div",array("class"=>"bloqueHoras noMargin")).CHtml::openTag("span",array("class"=>"label label-default"))."I"."</span>".CHtml::textField("time_instalation",$data->time_instalation,array("class"=>"form-control inputMed align-right","onchange"=>"changeTimeInstalation(".$data->Id.",this,\"totals-services-grid\" )"  ))."</div>"',
							'type'=>'raw',
							'htmlOptions'=>array("class"=>"align-center"),
							'headerHtmlOptions'=>array("class"=>"align-center"),
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

