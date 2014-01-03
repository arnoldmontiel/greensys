<?php 
$settings = new Settings();
?>
<script type="text/javascript">
function changeService(id, object)
{

	$.post(
			"<?php echo BudgetController::createUrl('AjaxSaveService')?>",
			{
				Id_budget_item: id,Id_service:$(object).val()
			}
			).success(function(data)
			{
		}).error(function(data)
			{
		},"json");	
}

function changeDiscount(id, object)
{
	validateNumber(object);
	$.post(
			"<?php echo BudgetController::createUrl('AjaxSaveDiscountValue')?>",
			{
				Id_budget_item: id,discount:$(object).val()
			}
			).success(function(data)
			{
				var response = jQuery.parseJSON(data);
				$("#total_price_"+id).html(response.total_price+" <div class=\"usd\"><?php echo $settings->getEscapedCurrencyShortDescription()?></div>");
				$(object).val(response.discount);
				//setTotals();
				//alert("success");				
		}).error(function(data)
			{
				//alert("error");				
		},"json");	
}
function changeQuantity(id, object)
{
	validateNumber(object);
	$.post(
			"<?php echo BudgetController::createUrl('AjaxSaveQuantity')?>",
			{
				Id_budget_item: id,quantity:$(object).val()
			}
			).success(function(data)
			{
				var response = jQuery.parseJSON(data);
				$("#total_price_"+id).html(response.total_price+" <div class=\"usd\"><?php echo $settings->getEscapedCurrencyShortDescription()?></div>");
				$(object).val(response.quantity);
				//setTotals();
				//alert("success");				
		}).error(function(data)
			{
				//alert("error");				
		},"json");	
}

function changeDiscountType(id, object)
{
	$.post(
			"<?php echo BudgetController::createUrl('AjaxSaveDiscountType')?>",
			{
				Id_budget_item: id,discount_type:$(object).val()
			}
			).success(function(data)
			{
				var response = jQuery.parseJSON(data);
				$("#total_price_"+id).html(response.total_price+" <div class=\"usd\"><?php echo $settings->getEscapedCurrencyShortDescription()?></div>");
				//setTotals();
		}).error(function(data)
			{
				//alert("error");				
		},"json");	
}
function deleteBudgetItem(id,idArea)
{
	if(confirm("¿Esta seguro que desea eliminar este item?"))
	{
		$.post(
				'<?php echo BudgetController::createUrl('AjaxDeleteBudgetItem')?>',
				 {
				 	id: id,
				 },'json').success(
					function(data) 
					{
						 $.fn.yiiGridView.update('budget-item-grid_'+idArea); 
					}
				);		
	}	
 	return false;
}

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

<?php
$selectPrice='"<div class=\"precioTabla\"><div class=\"precioTablaValor\">".$data->price." "."<div class=\"usd\">'.$settings->getEscapedCurrencyShortDescription().'</div></div>'.
	'<button id=\"btn_price_".$data->Id."\" type=\"button\" class=\"btn btn-primary btn-xs pull-right dropdown-toggle miniEdit\" onclick=\"fillAndOpenDD(".$data->Id.");\">
             <i class=\"fa fa-pencil\"></i>
             </button>".'.
	'"<ul id=\"ul_price_".$data->Id."\" class=\"popover right dropdown-menu superDropdown\" role=\"menu\" aria-labelledby=\"dropdownMenu1\">
 </ul>"';

	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'budget-item-grid_'.$areaProject->Id_area,
		'dataProvider'=>$modelBudgetItem->search(),
		'selectableRows' => 0,
		'summaryText'=>'',	
		'itemsCssClass' => 'table table-striped table-bordered tablaIndividual',
		'columns'=>array(
					array(
							'name'=>'Producto',
							'value'=>'CHtml::openTag("div",array("class"=>"tableProductName")).$data->product->model."</div>"
							.CHtml::openTag("div",array("class"=>"tableProductBrand")).$data->product->brand->description."</div>"
							.CHtml::openTag("div")."PN: ".$data->product->part_number."</div>"',
							'type'=>'raw'
					),
					array(
							'name'=>'stock',
							'value'=>'CHtml::openTag("div").$data->product->stockCount."</div>"',
							'type'=>'raw',
					),
					array(
							'name'=>'quantity',
							'value'=>'CHtml::textField("quantity",$data->quantity,array("class"=>"form-control inputSmall","onchange"=>"changeQuantity(".$data->Id.",this)"))',
							'type'=>'raw'
					),
					array(
							'name'=>'service',
							'value'=>'
											CHtml::dropDownList("Id_service", $data->Id_service,CHtml::listData(Service::model()->findAll(), "Id", "description"),array(
											"prompt"=>"Servicios","id"=>$data->Id,"class"=>"form-control campoServicio","onchange"=>"changeService(".$data->Id.",this)"
											) );',
							'type'=>'raw',
					),
					array(
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
					array(
							'name'=>'Horas',
							'value'=>
							'CHtml::openTag("div",array("class"=>"bloqueHoras noMargin")).CHtml::openTag("span",array("class"=>"label label-default"))."P"."</span>".CHtml::textField("time_programation",$data->time_programation,array("class"=>"form-control inputSmall"))."</div>".'.
							'CHtml::openTag("div",array("class"=>"bloqueHoras noMargin")).CHtml::openTag("span",array("class"=>"label label-default"))."I"."</span>".CHtml::textField("time_instalation",$data->time_instalation,array("class"=>"form-control inputSmall"))."</div>"',
							'type'=>'raw',
					),
		array(
							'name'=>'Acciones',
							'value'=>'"<button type=\"button\" class=\"btn btn-default btn-sm\" onclick=\"deleteBudgetItem(".$data->Id.",'.$areaProject->Id_area.');\" ><i class=\"fa fa-trash-o\"></i></button>"',
							'type'=>'raw',
							'htmlOptions'=>array("style"=>"text-align:center;"),
							'headerHtmlOptions'=>array("style"=>"text-align:center;"),
					),
			),
		));		
Yii::app()->clientScript->registerScript(__CLASS__.'add-item-budget', "
");
?>
