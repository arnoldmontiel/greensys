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
        	echo CHtml::openTag("tr");
        		echo CHtml::openTag("td");
        			echo $model->brand->description;
        		echo CHtml::closeTag("td");
        		echo CHtml::openTag("td");
        			echo "1";
        		echo CHtml::closeTag("td");
        		echo CHtml::openTag("td");
        			echo $model->last_import_date;
        		echo CHtml::closeTag("td");
        		echo CHtml::openTag("td");
        			echo "<span class='label label-danger'>Datos Incompletos</span>";
        			//<td><span class="label label-success">Procesado</span></td>
        		echo CHtml::closeTag("td");
        		echo "<td style='text-align:right;'><button type='button' class='btn btn-default btn-sm'><i class='fa fa-download'></i> Descargar Excel</button>
        			<button type='button' class='btn btn-default btn-sm'><i class='fa fa-upload'></i> Cargar Actualizaci�n</button><button type='button' class='btn btn-default btn-sm'>
        			<i class='fa fa-trash-o'></i> Borrar</button></td>";
        	echo CHtml::closeTag("tr");
        }
        ?>
        </tbody>
      </table>