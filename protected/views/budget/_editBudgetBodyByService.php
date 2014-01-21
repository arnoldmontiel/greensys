<?php 
$settings = new Settings();
?>
    <?php echo $this->renderPartial('_tabEditBudgetExtras',array(
						'model'=>$model,
						'modelProduct'=>$modelProduct,
						'modelBudgetItem'=>$modelBudgetItem,
						'priceListItemSale'=>$priceListItemSale,
						'modelBudgetItemGeneric'=>$modelBudgetItemGeneric,));
    ?>

   <div class="row contenedorPresu noBorder">
    <div class="col-sm-12">
      <div class="tituloFinalPresu">Equipos por Servicio</div>
    
      <ul class="nav nav-tabs">
        <?php 
        $first = true;
        $criteria = new CDbCriteria();
        $criteria->addCondition('Id_budget='.$model->Id);
        $criteria->addCondition('version_number='.$model->version_number);
        $criteria->group="Id_service";
        $services = BudgetItem::model()->findAll($criteria);
        foreach($services as $item)	{ ?>
        <li class="<?php echo ($first?'active':'');?>">
        	<a onclick="changeTabByService(<?php echo (isset($item->Id_service)?$item->Id_service:0);?>)" href="#itemService_<?php echo (isset($item->Id_service)?$item->Id_service:0);?>" data-toggle="tab">
        		<span id="areaProjectDescription_<?php echo $item->Id?>"><?php echo (isset($item->service)?$item->service->description:"General");?></span>
        	</a>
        </li>
		<?php if($first)
	        {
	        	$first= false;
	        }
		}
		?>
      
        <li class="pull-right">
        <!-- <button <?php echo !isset($idArea)?'disabled="disabled"':'';?> onclick="addProduct(<?php echo $model->Id .', '. $model->version_number;?>);" type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModalAgregarProductos"><i class="fa fa-plus"></i> Agregar Productos</button> -->
          <div class="btn-group btnAlternateView">
		  <button onclick="editBudget(<?php echo $model->Id?>,<?php echo $model->version_number?>)" type="button" class="btn btn-default">Áreas</button>
		  <button onclick="editBudgetByService(<?php echo $model->Id?>,<?php echo $model->version_number?>)" type="button" class="btn btn-default active">Servicios</button>
          </div>
        </li>
       <!-- <li id="addAreaToProject" class="liButtonAdd"><button type="button" class="btn btn-primary btn-sm" data-toggle="modal" ><i class="fa fa-plus"></i> Agregar Area</button></li> -->
      </ul>
      <div class="tab-content">
        <?php
        $first = true;
        foreach($services as $item)	{ ?>
        <div class="tab-pane <?php echo $first?'active':'';?>" id="itemService_<?php echo (isset($item->Id_service)?$item->Id_service:0);?>">
        <?php 
	        
        	if($first)
        	$first = false;
	        $modelBudgetItem->Id_service = $item->Id_service;
	        
	        echo $this->renderPartial('_tabEditBudgetByService',array(
						'model'=>$model,
						'modelProduct'=>$modelProduct,
						'modelBudgetItem'=>$modelBudgetItem,
						'priceListItemSale'=>$priceListItemSale,
						'modelBudgetItemGeneric'=>$modelBudgetItemGeneric,
			));
		?>

   </div>  <!-- /.tab-pane --> 
  		<?php } ?>
  		
  		
  		   </div>  <!-- /.tab-content --> 
    </div>
    <!-- /.col-sm-12 --> 
  </div>
  <!-- /.row --> 
  
  <div class="row contenedorPresu">
    <div class="col-sm-12">
