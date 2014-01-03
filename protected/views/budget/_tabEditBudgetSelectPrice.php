		<div class="arrow"></div>
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
            <td><?php echo $model->product->msrp?></td>
            <td style="text-align:center;"><?php echo  $model->product->dealer_cost?></td>
            <td style="text-align:right;"><?php echo $model->product->profit_rate?></td>
            </tr>
        </tbody>
      </table>
      </li>
      <?php
      	$criteria= new CDbCriteria;
      	$criteria->with[]="priceList";
      	$criteria->addCondition('Id_product = '.$model->Id_product);
      	$criteria->addCondition('priceList.Id_importer is not null');
      	$priceListItems = PriceListItem::model()->findAll($criteria);
      	$settings = new Settings;
      ?>
      <?php foreach ($priceListItems as $priceListItem){?>
		    <li role="presentation" class="introProveedor">
		    <?php $importer = $priceListItem->priceList->importer;?>
		    <?php $shipping = $priceListItem->priceList->importer;
		    	$shippingParameter = $importer->shippingParameters[0];
				$air = $shippingParameter->shippingParameterAir;
				$maritime = $shippingParameter->shippingParameterMaritime;
				$isCurrentPriceList = $priceListItem->priceList->Id == $model->Id_price_list;
		    ?>
		    <?php if($importer->contact->description!="FOB"):?>
		    <div class="titleProveedor"><?php echo $importer->contact->description?></div>
		    <table class="table tableOpcionesPrecio">
		        <tbody>
		          <tr>
		            <td> <i class="fa fa-anchor fa-fw"></i>Maritimo</td>
		            <td><?php echo $maritime->days?> Días</td>
		            <td><?php echo $priceListItem->maritime_cost." ".$settings->getCurrencyShortDescription() ;?></td>
		            <td style="text-align:right;">    <input type="radio" name="priceListRadios" id="<?php echo $priceListItem->Id?>" value="1" <?php echo ($isCurrentPriceList&&$model->Id_shipping_type==1)?'checked':'';?>></td>
		            </tr>
		          <tr>
		            <td> <i class="fa fa-plane fa-fw"></i>Aereo</td>
		            <td><?php echo $air->days?> Días</td>
		            <td><?php echo $priceListItem->air_cost." ".$settings->getCurrencyShortDescription();?></td>
		            <td style="text-align:right;">    <input type="radio" name="priceListRadios" id="<?php echo $priceListItem->Id?>" value="2" <?php echo ($isCurrentPriceList&&$model->Id_shipping_type==2)?'checked':'';?>></td>
		            </tr>
		        </tbody>
		      </table>
		    </li>
		    <?php else:?>
		    <li role="presentation" class="introProveedor">
		    <div class="titleProveedor">FOB </div>
		    <table class="table tableOpcionesPrecio">
		        <tbody>
		          <tr>
		            <td> <i class="fa fa-sun-o fa-fw"></i>MSRP</td>
		            <td><?php echo $priceListItem->air_cost." ".$settings->getCurrencyShortDescription();?></td>
		            <td style="text-align:right;">    <input type="radio" name="priceListRadios" id="<?php echo $priceListItem->Id?>" value="1" <?php echo ($isCurrentPriceList)?'checked':'';?>></td>
		            </tr>
		        </tbody>
		      </table>
		    </li>
		    <?php endif?>
      
      <?php }?>
	<li role="presentation" class="introProveedor" style="text-align: center;"><button id="ddClose_<?php echo $model->Id?>" type="button" class="btn btn-default"> Cerrar</button></li>

<script type="text/javascript">
	$("#ddClose_<?php echo $model->Id?>").unbind("click");
	$("#ddClose_<?php echo $model->Id?>").click(function(){$(this).parent().parent().parent().removeClass("open")});
	$("input[name=priceListRadios]:radio").unbind("click");
	$("input[name=priceListRadios]:radio").click(function(){
		statusStartSaving();	
		$.post(
				"<?php echo BudgetController::createUrl('AjaxChangePriceList')?>",
				{
					Id_budget_item: <?php echo $model->Id?>,shipping_type:$(this).val(),Id_price_list_item:$(this).attr('id')
				}
				).success(function(data)
				{
					statusSaved();
					$.fn.yiiGridView.update('budget-item-grid_'+<?php echo $model->Id_area_project?>+"_"+<?php echo $model->Id_area?>);
					setTotals();
			}).error(function(data)
				{
				statusSavedError();				
			},"json");	
			
	});
	
</script>