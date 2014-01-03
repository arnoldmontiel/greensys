<?php		
	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'budget-grid-cancelled',
		'dataProvider'=>$modelBudgets->searchCancelled(),
		'selectableRows' => 0,
		'filter'=>$modelBudgets,
		'summaryText'=>'',	
		'itemsCssClass' => 'table table-striped table-bordered tablaIndividual',
		'columns'=>array(	
				array(
					'name'=>'project_description',
					'value'=>'$data->project->fullDescription',
					'htmlOptions'=>array("style"=>"width:15%;"),
				),
				array(
					'name'=>'date_cancelled',
					'value'=>'$data->date_cancelled',
					'htmlOptions'=>array("style"=>"width:10%;"),
				),
				array(
					'name'=>'version_number',
					'value'=>'$data->version_number',
					'htmlOptions'=>array("style"=>"width:10%;"),
				),
				array(
					'name'=>'description',
					'value'=>'GreenHelper::cutString($data->description,40)',
					'htmlOptions'=>array("style"=>"width:20%;"),
				),
				array(
						'name'=>'note',
						'value'=>function($data){
								$value = '<span class="label label-info">'.GreenHelper::cutString($data->note,40).'</span>';
							return $value;
						},
						'type'=>'raw',
				),
				array(
						'header'=>'Acciones',
						'value'=>function($data){
							$grid = "'budget-grid-cancelled'";
							return '<button onclick="reopenBudget('.$data->Id.', '.$data->version_number.', '.$grid.');" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i> Re-Abrir</button>
									<button onclick="exportBudget('.$data->Id.', '.$data->version_number.');" type="button" class="btn btn-default btn-sm"><i class="fa fa-download"></i> Descargar</button>';						
						},
						'type'=>'raw',
						'htmlOptions'=>array("style"=>"text-align:right;"),
				),
			),
		));		
		?>