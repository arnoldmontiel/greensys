<a href="<?php echo ProductController::createUrl('create'); ?>" class="btn btn-primary superBoton"><i class="fa fa-plus"></i>  Agregar Producto</a>
      <table class="table table-striped table-bordered tablaIndividual" width="100%">
        <thead>
          <tr>
            <th style="text-align:left;">Model</th>
            <th style="text-align:left;">Part Number</th>
            <th style="text-align:left;">Marca</th>
            <th style="text-align:left;">Alto</th>
            <th style="text-align:left;">Ancho</th>
            <th style="text-align:left;">Largo</th>
            <th style="text-align:left;">Peso</th>
            <th style="text-align:left;">Tasa</th>
            <th style="text-align:left;">Dealer Cost</th>
            <th style="text-align:left;">MSRP</th>
            <th style="text-align:left;">Resumen</th>
            <th style="text-align:right;">Acciones</th>
          </tr>
        </thead>
        <tbody>
        <?php 
         	$settings = Setting::getInstance();
         	$currency = '$';
         	if(isset($settings))
         		$currency = $settings->currency->short_description;
         	
	        foreach($modelProducts as $model)
	        {
	        	$unitLinear = $model->measurementUnitLinear->short_description;
	        	$unitWeight = $model->measurementUnitWeight->short_description;
	        	
	        	echo CHtml::openTag("tr");
	        		echo CHtml::openTag("td");
	        			echo $model->model;
	        		echo CHtml::closeTag("td");
	        		echo CHtml::openTag("td");
	        			echo $model->part_number;
	        		echo CHtml::closeTag("td");
	        		echo CHtml::openTag("td");
	        			echo $model->brand->description;
	        		echo CHtml::closeTag("td");
	        		echo CHtml::openTag("td");
	        			echo $model->height . " ". $unitLinear;
	        		echo CHtml::closeTag("td");
	        		echo CHtml::openTag("td");
	        			echo $model->width . " ". $unitLinear;
	        		echo CHtml::closeTag("td");
	        		echo CHtml::openTag("td");
	        			echo $model->length . " ". $unitLinear;
	        		echo CHtml::closeTag("td");
	        		echo CHtml::openTag("td");
	        			echo $model->weight . " ". $unitWeight;
	        		echo CHtml::closeTag("td");	        		
	        		echo CHtml::openTag("td");
	        			echo $model->profit_rate;
	        		echo CHtml::closeTag("td");
	        		echo CHtml::openTag("td");
	        			echo $model->dealer_cost . " ". $currency;
	        		echo CHtml::closeTag("td");
	        		echo CHtml::openTag("td");
	        			echo $model->msrp . " ". $currency;
	        		echo CHtml::closeTag("td");
	        		echo CHtml::openTag("td");
	        			echo $model->short_description;
	        		echo CHtml::closeTag("td");
	        		echo CHtml::openTag("td",array("style"=>"text-align:right"));
	        			echo "<button type='button' onclick='aaa(".$model->Id.");' class='btn btn-default btn-sm'><i class='fa fa-pencil'></i> Editar</button>";
	        			echo "<button type='button' onclick='aaa(".$model->Id.");' class='btn btn-default btn-sm'><i class='fa fa-trash-o'></i> Borrar</button>";
	        		echo CHtml::closeTag("td");
	        	echo CHtml::closeTag("tr");
	        }
	      ?>
        </tbody>
      </table>