<div class="tituloFinalPresu">Adicionales</div>



  <ul class="nav nav-tabs">
                <li class="active">
        	<a onclick="changeTabByService(0)" href="#itemService_00" data-toggle="tab">
        		<span id="areaProjectDescription_162">General</span>
        	</a>
        </li>
		        <li class="">
        	<a onclick="changeTabByService(1)" href="#itemService_01" data-toggle="tab">
        		<span id="areaProjectDescription_161">Home Theater</span>
        	</a>
        </li>
		        <li class="">
        	<a onclick="changeTabByService(2)" href="#itemService_02" data-toggle="tab">
        		<span id="areaProjectDescription_166">Multiroom Audio</span>
        	</a>
        </li>
		        <li class="">
        	<a onclick="changeTabByService(3)" href="#itemService_30" data-toggle="tab">
        		<span id="areaProjectDescription_168">Control de iluminaci&oacute;n</span>
        	</a>
        </li>
        <li class="pull-right"><button  type="button" class="btn btn-primary"><i class="fa fa-plus"></i> Agregar</button></li>
         </ul>
  
  <div class="tab-content">
                <div class="tab-pane active" id="itemService_00">
                
                <table class="table table-striped table-bordered tablaIndividual">
<thead>
<tr>
<th>Descripci&oacute;n</th>
<th>Horas</th>
<th>Precio</th>
<th>Descuento</th>
<th>Total</th>
<th class="align-right">Acciones</th>
</thead>
<tbody>
<tr>
<td>Programaci�n</td>
<td class="align-center">0.00</td>
<td class="align-right">25.00 <div class="usd">U$D</div></td>
<td class="align-center">
<div class="bloqueDescuento">
<input id="discount_162" class="form-control inputMed align-right" type="text" value="0.00" name="txtDiscount">
<div class="radioTipo">
<div class="radio">
<label>
<input type="radio" name="optionsRadios_162" id="discount_type_162" value="0"checked="">
<div class="usd">%</div>
</label>
</div>
<div class="radio">
<label>
<input type="radio" name="optionsRadios_162" id="discount_type_162" value="1" >
<div class="usd">USD</div>
 </label>
</div>
</div>
</div>
</td>
<td class="align-right">
<span id="total_price_162" class="label label-primary labelPrecio">0.00 <div class="usd">U$D</div></span>
</td>
<td style="text-align:right;"><button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button></td>
</tr>
<tr>
<td>Instalaci�n</td>
<td class="align-center">330.00</td>
<td class="align-right">25.00 <div class="usd">U$D</div></td>
<td class="align-center">
<div class="bloqueDescuento">
<input id="discount_162" class="form-control inputMed align-right" type="text" value="0.00" name="txtDiscount">
<div class="radioTipo">
<div class="radio">
<label>
<input type="radio" name="optionsRadios_162" id="discount_type_162" value="0"checked="">
<div class="usd">%</div>
</label>
</div>
<div class="radio">
<label>
<input type="radio" name="optionsRadios_162" id="discount_type_162" value="1" >
<div class="usd">USD</div>
 </label>
</div>
</div>
</div>
</td>
<td class="align-right">
<span id="total_price_162" class="label label-primary labelPrecio">40.00 <div class="usd">U$D</div></span>
</td>
<td style="text-align:right;"><button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button></td>
</tr>
<tr>
<td>Calibracion</td>
<td class="align-center">&nbsp;</td>
<td class="align-right"><input id="discount_162" class="form-control inputMed align-right" type="text" value="0.00" name="txtDiscount"> <span class="usd">U$D</span></td>
<td class="align-center">
<div class="bloqueDescuento">
<input id="discount_162" class="form-control inputMed align-right" type="text" value="0.00" name="txtDiscount">
<div class="radioTipo">
<div class="radio">
<label>
<input type="radio" name="optionsRadios_162" id="discount_type_162" value="0"checked="">
<div class="usd">%</div>
</label>
</div>
<div class="radio">
<label>
<input type="radio" name="optionsRadios_162" id="discount_type_162" value="1" >
<div class="usd">USD</div>
 </label>
