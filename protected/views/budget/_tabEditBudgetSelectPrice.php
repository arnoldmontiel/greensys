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
		    ?>
		    <?php if($importer->contact->description!="FOB"):?>
		    <div class="titleProveedor"><?php echo $importer->contact->description?></div>
		    <table class="table tableOpcionesPrecio">
		        <tbody>
		          <tr>
		            <td> <i class="fa fa-anchor fa-fw"></i>Maritimo</td>
		            <td><?php echo $maritime->days?> Días</td>
		            <td><?php echo $priceListItem->maritime_cost." ".$settings->getCurrencyShortDescription() ;?></td>
		            <td style="text-align:right;">    <input type="radio" name="optionsRadios" id="optionProv" value="option1" checked></td>
		            </tr>
		          <tr>
		            <td> <i class="fa fa-plane fa-fw"></i>Aereo</td>
		            <td><?php echo $air->days?> Dias</td>
		            <td><?php echo $priceListItem->air_cost." ".$settings->getCurrencyShortDescription();?></td>
		            <td style="text-align:right;">    <input type="radio" name="optionsRadios" id="optionProv" value="option1" checked></td>
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
		            <td><?php echo $priceListItem->msrp." ".$settings->getCurrencyShortDescription();?></td>
		            <td style="text-align:right;">    <input type="radio" name="optionsRadios" id="optionProv" value="option1" checked></td>
		            </tr>
		        </tbody>
		      </table>
		    </li>
		    <?php endif?>
      
      <?php }?>
	<li role="presentation" class="introProveedor" style="text-align: center;"><button id="ddClose" type="button" class="btn btn-default"> Cerrar</button></li>

<script type="text/javascript">
	$("#ddClose").unbind("click");
	$("#ddClose").click(function(){$(this).parent().parent().parent().removeClass("open")});
</script>