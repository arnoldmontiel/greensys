<?php 
$settings = new Settings();
?>

   <div class="row contenedorPresu">
    <div class="col-sm-12">
<div class="tituloFinalPresu">Subtotales por Servicio</div>
    <p>En esta tabla se muestran los n&uacute;meros finales con descuentos ya aplicados.</p>
<?php
$criteria = new CDbCriteria();
$criteria->with[]="service";
$criteria->addCondition('Id_budget='.$model->Id);
$criteria->addCondition('version_number='.$model->version_number);
$criteria->group="Id_service";
$criteria->order="service.description";

$modelBudgetItemService = New BudgetItem();
$sort=new CSort;

$dataProvider = new CActiveDataProvider($modelBudgetItemService, array(
		'criteria'=>$criteria,
		'sort'=>$sort,
));

$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'totals-services-grid',
		'dataProvider'=>$dataProvider,
		'selectableRows' => 0,
		'emptyText' => 'A&uacute;n sin servicios.',
		'summaryText'=>'',	
		'itemsCssClass' => 'table table-striped table-bordered tablaIndividual',
		'columns'=>array(
					array(
							'name'=>'Servicio',
							'value'=>function($data)
								{
									return isset($data->service)?$data->service->description:"General";
									//return number_format($model->getTotalPriceByService($data->Id), 2);
								},
							'type'=>'raw',
					),
					array(
							'name'=>'Equipos',
							'value'=>
								function($data)
								{
									return $data->budget->currency->short_description.' '.number_format($data->budget->getTotalPriceByService($data->Id_service), 2);
								},
							'type'=>'raw',
							'htmlOptions'=>array("class"=>"align-right"),		
							'headerHtmlOptions'=>array("class"=>"align-right"),								
					),
					array(
							'name'=>'Programación',
							'value'=>
							function($data)
							{							
								return $data->budget->currency->short_description.' '.number_format($data->budget->getTotalPriceTimeProgramationByService($data->Id_service), 2);
							},
							'type'=>'raw',
							'htmlOptions'=>array("class"=>"align-right"),
							'headerHtmlOptions'=>array("class"=>"align-right"),								
					),
					array(
							'name'=>'Instalación',
							'value'=>
							function($data)
							{
								return $data->budget->currency->short_description.' '.number_format($data->budget->getTotalPriceTimeInstalationByService($data->Id_service), 2);
							},
							'type'=>'raw',
							'htmlOptions'=>array("class"=>"align-right"),
							'headerHtmlOptions'=>array("class"=>"align-right"),
					),
					array(
							'name'=>'Otros Recargos',
							'value'=>function($data){
								return $data->budget->currency->short_description.' '.number_format($data->budget->getTotalPriceAdditionalByService($data->Id_service), 2);
							},
							'type'=>'raw',
							'htmlOptions'=>array("class"=>"align-right"),
							'headerHtmlOptions'=>array("class"=>"align-right"),
					),
					array(
							'name'=>'Total',
							'value'=>
							function($data)
							{
								$settings = new Settings();
								$setting = $settings->getSetting();
									return '<span class="label label-primary labelPrecio"><div class="usd">'.$data->budget->currency->short_description.'</div> '.number_format($data->budget->getTotalPriceByServiceWithHours($data->Id_service), 2).'</span>';
							},
							'type'=>'raw',
							'htmlOptions'=>array("class"=>"align-right"),
							'headerHtmlOptions'=>array("class"=>"align-right"),								
					),
			),
		));
?>		
    <?php echo $this->renderPartial('_tabEditBudgetTotals',array(
						'model'=>$model,
						'modelProduct'=>$modelProduct,
						'modelBudgetItem'=>$modelBudgetItem,
						'priceListItemSale'=>$priceListItemSale,
						'modelBudgetItemGeneric'=>$modelBudgetItemGeneric,));
    ?>


    </div>
    <!-- /.col-sm-12 --> 
  </div>
  <!-- /.row -->

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