</div>
</div>
</div>
</td>
<td class="align-right">
<span id="total_price_162" class="label label-primary labelPrecio">0.00 <div class="usd">U$D</div></span>
</td>
<td style="text-align:right;"><button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i> Borrar</button></td>
</tr>
</tbody>
</table>
                </div>
                <div class="tab-pane" id="itemService_01"> TAB2</div>
                <div class="tab-pane" id="itemService_02">TAB3</div>
                <div class="tab-pane" id="itemService_03"> TAB4</div>
  
  		   </div>  <!-- /.tab-content --> 
    </div>
    <!-- /.col-sm-12 --> 
  </div>
  <!-- /.row --> 
  
   <div class="row contenedorPresu">
    <div class="col-sm-12">
<div class="tituloFinalPresu">Subtotales por Servicio</div>
    <p>En esta tabla se muestran los n&uacute;meros finales con descuentos ya aplicados.</p>
<?php 
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
									return number_format($data->budget->getTotalPriceByService($data->Id_service), 2).' '.$data->budget->currency->short_description;
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
								$settings = new Settings();
								$setting = $settings->getSetting();								
								return number_format($data->budget->getTotalTimeProgramationByService($data->Id_service), 2).' x '.$setting->time_programation_price.' '.$data->budget->currency->short_description.' = '.number_format($data->budget->getTotalPriceTimeProgramationByService($data->Id_service), 2).' '.$data->budget->currency->short_description;
								//return number_format($data->budget->getTotalPriceByService($data->Id), 2);
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
								$settings = new Settings();
								$setting = $settings->getSetting();
								return number_format($data->budget->getTotalTimeInstalationByService($data->Id_service), 2).' x '.$setting->time_instalation_price.' '.$data->budget->currency->short_description.' = '.number_format($data->budget->getTotalPriceTimeInstalationByService($data->Id_service), 2).' '.$data->budget->currency->short_description;
							},
							'type'=>'raw',
							'htmlOptions'=>array("class"=>"align-right"),
							'headerHtmlOptions'=>array("class"=>"align-right"),
					),
					array(
							'name'=>'Otros Recargos',
							'value'=>function($data){
	$grid = "'budget-grid-otrosRec'";
	return '';
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
									return "<span class='label label-primary labelPrecio'>".number_format($data->budget->getTotalPriceByServiceWithHours($data->Id_service), 2).' <div class="usd">'.$data->budget->currency->short_description."</div></span>";
							},
							'type'=>'raw',
							'htmlOptions'=>array("class"=>"align-right"),
							'headerHtmlOptions'=>array("class"=>"align-right"),								
					),
			),
		));
?>		


    </div>
    <!-- /.col-sm-12 --> 
  </div>
  <!-- /.row --> 


    <?php echo $this->renderPartial('_tabEditBudgetTotals',array(
						'model'=>$model,
						'modelProduct'=>$modelProduct,
						'modelBudgetItem'=>$modelBudgetItem,
						'priceListItemSale'=>$priceListItemSale,
						'modelBudgetItemGeneric'=>$modelBudgetItemGeneric,));
    ?>
    
  <div class="row navbar-fixed-bottom">
    <div class="col-sm-12">
      <div id="statusSaving" class="statusFloatSaving" style="display:none">
        <i class="fa fa-spinner fa-spin fa-fw"></i> Guardando
      </div>
      <div id="statusSaved" class="statusFloatSaved" style="display:none">
        <i class="fa fa-check fa-fw"></i> Guardado
        </div>
    </div>
    <!-- /.col-sm-12 --> 
  </div>
  <!-- /.row --> 
  
  
<script type="text/javascript">
function downItemToBottom(id,grid)
{
	statusStartSaving();
	
	alert("downItemToBottom: "+id);
	$.post(
			'<?php echo BudgetController::createUrl('area/AjaxDownBudgetItem')?>',
			 {
			 	id: id,
			 },'json').success(
				function(data)				 
				{ 
					statusSaved();
					$.fn.yiiGridView.update(grid);											
				}
			).error(function(){statusSavedError();});			
}
    
