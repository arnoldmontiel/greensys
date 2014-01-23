<button id="addExtraItem" type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModalAgregarRec" onclick="addExtraItem(<?php echo $model->Id?>,<?php echo $model->version_number?>);"><i class="fa fa-plus"></i> Agregar</button>
<?php 
$settings = new Settings();

	$selectPrice='$data->price." "."<div class=\"usd\">'.$settings->getEscapedCurrencyShortDescription().'</div>"';
	
	$idService = 0;
	if(isset($modelBudgetItem->Id_service))
	{
		$idService = $modelBudgetItem->Id_service;
	}
	
	$this->widget('zii.widgets.grid.CGridView', array(
					'id'=>'budget-item-additional-grid_'.$idService,
					'dataProvider'=>$modelBudgetItem->searchGenericItem(),
					'summaryText'=>'',
					'selectableRows' => 0,
					'itemsCssClass' => 'table table-striped table-bordered tablaIndividual',
					'afterAjaxUpdate'=>'js:function(id, data){setTotals();}',
					'emptyText' => 'A&uacute;n sin recargos.',				
					'columns'=>array(
							'description',
							array(
									'name'=>'quantity',
									'value'=>function($data){
										if($data->description=="Horas de programación"||$data->description=="Horas de instalación")
										{
											return $data->quantity;
												
										}else {
											return CHtml::textField("quantity",$data->quantity,array("class"=>"form-control inputMed align-right","onchange"=>"changeQuantity(".$data->Id.",this)"));
												
										}
									},
									'type'=>'raw',
							'htmlOptions'=>array("class"=>"align-center"),
							'headerHtmlOptions'=>array("class"=>"align-center"),
							),					array(
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
									'name'=>'Acciones',
									'value'=>'"<button type=\"button\" class=\"btn btn-default btn-sm\" onclick=\"removeBudgetItem(".$data->Id.");\" ><i class=\"fa fa-trash-o\"></i> Borrar</button>"',
									'type'=>'raw',
									'htmlOptions'=>array("style"=>"text-align:right;"),
									'headerHtmlOptions'=>array("style"=>"text-align:right;"),
							),

							),
					));
        ?>
