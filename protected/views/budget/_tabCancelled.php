<?php		
	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'budget-grid-approved',
		'dataProvider'=>$modelBudgets->searchCancelled(),
		'selectableRows' => 0,
		'filter'=>$modelBudgets,
		'summaryText'=>'',	
		'itemsCssClass' => 'table table-striped table-bordered tablaIndividual',
		'columns'=>array(	
				array(
					'name'=>'project_description',
					'value'=>'$data->project->description',
				),
				array(
					'name'=>'date_cancelled',
					'value'=>'$data->date_cancelled',
					'htmlOptions'=>array("style"=>"width:10%;"),
				),
				array(
					'name'=>'version_number',
					'value'=>'$data->version_number',
					'htmlOptions'=>array("style"=>"width:5%;"),
				),
				array(
					'name'=>'description',
					'value'=>'GreenHelper::cutString($data->description,40)',
					'htmlOptions'=>array("style"=>"width:20%;"),
				),
				array(
					'name'=>'percent_discount',
					'value'=>'$data->percent_discount',
					'htmlOptions'=>array("style"=>"width:5%;"),
				),
				array(
						'header'=>'Acciones',
						'value'=>function($data){
							return '<button class="btn btn-default btn-sm"><i class="fa fa-refresh"></i> Re-Abrir</button>
									<button onclick="exportBudget('.$data->Id.');"type="button" class="btn btn-default btn-sm"><i class="fa fa-download"></i> Descargar</button>';						
						},
						'type'=>'raw',
						'htmlOptions'=>array("style"=>"text-align:right;"),
				),
			),
		));		
		?>
<table class="table table-striped table-bordered tablaIndividual" width="100%">
        <thead>
          <tr>
            <th style="text-align:left;">Proyecto</th>
            <th style="text-align:left;">Cancelado</th>
            <th style="text-align:left;">N&ordm; Versi&oacute;n</th>
            <th style="text-align:left;">Descripci&oacute;n</th>
            <th style="text-align:left;">Raz&oacute;n</th>
            <th style="text-align:right;">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Casa Nordelta</td>
            <td>20 Dic 2013 12:20:12</td>
            <td>4.0</td>
            <td>Actualizaci&oacute;n de Cine y nuevas persianas.</td>
            <td><span class="label label-info">El cliente contrato a otra empresa.</span></td>
            <td style="text-align:right;">
    <button class="btn btn-default btn-sm"><i class="fa fa-refresh"></i> Re-Abrir</button>
    <button class="btn btn-default btn-sm"><i class="fa fa-download"></i> Descargar</button>
           </td>
          </tr>
          <tr>
            <td>Punta del Este Shopping</td>
            <td>20 Dic 2013 12:20:12</td>
            <td>1.0</td>
            <td>Automatizaci&oacute;n del hogar.</td>
            <td><span class="label label-info">No teniamos disponible los equipos.</span></td>
            <td style="text-align:right;">
    <button class="btn btn-default btn-sm"><i class="fa fa-refresh"></i> Re-Abrir</button>
    <button class="btn btn-default btn-sm"><i class="fa fa-download"></i> Descargar</button>
           </td>
          </tr>
          <tr>
            <td>Contaco Inicial</td>
            <td>20 Dic 2013 12:20:12</td>
            <td>1.0</td>
            <td>Ambientaci&oacute;n de luces.</td>
            <td><span class="label label-info">Desacuerdos por precio.</span></td>
            <td style="text-align:right;">
    <button class="btn btn-default btn-sm"><i class="fa fa-refresh"></i> Re-Abrir</button>
    <button class="btn btn-default btn-sm"><i class="fa fa-download"></i> Descargar</button>
           </td>
          </tr>
        </tbody>
      </table>