function downItem(id,grid)
{
	statusStartSaving();
	
	alert("downItem: "+id);
	$.post(
			'<?php echo BudgetController::createUrl('area/AjaxDownBudgetItem')?>',
			 {
			 	id: id,
			 },'json').success(
				function(data)				 
				{ 
					statusSaved();
					$.fn.yiiGridView.update(grid);											
				}
			).error(function(){statusSavedError();});			
}
function upItemToAbove(id,grid)
{
	statusStartSaving();
	
	alert("upItemToAbove: "+id);
	$.post(
			'<?php echo BudgetController::createUrl('area/AjaxDownBudgetItem')?>',
			 {
			 	id: id,
			 },'json').success(
				function(data)				 
				{ 
					statusSaved();
					$.fn.yiiGridView.update(grid);											
				}
			).error(function(){statusSavedError();});			
}
    
function upItem(id,grid)
{
	statusStartSaving();
	
	alert("upItem: "+id);
	$.post(
			'<?php echo BudgetController::createUrl('area/AjaxDownBudgetItem')?>',
			 {
			 	id: id,
			 },'json').success(
				function(data)				 
				{ 
					statusSaved();
					$.fn.yiiGridView.update(grid);											
				}
			).error(function(){statusSavedError();});			
}

function editAreaProject(idAreaProject)
{
	$.post(
			'<?php echo BudgetController::createUrl('area/AjaxShowUpdateModalAreaProject')?>',
			 {
			 	id: idAreaProject,
			 	field_caller:'areaProjectDescription_'+idAreaProject
			 },'json').success(
				function(data) 
				{ 
					if(data!='')
					{
						$('#modalPlaceHolder').html(data);
						$('#modalPlaceHolder').modal('show');					
					}
				}
			).error(function(){});			
}
    
function updateGridExtras()
{
	$.fn.yiiGridView.update('budget-item-generic');	
	$.fn.yiiGridView.update('totals-services-grid');	
}
    
    function statusStartSaving()
        {
        	$("#statusSaved").hide();
        	$("#statusSaving").fadeIn();				        	
		}
        function statusSaved()
        {
			$("#statusSaving").fadeOut(function(){$("#statusSaved").fadeIn();});							
        }
		function statusSavedError()
		{
			$("#statusSaving").fadeOut();				
		}
function setTotals()
{
	$.post(
		'<?php echo BudgetController::createUrl('AjaxGetTotals');?>',
		 {
		 	Id: <?php echo $model->Id;?>,
			version_number:<?php echo $model->version_number;?>,
		 },'json').success(
			function(data) 
			{ 
				if(data!='')
				{
					var response = jQuery.parseJSON(data);							
					$('#totals_price_w_discount').html(response.total_price_with_discount);					
					$('#totals_discount').html(response.total_discount);
					$('#totals_total_price').html(response.total_price);
				}
			}
		);		
}

$('#totals_percent_discount').keyup(function(){
	validateNumberInteger($('#totals_percent_discount'));
	if($('#totals_percent_discount').val()>100)	$('#totals_percent_discount').val(100);
});							
$('#totals_percent_discount').change(
	function(){
		statusStartSaving();
		$.post(
			'<?php echo BudgetController::createUrl('AjaxUpdatePercentDiscount')?>',
			 {
			 	Id: <?php echo $model->Id?>,
				version_number:<?php echo $model->version_number?>,
				percent_discount: $(this).val(),
			 },'json').success(
				 	function(data) 
				 		{ 
						statusSaved();
				 		if(data!='')
							{
								var response = jQuery.parseJSON(data);							
								$('#totals_price_w_discount').html(response.total_price_with_discount);					
								$('#totals_discount').html(response.total_discount);
								$('#totals_total_price').html(response.total_price);
							}
						}).error(function(){statusSavedError();});
	
	}
	);
    
function changeService(id, object)
	{
	statusStartSaving();
	$.post(
			"<?php echo BudgetController::createUrl('AjaxSaveService')?>",
			{
				Id_budget_item: id,Id_service:$(object).val()
			}
			).success(function(data)					
			{
				statusSaved();
			}).error(function(data)
			{
				statusSavedError();
			},"json");	
}

