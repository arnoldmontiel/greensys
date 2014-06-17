<?php
	$dataProvider = $modelBudgetItem->search();
	$dataProvider->pagination=array(
			'route'=>'budget/AjaxUpdateBudgetItemGrid',
			'params'=>array(
					"Id_area_project"=>$areaProject->Id,
					"Id_area"=>$areaProject->Id_area,
					"Id"=>$modelBudgetItem->Id_budget,
					"version_number"=>$modelBudgetItem->version_number,
			),
	);
	$dataProvider->sort=array(
			'route'=>'budget/AjaxUpdateBudgetItemGrid',
			'params'=>array(
					"Id_area_project"=>$areaProject->Id,
					"Id_area"=>$areaProject->Id_area,
					"Id"=>$modelBudgetItem->Id_budget,
					"version_number"=>$modelBudgetItem->version_number,						
			),
	);

	$dataProvider->pagination = false;
		$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'budget-item-grid_'.$areaProject->Id."_".$areaProject->Id_area,
		'dataProvider'=>$dataProvider,
		'selectableRows' => 0,
		'emptyText' => 'A&uacute;n sin productos.',
		'summaryText'=>'',	
		'itemsCssClass' => 'table table-striped table-bordered tablaIndividual',
		'afterAjaxUpdate'=>'js:function(id, data){setTotals();}',
		'ajaxUrl'=>BudgetController::createUrl('AjaxUpdateBudgetItemGrid',array("Id_area_project"=>$areaProject->Id,"Id_area"=>$areaProject->Id_area,"Id"=>$modelBudgetItem->Id_budget,"version_number"=>$modelBudgetItem->version_number)),
		'columns'=>array(
					array(
							'name'=>'Producto',
							'value'=>function($data){
								$short_desc = 'No hay descripci&oacuten';
								if(!empty($data->product->description_customer))
									$short_desc = $data->product->description_customer;
								
								$value = CHtml::openTag("div",array("class"=>"tableProductName")).$short_desc."</div>"; 
								$value .= CHtml::openTag("div",array("class"=>"tableProductBrand")).$data->product->model."</div>";
								$value .= CHtml::openTag("div").$data->product->brand->description."</div>";
								
								return $value;
							},														
							'type'=>'raw'
					),
					array(
							'header'=>'Otros',
							'value'=>function($data){
								$value = '<label><input onchange="setAccessory('.$data->Id_product.', this);" type="checkbox"> Accesorio</label>';
								if($data->product->is_accessory == 1)
									$value = '<label><input onchange="setAccessory('.$data->Id_product.', this);" checked type="checkbox"> Accesorio</label>';
								$value  .= '<label><input type="checkbox"> No detallar</label>';
								return $value;
							},
							'type'=>'raw',
					),
					array(
							'name'=>'quantity',
							'value'=>'CHtml::textField("quantity",$data->quantity,array("class"=>"form-control inputSmall align-right","onchange"=>"changeQuantity(".$data->Id.",this)"))',
							'type'=>'raw',
							'htmlOptions'=>array("class"=>"align-center"),
							'headerHtmlOptions'=>array("class"=>"align-center"),
					),
					array(
							'header'=>'Servicio',
							'value'=>'
											CHtml::dropDownList("Id_service", $data->Id_service,CHtml::listData(Service::model()->findAll(), "Id", "description"),array(
											"prompt"=>"General","id"=>$data->Id,"class"=>"form-control campoServicio","onchange"=>"changeService(".$data->Id.",this)"
											) );',
							'type'=>'raw',
							'htmlOptions'=>array("class"=>"align-center"),
							'headerHtmlOptions'=>array("class"=>"align-center"),
					),
					array(
							'name'=>'price',
							'value'=>function($data){
							$settings = new Settings();
								return '<div class="precioTabla">
											<div class="precioTablaValor"><div class="usd">'.$settings->getCurrencyShortDescription().'</div> '.$data->price.'</div>
											<button id="btn_price_'.$data->Id.'" type="button" class="btn btn-primary btn-xs pull-right dropdown-toggle miniEdit" onclick="fillAndOpenDD('.$data->Id.');"><i class="fa fa-pencil">
											</i></button>
												<ul id="ul_price_'.$data->Id.'" class="popover right dropdown-menu superDropdown" role="menu" aria-labelledby="dropdownMenu1">
 											</ul>';
							},
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
							'value'=>function($data){
								$settings = new Settings();
								
								return '<span id="total_price_'.$data->Id.'" class="label label-primary labelPrecio"><div class="usd">'.$settings->getCurrencyShortDescription().'</div> '.$data->totalPrice.'
										</span>';
							},
							'type'=>'raw',
							'htmlOptions'=>array("class"=>"align-right"),
							'headerHtmlOptions'=>array("class"=>"align-right"),
					),
					array(
							'name'=>'Horas',
							'value'=>
							'CHtml::openTag("div",array("class"=>"bloqueHoras noMargin")).CHtml::openTag("span",array("class"=>"label label-default"))."I"."</span>".CHtml::textField("time_instalation",$data->time_instalation,array("class"=>"form-control inputMed align-right","onchange"=>"changeTimeInstalation(".$data->Id.",this,\"totals-services-grid\" )"  ))."</div>".'.
							'CHtml::openTag("div",array("class"=>"bloqueHoras noMargin")).CHtml::openTag("span",array("class"=>"label label-default"))."P"."</span>".CHtml::textField("time_programation",$data->time_programation,array("class"=>"form-control inputMed align-right","onchange"=>"changeTimeProgramation(".$data->Id.",this,\"totals-services-grid\" )"))."</div>"',
							'type'=>'raw',
							'htmlOptions'=>array("class"=>"align-center"),
							'headerHtmlOptions'=>array("class"=>"align-center"),
							),
						array(
							'name'=>'Acciones',
							'value'=>'"<button type=\"button\" class=\"btn btn-default btn-sm\" onclick=\"deleteBudgetItem(".$data->Id.",'.$areaProject->Id.','.$areaProject->Id_area.');\" ><i class=\"fa fa-trash-o\"></i> Borrar</button>"',
							'type'=>'raw',
							'htmlOptions'=>array("style"=>"text-align:center;"),
							'headerHtmlOptions'=>array("style"=>"text-align:center;"),
					),
			),
		));		
Yii::app()->clientScript->registerScript(__CLASS__.'add-item-budget', "
");
?>
