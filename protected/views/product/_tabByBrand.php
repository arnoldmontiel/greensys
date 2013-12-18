<a onclick="openExcelLoader();" class="btn btn-primary superBoton" data-toggle="modal" ><i class="fa fa-upload"></i>  Cargar Nuevo Excel</a>
<table class="table table-striped table-bordered tablaIndividual" width="100%">
        <thead>
          <tr>
            <th style="text-align:left;">Marca</th>
            <th style="text-align:left;">Productos</th>
            <th style="text-align:left;">�ltima Actualizaci�n</th>
            <th style="text-align:left;">Estado</th>
            <th style="text-align:right;">Acciones</th>
          </tr>
        </thead>
        <tbody>
        <?php 
        foreach($modelImportProductLogs as $model)
        {
        	$uncompleteProducts = $model->getUncompleteProducts();
        	echo CHtml::openTag("tr");
        		echo CHtml::openTag("td");
        			echo $model->brand->description;
        		echo CHtml::closeTag("td");
        		echo CHtml::openTag("td");
        			echo $model->getCompleteProducts();
        			if($uncompleteProducts > 0)
        				echo "<span class='text-danger'> (".$uncompleteProducts .")</span>";
        		echo CHtml::closeTag("td");
        		echo CHtml::openTag("td");
        			echo $model->last_import_date;
        		echo CHtml::closeTag("td");
        		echo CHtml::openTag("td");
        			if($uncompleteProducts > 0)
        				echo "<span class='label label-danger'>Datos Incompletos</span>";
        			else
        				echo "<span class='label label-success'>Procesado</span>";
        		echo CHtml::closeTag("td");
        		echo CHtml::openTag("td",array("style"=>"text-align:right"));
        			echo "<button type='button' onclick='downloadExcel(".$model->Id.");' class='btn btn-default btn-sm'><i class='fa fa-download'></i> Descargar Excel</button>";
        			echo "<button type='button' onclick='updateExcel(".$model->Id_brand.");' class='btn btn-default btn-sm'><i class='fa fa-upload'></i> Cargar Actualizaci�n</button>";
        			echo "<button type='button' class='btn btn-default btn-sm'><i class='fa fa-trash-o'></i> Borrar</button>";
        		echo CHtml::closeTag("td");
        	echo CHtml::closeTag("tr");
        }
        ?>
        </tbody>
      </table>