function changeDiscount(id, object)
{
	statusStartSaving();	
	validateNumber(object);
	var discountType = $('#discount_type_'+id).val();
	$.post(
			"<?php echo BudgetController::createUrl('AjaxSaveDiscountValue')?>",
			{
				Id_budget_item: id,discount:$(object).val(),discountType:discountType
			}
			).success(function(data)
			{
				statusSaved();
				var response = jQuery.parseJSON(data);
				$("#total_price_"+id).html(response.total_price+" <div class=\"usd\"><?php echo $settings->getEscapedCurrencyShortDescription()?></div>");
				$(object).val(response.discount);
				setTotals();
		}).error(function(data)
			{
			statusSavedError();				
		},"json");	
}
function changeQuantity(id, object)
{
	statusStartSaving();	
	validateNumber(object);
	$.post(
			"<?php echo BudgetController::createUrl('AjaxSaveQuantity')?>",
			{
				Id_budget_item: id,quantity:$(object).val()
			}
			).success(function(data)
			{
				statusSaved();
				var response = jQuery.parseJSON(data);
				$("#total_price_"+id).html(response.total_price+" <div class=\"usd\"><?php echo $settings->getEscapedCurrencyShortDescription()?></div>");
				$(object).val(response.quantity);
				setTotals();
				updateGridExtras();
				//alert("success");				
		}).error(function(data)
			{
			statusSavedError();				
		},"json");	
}
function changeDiscountType(id, object)
{
	statusStartSaving();	
	$.post(
			"<?php echo BudgetController::createUrl('AjaxSaveDiscountType')?>",
			{
				Id_budget_item: id,discount_type:$(object).val()
			}
			).success(function(data)
			{
				statusSaved();
				var response = jQuery.parseJSON(data);
				$("#total_price_"+id).html(response.total_price+" <div class=\"usd\"><?php echo $settings->getEscapedCurrencyShortDescription()?></div>");
				setTotals();
		}).error(function(data)
			{
			statusSavedError();				
		},"json");	
}

function deleteBudgetItemByService(id,idService)
{
	if(confirm("¿Esta seguro que desea eliminar este ítem?"))
	{
		statusStartSaving();
			$.post(
				'<?php echo BudgetController::createUrl('AjaxDeleteBudgetItem')?>',
				 {
				 	id: id,
				 },'json').success(						 
					function(data) 
					{
						 statusSaved();
						 $.fn.yiiGridView.update('budget-item-grid_'+idService);
						 updateGridExtras(); 
					}
				).error(function(){statusSavedError();});		
	}	
 	return false;
}
function deleteBudgetItem(id,idAreaProject,idArea)
{
	if(confirm("¿Esta seguro que desea eliminar este ítem?"))
	{
		statusStartSaving();
			$.post(
				'<?php echo BudgetController::createUrl('AjaxDeleteBudgetItem')?>',
				 {
				 	id: id,
				 },'json').success(						 
					function(data) 
					{
						 statusSaved();
						 $.fn.yiiGridView.update('budget-item-grid_'+idAreaProject+"_"+idArea);
						 updateGridExtras(); 
					}
				).error(function(){statusSavedError();});		
	}	
 	return false;
}

function fillAndOpenDD(id)
{
	$(".precioTabla").removeClass("open");
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
			).error(function(){});		
	
 	return false;
}
$("#addAreaToProject").click(function()
{	
	$.post(
			'<?php echo BudgetController::createUrl('ajaxFillAddAreaToProject')?>',
			 {
			 	Id_project: <?php echo $model->Id_project?>,
			 },'json').success(
				function(data) 
				{ 
					if(data!='')
					{
						$('#modalPlaceHolder').html(data);
						$('#modalPlaceHolder').modal('show');					
					}
				}
			).error(function(){});		
})
</script>
